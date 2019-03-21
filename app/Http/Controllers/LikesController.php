<?php

namespace App\Http\Controllers;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\Like;
class LikesController extends Controller
{
    public function like(Request $request){
    	$post_id = 5;
    	$user_id = Auth::user()->id;
    	$like_change = 0;
    	$like    = DB::table('likes')->where('post_id', $post_id)->where('user_id', $user_id)->first();

    	// CHECK IF LIKE EXIST
    	// IF YES DELETED FROM LIKES TABLE
    	if(!$like)
    	{
    		$new_like = new Like;
    		$new_like->post_id = $post_id;
    		$new_like->user_id = $user_id;
    		$new_like->like = 1;
    		$new_like->save();
    		$is_like = 1;
    	}else if($like->like == 1){
    		//$like->delete();
    		DB::table('likes')->where('post_id', $post_id)->where('user_id', $user_id)->delete();
    		$is_like = 0;
    	}else if($like->like == 0){
    		//$like->update()
    		DB::table('likes')->where('post_id', $post_id)->where('user_id', $user_id)->update(['like'=> 1]);
    		$is_like =  1;
    		$like_change = 1;
    	}

    	// SAVE DATA AS AN ARRAY
    	$response = ['is_like' => $is_like, "like_change" => $like_change];

    	return response()->json($response);
    }
 	public function dislike(Request $request){
    	$post_id = 5;//$request->post_id;
    	$user_id = Auth::user()->id;
    	$dislike_change = 0;
    	$dislike    = DB::table('likes')->where('post_id', $post_id)->where('user_id', $user_id)->first();

    	// CHECK IF LIKE EXIST
    	// IF YES DELETED FROM LIKES TABLE
    	if(!$dislike)
    	{
    		$new_like = new Like;
    		$new_like->post_id = $post_id;
    		$new_like->user_id = $user_id;
    		$new_like->like = 0;
    		$new_like->save();
    		$is_dislike = 1;
    	}else if($dislike->like == 0){
    		//$like->delete();
    		DB::table('likes')
    			->where('post_id', $post_id)
    			->where('user_id', $user_id)
    			->delete();
    		$is_dislike = 0;
    	}else if($dislike->like == 1){
    		//$like->update()
    		DB::table('likes')
    			->where('post_id', $post_id)
    			->where('user_id', $user_id)	
    			->update(['like'=> 0]);
    		$is_dislike =  1;
    		$dislike_change = 1;
    	}

    	// SAVE DATA AS AN ARRAY
    	$response = ['is_dislike' => $is_dislike, "dislike_change" => $dislike_change];

    	return response()->json($response);
    }       
}
