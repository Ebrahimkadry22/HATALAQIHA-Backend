<?php

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    // Display page registration
    public function registration () {
        return view('front.auth.registration');
    }



    // User processRegistration
    public function processRegistration (Request $request) {
        $validator = Validator::make($request->all(),[
            'name'=>'required|min:3|max:100',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:5|same:confirm_password',
            'confirm_password'=> 'required'

        ]);

        if($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            session()->flash('success','You have registerd successfully.');
            // Mail::to($request->email)->send(new VerificationEmail($request->name,"fgreghsdiohgdohgiohfioehro"));
            return response()->json([
                'status'=> true ,
                'errors' => []
            ]);
        }else {
            return response()->json([
                'status'=>false,
                'errors' => $validator->errors()
            ]);
        }
    }
    // Display page login
    public function login () {
        return view('front.auth.login');
    }
    // process login user
    public function authenticate (Request $request) {
        $validator = Validator::make($request->all(),[
            'email'=> "required|email",
            'password'=>"required"
        ]);

        if($validator->passes()) {
            if(Auth::attempt(['email' => $request->email , 'password'=>$request->password])) {
                return redirect()->route('account.profile');

            }else {
                return redirect()->route('accountlogin')->with('error','Either Email or password is correct');
            }

        }else {
            return redirect()->route('accountlogin')
            ->withErrors($validator)
            ->withInput($request->only('email'));
        }
    }


    // Display profile user Data
    public function profile () {
            $id = Auth::user()->id;
            $user = User::where('id',$id)->first();
            return view('front.auth.profile', compact('user'));

        }

        // user update Data
        public function updateProfile (Request $request) {
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|max:30',
            'email' => 'required|email|unique:users,email,'.$id.',id'
        ]);

        if($validator->passes()) {

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->save();

            session()->flash('success','Profile updated successfully');

            return response()->json([
                'status'=> true ,
                'errors' => []
            ]);

        }else {
            return response()->json([
                'status' => false ,
                'errors' => $validator->errors()
            ]);
        }


    }


    // update image
    public function updateImage (Request $request) {

        $id = Auth::user()->id;
        dd($request->all());
        $validator = Validator::make($request->all(),[
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);


        if($validator->passes()) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $id . '-' . time() . '.' . $ext ;
            $image->move(public_path('asstes/image/profile-pic'),$imageName);
            User::where('id',$id)->update(['image'=> $imageName]);
            Session()->flash('success','Profile Image update Successfully');
            return response()->json([
                'status' => true ,
                'errors' => []
            ]);

        }else {
            return response()->json([
                'status' => false ,
                'errors' => $validator->errors()
            ]);
        }
    }


    // user logout
    public function logout () {
        Auth::logout();
        return redirect()->route('accountlogin');
    }

    // update password
    public function updatePassword (Request $request) {
        $validator = Validator::make($request->all(),[
            'oldpassword'=> 'required',
            'newpassword'=> 'required|min:5',
            'confirmpassword' => 'required|same:newpassword'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $userId = Auth::user()->id;
       if(!Hash::check(Auth::user()->password,$request->oldpassword)) {
        // dd($request->all() , Auth::user()->password );

        session()->flash('error','Your Old password is incorrect .');

        return response()->json([
            'status' => false,

        ]);
       }

       $user = User::find($userId);
       dd(encrypt($request->newpassword));
       $user->password = Hash::make($request->newpassword);
       $user->save();
       session()->flash('success','Password update Successfully .');
        return response()->json([
            'status' => true
        ]);






    }

}
