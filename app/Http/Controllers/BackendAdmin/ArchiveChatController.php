<?php

namespace App\Http\Controllers\BackendAdmin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ArchiveChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
       public function __construct()
    {
        $this->middleware('permission:chat-archive-list', ['only' => ['index']]);

        $this->middleware('permission:chat-archive-delete', ['only' => ['destroy','multipleusersdelete']]);
    }
    public function index()
    {
        $chats= Chat::onlyTrashed()->paginate(10);

        return view('messages.archive',compact('chats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request)
    {
        $id = $request->id_chat;
        $chat = Chat::whereId($id)->onlyTrashed()->first();

        $id_operation = $request->id_operation;

        if ($id_operation == 1) {

            if ($chat) {

                $chat->forceDelete();


                session()->flash('delete', 'Chat Deleted successfully');

                return redirect()->route('ArchiveChat.index')->with([
                    'message' => 'Chat Deleted successfully',
                    'alert-type' => 'success',
                ]);
            }else {
                session()->flash('error', 'Chat Not Deleted');

            }

            return redirect()->back()->with([
                'message' => 'Something was wrong',
                'alert-type' => 'danger',
            ]);

        }
    }
}
