<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index () {
        $id = Auth::user()->id;
        $users = User::where('id','!=' ,$id)->orderBy('created_at','DESC')->get();
        return view('admin.users', compact('users'));
    }
    public function edituser ($id) {
        $user = User::find($id);
        return view('admin.editUser',compact('user'));
    }

    public function updateUser(Request $request , $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|max:30',
            'email' => 'required|email|unique:users,email,'.$id.',id'
        ]);

        if($validator->passes()){
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->role = $request->role;
            $user->save();

            session()->flash('success','User information update successfully');
            return response()->json([
                'status' => false,
                'errors'=>[]
            ]);
        }else {

            return response()->json([
                'status' => true,
                'errors'=>$validator->errors()
            ]);

        }


    }

    public function destroy(Request $request) {
        $id = $request->id;
        $user = User::find($id);
        if($user == null) {
            session()->flash('error','User Not Found');
            return response()->json([
                'status'=> false
            ]);
        }
        $user->delete();
        session()->flash('success','User Delete Successfully');
            return response()->json([
                'status'=> true
            ]);

    }
}
