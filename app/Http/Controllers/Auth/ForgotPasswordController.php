<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\user;

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
    public function postforgot(Request $request)
    {
        $this->validate($request,['email'=>'required|email|exists:users',
        ]);
        $user=User::whereEmail($request->email)->first();
        if($user->active==false){
            return redirect()->back()->with('error','email sending problem,please try again');
        }
        else{
            $user->update([
                'activation_token'=>rand(100000,999999),
            ]);
            return redirect('verifytoken')->with('sucess','email sent');
        }
    }
   
}
