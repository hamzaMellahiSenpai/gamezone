<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
class ProfileController extends Controller
{
    public function index(){
    	$title = "My profile";
    	return view('profile.index')->with('title', $title);
    }
    public function edit(){
    	$title = "My profile";
    	return view('profile.edit')->with('title', $title);
    }
    public function update(Request $request, $id){
        $this->validate($request , [
            "name"       => "required",
            "email"      => "required",
            'password'   => "required|string|min:6|"
        ]);

        // CHECK IF AN IMAGE UPLOADED IF YES INSERT IT TO DB
        if($request->hasFile("avatar")){
            // GET FILENAME WITH EXT
            $fileNameWithExt = $request->file('avatar')->getClientOriginalName();
            // GET THE NAME OF FILE ONLY
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // GET JUST THE EXTENTION
            $extention = $request->file('avatar')->getClientOriginalExtension();
            // FILENAME TO STORE
            $fileNameToStore = $fileName . "_" . time() . "." .$extention;
            $path = $request->file('avatar')->storeAs('public/users', $fileNameToStore);
        }else {
            $fileNameToStore = 'unknown_avatar.png';
        }
        // INSERT POST TO DATABASE
        $user = User::find($id);
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        if($request->input('password')){
          $user->password = Hash::make($request->input('password'));
        }
        $user->avatar= $fileNameToStore;
        $user->save();

        // REDIRECT TO POSTS PAGE
        return redirect('/users/profile')->with('success',"You Profile has been Updated.");
    }
    public function destroy($id){
    	$user = User::find($id);
    	$user->delete();
    }
}
