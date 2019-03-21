<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Message;
class PagesController extends Controller
{
    public function home(){
        $posts = Post::orderBy('created_at','desc')->get();
        $randposts = Post::all()->random(3);
        $data  = array(
                "posts"     => $posts,
                "randposts" => $randposts
         );
        return view('pages.home', compact("posts", "randposts"));
    }
    public function about(){
        $title = "About Us";
        return view('pages.about')->with("title",$title);
    }
    public function services(){
        $data = array(
            "title"   => "Services",
            "services"=> ['web developement',"full stack","dude"]
        );
        return view('pages.services')->with($data);
    }
    public function contact(){
        return view('pages.contact');
    }
    public function send(Request $request){
        // FORM VALIDATE 
        $this->validate($request , [
            "subject"     => "required",
            "content"     => "required",
            "username"    => "required",
            "email"       => "required"
        ]);
        // SELECT THE FIELDS FROM PAGE
        $to = 'hamzamellahi121@gmail.com';
        $subject = $request->input('subject');
        $content = $request->input('content');
        $sender = $request->input('username');
        $senderEmail = $request->input('email');

        // SEND EMAIL TO SP
        mail($to,$subject,$message);

        // INSERT FIELDS INPUT TO MESSAGE TABLE
        $message = new Message();
        $message->subject     = $subject;
        $message->sender      = $sender;
        $message->senderEmail = $senderEmail;
        $message->content     = $content; 
        $message->save();

        // DISPLAY SUCCES MESSAGE IF THE MESSAGE HAS SENT
        return view('/contact')->with('success',"The message has sent");
    }
}
