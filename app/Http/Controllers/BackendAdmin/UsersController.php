<?php

namespace App\Http\Controllers\BackendAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Role;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller

{
    function __construct()
{


    $this->middleware('permission:user-list', ['only' => ['index']]);
    $this->middleware('permission:user-create', ['only' => ['create','store']]);
    $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    $this->middleware('permission:user-show', ['only' => ['show']]);




}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.show_users',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();

        return view('users.Add_user',compact('roles'));

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
            'name'          => 'required',
            'email'         => 'required|email|unique:users',
            'mobile'        => 'required|numeric|unique:users',
            'status'        => 'required',
            'password'      => 'required|min:8|confirmed',
            'roles_name' => 'required'

        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']           = $request->name;
        $data['email']          = $request->email;
        $data['email_verified_at'] = Carbon::now();
        $data['mobile']         = $request->mobile;
        $data['password']       = bcrypt($request->password);
        $data['roles_name']         = $request->roles_name;
        $data['status']         = $request->status;


        if ($user_image = $request->file('user_image')) {

            $filename = ($request->mobile).'.'.$user_image->getClientOriginalExtension();
            $path = 'files/assets/users/' . $filename;
            Image::make($user_image->getRealPath())->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $data['user_image']  = $filename;
        }
        $user = User::create($data);
        $user->assignRole($request->input('roles_name'));


        if ($user){


            session()->flash('add', 'User Created successfully');

            return redirect()->route('users.index')->with([
                'message' => 'User Created successfully',
                'alert-type' => 'success',
            ]);
        }
        session()->flash('error', 'User Created successfully');

        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'name'          => 'required',
            'email'      => 'required|unique:users,email,'.$id,
            'mobile'         => 'required|unique:users,mobile,'.$id,
            'status'        => 'required',
            'password'      => 'nullable',
            'roles' => 'required'
        ]);
        if (trim($request->password) != '') {
            $data['password'] = bcrypt($request->password);
        }
        $user = User::where('id',$id)->first();
        if ($user){


        $data['name']           = $request->name;
        $data['email']          = $request->email;
        $data['mobile']         = $request->mobile;
        if (trim($request->password) != '') {
            $data['password'] = bcrypt($request->password);
        }
        $data['status']         = $request->status;
        $data['receive_email']  = 1;

            if ($user_image = $request->file('user_image')) {
                if ($user->user_image != '') {
                    if (File::exists('files/assets/users/' . $user->user_image)) {
                        unlink('files/assets/users/' . $user->user_image);
                    }
                }
                $filename = ($request->username).'.'.$user_image->getClientOriginalExtension();
                $path = 'files/assets/users/' . $filename;
                Image::make($user_image->getRealPath())->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $data['user_image']  = $filename;
            }

        $user->update($data);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        session()->flash('edit', 'User Updated successfully');

        return redirect()->route('users.index')->with([
            'message' => 'User Updated successfully',
            'alert-type' => 'success',
        ]);
        } else {
            return redirect()->back()->with([
                'message' => 'Something was wrong',
                'alert-type' => 'danger',
            ]);
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

       $user =  User::find($request->user_id)->first();
        if ($user->user_image != '') {
            if (File::exists('files/assets/users/' . $user->user_image)) {
                unlink('files/assets/users/' . $user->user_image);
            }
        }
        if ($user ){


        $user->delete();

        session()->flash('add', 'User Deleted successfully');

        return redirect()->route('users.index')->with([
            'message' => 'User Deleted successfully',
            'alert-type' => 'success',
        ]);

        }else {
            return redirect()->back()->with([
                'message' => 'Something was wrong',
                'alert-type' => 'danger',
            ]);

        }

    }

    public function remove_image(Request $request)
    {


        $user = User::whereId($request->user_id)->first();
        if ($user) {
            if (File::exists('files/assets/users/' . $user->user_image)) {
                unlink('files/assets/users/' . $user->user_image);
            }
            $user->user_image    = null;
            $user->save();
            return 'true';
        }
        return 'false';
    }
}
