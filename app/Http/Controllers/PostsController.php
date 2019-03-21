<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use  Illuminate\Support\Facades\Auth;
use App\Post;
use DB;
use App\Like;
class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     * CHECK IF THE USER REGISTER IF NOT YET DISPLAY LOGIN FORM ..
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', "show"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //$posts = Post::orderBy('title','desc')->paginate(1);
        //echo $posts;
        //$posts = DB::select('SELECT * FROM posts');
        //return view('posts.index')->with("posts",$posts);
        //return Post::where("title","first post")->get()
        $posts = Post::orderBy('created_at','desc')->paginate(8);
        $popular_posts = POST::orderBy('views_count', "desc")->get();
        $lastposts = Post::orderBy('created_at','desc')->get();
        //$rand_posts = Post::all()->random(3);
        $data  = array(
                "posts"     => $posts,
              //  "rand_posts" => $rand_posts
              );

        return view('posts.index', compact("posts", "popular_posts") );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $popular_posts = POST::orderBy('views_count', "desc")->get();
      $posts = Post::orderBy('created_at','desc')->take(3);
      return view('posts.create')->with('popular_posts' , $popular_posts)->with('posts', $posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            "title"       => "required",
            "content"     => "required",
            "cover_image" => "image|nullable|max:1999"
        ]);

        // CHECK IF AN IMAGE UPLOADED IF YES INSERT IT TO DB
        if($request->hasFile("cover_image")){
            // GET FILENAME WITH EXT
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // GET THE NAME OF FILE ONLY
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // GET JUST THE EXTENTION
            $extention = $request->file('cover_image')->getClientOriginalExtension();
            // FILENAME TO STORE
            $fileNameToStore = $fileName . "_" . time() . "." .$extention;
            $path = $request->file('cover_image')->storeAs('public/images', $fileNameToStore);
        }else {
            $fileNameToStore = 'noImage.jpg';
        }
        // INSERT POST TO DATABASE
        $post = new Post();
        $post->title=$request->input('title');
        $post->content=$request->input('content');
        $post->plateform = $request->input('plateform');
        $post->user_id=auth()->user()->id;
        $post->views_count = 0;
        $post->cover_image= $fileNameToStore;
        $post->save();

        // REDIRECT TO POSTS PAGE
        return redirect('/posts')->with('success',"THE POST CREATED.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $posts = posts::all();
        //posts = DB:select('SELECT * FROM posts');
        //$posts = posts::orderBy('title',"desc")->get();
        //$posts  = posts::orderBy('title', "asc")->take(1)->get();
        //$posts  = posts::orderBy('created_at',"asc")->paginate(1);
        $PostDemo   =  Post::find($id);
        $comments   = $PostDemo->comments;
        $posts      = Post::all();
        $popular_posts = POST::orderBy('views_count', "desc")->get();
        return view('posts.show',compact('posts', "PostDemo","comments", "popular_posts"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        //$posts = Post::find($id);
        // CHECK IF THE POST SELECTED IS USER POST THEN DISPLAY EDIT PAGE
        if(auth()->user()->id !== $post->user_id){
            return redirect("/posts")->with('error', "You cannot access to this page");
        }else{
            return view("posts.edit")->with('post', $post);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // FROM VALIDATE
        $this->validate($request, [
          "title"       => "required",
          "content"     => "required",
        ]);
        // CHECK IF AN IMAGE UPLOADED IF YES INSERT IT TO DB
        // Handle File Upload
       if($request->hasFile('cover_image')){
           // Get filename with the extension
           $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
           // Get just filename
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           // Get just ext
           $extension = $request->file('cover_image')->getClientOriginalExtension();
           // Filename to store
           $fileNameToStore= $filename.'_'.time().'.'.$extension;
           // Upload Image
           $path = $request->file('cover_image')->storeAs('public/images', $fileNameToStore);
       }

       // Create Post
       $post = Post::find($id);
       $post->title = $request->input('title');
       $post->content = $request->input('content');
       if($request->hasFile('cover_image')){
           $post->cover_image = $fileNameToStore;
       }
       $post->save();

        // REDIRECT TO POSTS PAGE
        return redirect('/posts')->with('success', "Post Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        // CHECK IF THE POST SELECTED IS USER POST THEN DELETE POST IF YES
        if(Auth::user()->id !== $post->user_id){
            // REDIRECT TO HOME PAGE AND DISPLAY AN ERROR
            return redirect("/posts")->with('error', "You cannot access to this page");

        }else{
            // DELETE POST
            // DELETE POST IMAGE FROM STORAGE
            if($post->cover_image != "noImage.jpg"){
                Storage::delete('public/images/' . $post->cover_image);
            }
            $post->delete();
            // REDIRECT TO HOME PAGE
            return view("/posts")->with('success', "The post has been deleted");
        }
    }

    public function count(Request $request){
        // GET THE POST ID FROM THE REQUEST
        $id = $request->post_id ;
        $post = POST::find($id);
        $post->views_count = $request->views;
        $post->save();
        //return redirect("posts.show");
    }

}
