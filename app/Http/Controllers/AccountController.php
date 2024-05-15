<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function registration () {
        return view('front.auth.registration');
    }



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

    public function login () {
        return view('front.auth.login');
    }

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

    public function profile () {
            $id = Auth::user()->id;
            $user = User::where('id',$id)->first();
            return view('front.auth.profile', compact('user'));

        }

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

    public function updateProfileImage (Request $request) {

        $id = Auth::user()->id;
        $validator = Validator::make($request->all(),[
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);
        dd($request->photo);

        if($validator->passes()) {
            $image = $request->photo;
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

    public function logout () {
        Auth::logout();
        return redirect()->route('accountlogin');
    }

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
       if(Hash::check($request->oldpassword,Auth::user()->password) == false ) {
        session()->flash('error','Your Old password is incorrect .');
        return response()->json([
            'status' => false
        ]);
       }

       $user = User::find($userId);
       $user->password = Hash::make($request->newpassword);
       $user->update();
       session()->flash('error','Password update Successfully .');
        return response()->json([
            'status' => false
        ]);






    }

}
