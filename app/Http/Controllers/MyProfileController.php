<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('database.profileuser.myprofile');
    }

    public function update_profile(Request $request){
        try {
            if(Auth::check()) {
                $request->validate(['name'=>'required|string|max:100','email'=>'required|email|exists:users,email','phone'=>'nullable|string|max:20','profile_path'=>'nullable|image|mimes:png,jpg,jpeg|size:2048']);
                
                if($request->hasFile('profile_url')){
                    $image          = $request->file('profile_url');
                    $unique_name    = uniqid().'-'.time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('/statics/img/'),$unique_name);
                    $filename       = public_path('statics/img/'.auth()->user()->profil_path);

                    if (auth()->user()->profile_path && file_exists(public_path('statics/img') . '/' . auth()->user()->profile_path)) {
                        unlink(public_path('statics/img') . '/' . auth()->user()->profile_path);
                    }
                    
                }
                Auth::user()->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'phone'=>$request->phone,
                    'profile_path'=>$unique_name,
                ]);                
                return redirect()->route('my.profile')->with('success','Update profile user successfuly');
            }
            return redirect()->route('my.profile')->with('error','Update profile user failed');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function change_password(){
        return view('database.profileuser.changepassword');
    }
    public function do_change_password(Request $request,$user_id){
    try {
        if(Auth::check()){
            if(Auth::user()->id == $user_id) {
                $request->validate(['current_password'=>'required|current_password','password'=>'required|string|min:8|confirmed']);
                Auth::user()->update([
                    'password'=>Hash::make($request->password)
                ]);
                return redirect()->route('my.profile')->with('success','Password has been Updated...!');              
            }
        }
        return redirect()->route('my.profile')->with('error','Failed to change password...!');        
    } catch (\Throwable $th) {
        throw $th;
    }
    }

}
