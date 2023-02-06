<?php

namespace App\Http\Controllers\Api\Chat;
use App\Http\Controllers\Api\Customer\ApiResponses;
use App\Models\Customer;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReplayMessage;

use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{       use ApiResponses ;
    public function  send_message ( Request  $request,$id) {
        $validator = Validator::make($request->all(), [
            'send_message'          => 'required',

        ]);
        if($validator->fails()) {
            return $this->apiResponse('Null',$validator->errors(),401);
        }

        $data['received_message']          = $request->send_message;
        $data['customer_id'] = $id;
        $data['status'] = 0;


       
        $chat = Chat::create($data);
        $users= User::get();
        $customer= Customer::where('id',$id)->first();
        $Chat = Chat::where('customer_id',$id)->first();
        Notification::send($users, new  ReplayMessage($customer,$Chat));

        if ($chat){



            return $this->apiResponse($chat,'The Message Send ',201);



        }else {
            return $this->apiResponse('Null',"The Message Not Send",400);


        }

    }
    public function  all_send_message ($id) {

        $chat = Chat::where('customer_id',$id)->get();
        if ($chat){



            return $this->apiResponse($chat,'The Message Send ',201);



        }else {
            return $this->apiResponse('Null',"The Message Not Send",400);


        }


    }
    public function  all_reciver_message  ($id) {

        $chat = Chat::where('customer_id',$id)->get();
        if ($chat){



            return $this->apiResponse($chat,'The Message Send ',201);



        }else {
            return $this->apiResponse('Null',"The Message Not Send",400);


        }
    }
}
