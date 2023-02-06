<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

//    public function __construct()
//    {
//        $this->middleware('guest:customer');
//    }
    public function showLinkRequestForm()
    {
        return view('frontend.auth.passwords.email');
    }




//defining which password broker to use, in our case its the admins
    protected function broker()
    {
        return Password::broker('customers');
    }


}
