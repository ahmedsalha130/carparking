<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomCustomerResource;
use App\Models\Customer;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChatCustomer;

class AuthController extends Controller
{   use ApiResponses;
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    public function get_status($id){


        $customer = Customer::whereId($id)->first() ;

        if($customer){

           return $this->apiResponse($customer->status,"The Status",200);

        }else {
         return $this->apiResponse('Null',"Something was wrong",404);

        }
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {



        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'         => 'required|email|max:255|unique:customers',
            'mobile'        => 'required|numeric|unique:customers',
            'password'      => 'required',
        ],
        [
        'email.unique' => 'The email has already been taken',
        'mobile.unique' => 'The mobile has already been taken!'
    ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }


        $customer = Customer::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password),'email_verified_at'=>Carbon::now(),'status'=>1,'near'=>0]
        ));
                       Mail::to($customer->email)->locale('Support Car Parking System')->send(new ChatCustomer($customer,'Your Email :'.$request->email.' <br> Your password is:'.$request->password.', please do not share it, please keep it'));
                // event(new Registered($customer));


        return response()->json([
            'message' => 'User successfully registered',
            'user' => $customer
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth('api')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    public function update_profile(Request  $request,$id2){

        $msg = ['Customer Updated successfully'];
         $user = \request()->user();
         $id = \request()->user()->id ;
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'         => 'required|email|max:255|unique:customers,email,'.$user->id,
            'mobile'        => 'required|numeric|unique:customers,mobile,'.$user->id,
            'password'      => 'nullable',
        ]);

              if ($validator->fails()) {


                  return $this->apiResponse('Null',$validator->errors(),401);

              }
        $customer = Customer::whereId($id)->first();

        if($customer){
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['mobile'] = $request->mobile;
            if (trim($request->password) != '') {
                $data['password'] = bcrypt($request->password);
            }
            $data['status'] = 1;
            $data['near'] = 0;
            $data['bio'] = $request->bio;

            if ($customer_image = $request->file('customer_image')) {
                if ($customer->customer_image != '') {
                    if (File::exists('files/assets/customer/' . $customer->customer_image)) {
                        unlink('files/assets/customer/' . $customer->customer_image);
                    }
                }
                // $filename = Str::slug($request->name) . '.' . $customer_image->getClientOriginalExtension();
                $filename = $id. '.' . $customer_image->getClientOriginalExtension();

                $path = 'files/assets/customer/' . $filename;
                Image::make($customer_image->getRealPath())->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $data['customer_image'] = $filename;
            }

            $customer->update($data);

            return  $this->apiResponse($customer,$msg,200);


        }else{
            return $this->apiResponse('Null',"Something was wrong",404);


        }


    }

public function update_password(Request $request ,$id) {

        //  $id = $request->id ;
        $msg = ['Customer Updated successfully'];

        $validator = Validator::make($request->all(), [
            'password'      => 'required|nullable',
        ]);

              if ($validator->fails()) {


                  return $this->apiResponse('Null',$validator->errors(),401);

              }
        $customer = Customer::whereId($id)->first();

            if($customer){

           if (trim($request->password) != '') {
                $data['password'] = bcrypt($request->password);
            }

                 $customer->update($data);

                 return  $this->apiResponse($customer,$msg,200);

        }else {
                return  $this->apiResponse('Null','Error',401);

        }

}


    public function update_image(Request $request){

            $id = $request->id;
        $msg = ['Customer Updated successfully'];

        $validator = Validator::make($request->all(), [
            'customer_image'          => 'required',
        ]);

              if ($validator->fails()) {


                  return $this->apiResponse('Null',$validator->errors(),401);

              }
        $customer = Customer::where('id',$id)->first();

        if($customer){


            if ($customer_image = $request->file('customer_image')) {
                if ($customer->customer_image != '') {
                    if (File::exists('files/assets/customer/' . $customer->customer_image)) {
                        unlink('files/assets/customer/' . $customer->customer_image);
                    }
                }
                $filename = id.'.' . $customer_image->getClientOriginalExtension();
                $path = 'files/assets/customer/' . $filename;
                Image::make($customer_image->getRealPath())->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $data['customer_image'] = $filename;
            }

            $customer->update($data);

            return  $this->apiResponse($customer,$msg,200);


        }else{
            return $this->apiResponse('Null',"Something was wrong",404);


        }


    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }


}
