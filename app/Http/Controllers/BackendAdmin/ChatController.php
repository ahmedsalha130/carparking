<?php

namespace App\Http\Controllers\BackendAdmin;

use App\Http\Controllers\Controller;
use App\Mail\ChatCustomer;
use App\Models\Chat;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
         public function __construct()
    {
        $this->middleware('permission:chat-list', ['only' => ['index']]);
        $this->middleware('permission:chat-answered', ['only' => ['answered']]);
        $this->middleware('permission:chat-noresponse', ['only' => ['noresponse']]);
        $this->middleware('permission:chat-create', ['only' => ['create','store']]);
        $this->middleware('permission:chat-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:chat-delete', ['only' => ['destroy','multipleusersdelete']]);
        $this->middleware('permission:chat-show', ['only' => ['show']]);

    }

    public function index()
    {
        $chats = Chat::with('customer')->orderBy('id','DESC')->paginate(10);
        $customers = Customer::get();

        return  view('messages.index',compact('chats','customers'));
    }
    public function answered()
    {
        $chats = Chat::where('status',1)->with('customer')->orderBy('id','DESC')->paginate(10);
        $customers = Customer::get();

        return  view('messages.answered',compact('chats','customers'));
    }
    public function noresponse()
    {
        $chats = Chat::where('status',0)->with('customer')->orderBy('id','DESC')->paginate(10);
        $customers = Customer::get();

        return  view('messages.noresponse',compact('chats','customers'));
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

        $validator = Validator::make($request->all(), [
            'sent_message' => 'required',
            'customer_name' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['sent_message']           = $request->sent_message;
        $data['customer_id']           = $request->customer_name;
        $data['status']           = 1;





        $chat = Chat::create($data);
        if (  $request->email  == 'on'){


         $this->send_to_email($request->customer_name,$request->sent_message);
        }
        if ($chat){

            session()->flash('add', 'Chat Send successfully');

            return redirect()->route('Chat.index')->with([
                'message' => 'Chat Send successfully',
                'alert-type' => 'success',
            ]);
        }
        session()->flash('error', 'Something was wrong');

        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function send_to_email($id,$message_repaly)
    {
        $customer = Customer::whereId($id)->first();


        Mail::to($customer->email)->locale('Support Car Parking System')->send(new ChatCustomer($customer,$message_repaly));


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
        $validator = Validator::make($request->all(), [
            'sent_message' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $chat = Chat::where('id',$request->id_chat)->first();
        $data['status']           = 1;
        $data['sent_message']           = $request->sent_message;

    $chat->update($data);
        if (  $request->email   == 'on'){


            $this->send_to_email($chat->customer_id,$request->sent_message);
        }

        if ($chat){

            session()->flash('add', 'Message Sent successfully');

            return redirect()->route('Chat.index')->with([
                'message' => 'Message Sent successfully',
                'alert-type' => 'success',
            ]);
        }
        session()->flash('error', 'Something was wrong');

        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }
   public function MarkAsRead_all(  ){

        $userUnreadNotication =  auth()->user()->unreadNotifications;

        $userUnreadNotication->markAsRead();
        return redirect()->back();

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
         public function multipleusersdelete(Request $request)
   {
//        $id = $request->id;
//        if ($id) {
//
//
//        foreach ($id as $chat)
//        {
//            Chat::where('id', $chat)->delete();
//        }
//        return redirect();
//        }else {
//            session()->flash('error', 'Something was wrong');
//
//            return redirect()->back()->with([
//                'message' => 'Something was wrong',
//                'alert-type' => 'danger',
//            ]);
//        }

        $ids = $request->ids;
        DB::table("chats")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Chat Deleted successfully."]);
    }
    public function destroy(Request  $request)
    {
        $id = $request->id_chat;
        $chat = Chat::whereId($id)->first();

        $id_operation = $request->id_operation;

        if ($id_operation == 1) {

            if ($chat) {

                $chat->forceDelete();


                session()->flash('delete', 'Chat Deleted successfully');

                return redirect()->route('Chat.index')->with([
                    'message' => 'Chat Deleted successfully',
                    'alert-type' => 'success',
                ]);
            }else {
                session()->flash('error', 'Chat Not Deleted');

            }

            return redirect()->back()->with([
                'message' => 'Something was wrong1',
                'alert-type' => 'danger',
            ]);

        }else {

            if ($chat) {

                $chat->delete();


                session()->flash('archive', 'Transfer the Chat to the Archive');

                return redirect()->route('Chat.index')->with([
                    'message' => 'Transfer the Chat to the Archive',
                    'alert-type' => 'success',
                ]);
            }else {
                session()->flash('error', 'Failed Transfer the Chat to the Archive');

            }

            return redirect()->back()->with([
                'message' => 'Something was wrong',
                'alert-type' => 'danger',
            ]);
        }

    }
}
