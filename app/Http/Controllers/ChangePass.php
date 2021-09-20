<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class ChangePass extends Controller
{
    public function ChangePassword(){
        return view('admin.body.changepss');
    }

    public function PasswordUpdate(Request $request){
        $validateData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_password,$hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password); 
            $user->save();
            Auth::logout();
            return Redirect()->route('login')->with('success', 'Password Is Change Successfully !!');
        }else {
            return Redirect()->back()->with('error', 'Current Password Is invalid !!');
        }
    }

    public function ProfileUpdate(){
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            if ($user) {
                return view('admin.body.update_profile', compact('user'));
            }
        }
    }

    public function UserProfileUpdated(Request $request){
        $user = User::find(Auth::user()->id);
        if ($user) {
            $user->name = $request['name'];
            $user->email = $request['email'];

            $user->save();
            return Redirect()->back()->with('success', 'User Profile Is Updated Successfully !!');
        }else{
            return Redirect()->back()->with('error', 'Something Wrong !!');
        }
    }
}
