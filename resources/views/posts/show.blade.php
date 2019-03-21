@extends('layouts.app')

@section('content');
    <div class="container">
        <ul class="list-group">
        	<button class="btn btn-default"><a href="posts">Go Back</a></button>
            <img src="{{ url('storage/images/' . $PostDemo->cover_image ) }}" alt='post_cover' class="p-5">
            <h2><a href="post/{{$PostDemo->id}}"> {{ $PostDemo->title}}  </a></h2>
            <p> {!! $PostDemo->content !!}</p>
            <p>Written on {{$PostDemo->created_at}} By {{ $PostDemo->user->name}}</p>
         </ul>
         <hr>
         @if(!Auth::guest())
            @if(Auth::user()->id === $PostDemo->user_id)
                 <button class="btn btn-success"><a href="{{ url('/posts/' . $PostDemo->id. '/edit')}}">Edit</a></button>
                 {!! Form::open(["method" => "POST",
                                 "action"=> ["PostsController@destroy",$PostDemo->id],
                                 "class" => "pull-right"]) !!}
                 	{{ Form::hidden('_method' , "DELETE")}}
                 	{{ Form::submit( 'Delete', ["class" => "btn btn-danger"] ) }}
                 {!! Form::close() !!}
            @endif
         @endif
         <form action="PostsController@count" method="POST">
            <input type="hidden" value="{{$PostDemo->id}}" id="postID">
            <input type="hidden" id="viewsCounter" name="viewcounter" value=' {{ $PostDemo->views_count }}'>
        </form>
<ul class="social-nav model-0">
  <li><i class="fab fa-twitter"></i></li>
  <li><i class="fab fa-facebook"></i></li>
  <li><i class="fa fa-google-plus"></i></li>
  <li><a class="linkedin"><i class="fab fa-linkedin"></i></a></li>
  <li><a class="pinterest"><i class="fab fa-pinterest-p"></i></a></li>
</ul>
<br>
<ul class="social-nav model-8">
  <li><a class="twitter" href="https://twitter.com/vineethtrv"><i class="fa fa-twitter"></i></a></li>
  <li><a class="facebook" href="https://www.facebook.com/vini.thekingal"><i class="fa fa-facebook"></i></a></li>
  <li><a class="google-plus" href="https://plus.google.com/u/0/109987289949504261649/posts"><i class="fa fa-google-plus"></i></a></li>
  <li><a class="linkedin"><i class="fa fa-linkedin"></i></a></li>
  <li><a class="pinterest"><i class="fa fa-pinterest-p"></i></a></li>
</ul><br/>
         @include('inc.comments');
    </div>
@endsection
