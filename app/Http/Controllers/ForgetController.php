<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgetController extends Controller
{
    // Display page forget password
    public function index () {
        return view('front.auth.forget');
    }

    // send token email resetpassword
    public function processForgetPassword (Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email'
        ]);

        if($validator->fails()) {
            return redirect()->route('forgetpassword')->withInput()->withErrors($validator);
        }
        $token = Str::random(60);
        DB::table('password_reset_tokens')->where('email',$request->email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token'=> $token ,
            'created_at' => now(),
        ]);

        // send Email
        $user = User::where('email',$request->email)->first();
        $mailDate = [
            'token' => $token ,
            'user' => $user,
            'subject' => 'you have requested to change your password',
        ];
        // Mail::to($request->email)->send(new ResetPasswordEmail($mailDate));
        session()->flash('success','Your send email successfully.');
        return redirect()->route('forgetpassword');

    }

    // Display page resetpassword
    public function resetPasswodlink ($token) {
        $token = DB::table('password_reset_tokens')->where('token',$token)->first();
        if($token == null ) {
            redirect()->route('forgetpassword')->with('error' , 'Invalid token .');
        }
        return view('front.auth.resetPassword',compact('token'));
    }
    // processprocessRegistration
    public function processResetPassword (Request $request) {
        $token = DB::table('password_reset_tokens')->where('token',$request->token)->first();
        if($token == null ) {
            redirect()->route('forgetpassword')->with('error' , 'Invalid token .');
        }
        return view('front.auth.resetPassword',compact('token'));
        $validator = Validator::make($request->all(),[
            'newpassword' => 'required|min:9',
            'newpassword' => 'required|same:newpassword'
        ]);

        if($validator->fails()) {
            return redirect()->route('resetpassword',$request->token)->withErrors($validator);
        }


        $user = User::where('email' , $token->email)->update([
            'password' => Hash::make($request->newpassword)
        ]);
        return redirect()->route('accountlogin')->with('success','You have successfully changed your password');






    }
}
