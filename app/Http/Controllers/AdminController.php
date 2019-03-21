<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
class AdminController extends Controller
{
    public function dashboard()
    {
    	$title = "Admin Panel";
    	$users = User::all();
    	$posts = Post::orderBy('created_at', 'desc')->take(4)->get();
    	$comments = Comment::all();
    	return view('Admin.dashboard',compact('title',"users", "posts","comments"));
    }

    public function settings(Request $request)
    {
    	return "hello";
    }
}
