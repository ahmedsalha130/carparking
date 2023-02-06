<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;


//use Illuminate\Support\Str;

class ForgotPasswordtestController extends Controller
{
    use ApiResponses;
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        
      

        $status =  Password::broker('customers')->sendResetLink(
            $request->only('email')
        );
        if ($status == Password::RESET_LINK_SENT) {

            return $this->apiResponse('Password Reset',$status,200);
        }else {
            return $this->apiResponse('Not Found Email','Password Not Send',401);


        }


    }



    }
