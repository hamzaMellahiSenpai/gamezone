@extends('layouts.app')

@section('content')
	<h1>Posts</h1>
	@if(count($posts) > 0 )
		<div class="posts">
			<div class="container px-2">
			    @foreach($posts as $post)
			    	<div class="post my-3">
				    	<div class="row">
				    		<div class="image_cover col-md-5 col-sm-12">
				    			<img style="width:100%;height:200px" src="{{ URL::to('storage/images/' . $post->cover_image ) }}" alt="post_cover">
				    		</div>
					        <div class="col-md-7 col-sm-12">
						        <h2>{{ $post->title}}</a></h2>
						        <p> {{str_limit($post->content)}} ....</p>
						        <p>Written on {{ $post->created_at->format('d M Y') }} By {{ $post->user->name}}</p>
						      	<span class="grow">
						      		<i class="fa fa-eye fa-2x"></i> {{$post->views_count}}
						      	</span>
						    @php
						    	$likes_count = 0;
						    	$dislikes_count = 0;
						    	$like_active = false;
						    	$dislike_active = false;
						    @endphp
						    @foreach($post->likes as $like)
						    	@php
							    	if($like->like == 1){
							    		$likes_count++;
							    	}else{
							    	 	$dislikes_count++;
							    	}
							    	if(!Auth::guest()):
								    	if($like->like == 1 && $like->user_id == Auth::user()->id){
								    		$like_active = true;
								    	}
								    	if($like->like == 0 && $like->user_id == Auth::user()->id){
								    		$dislike_active = true;
								    	}
							    	endif;
						    	@endphp
						    @endforeach
						          <!-- Thumbs up -->
				  				<div class="like grow {{ $like_active ? 'active' : ''}}" data-postid="{{$post->id}}">
				    				<i class="fa fa-thumbs-up fa-2x  aria-hidden"="true"></i> <span id="li_count">{{ $likes_count }}</span>
				 			    </div>
				 				 <!-- Thumbs down -->
				  				<div class="dislike grow {{ $dislike_active ? 'active' : ''}}">
				    				<i class="fa fa-thumbs-down fa-2x like" aria-hidden="true"></i><span id="dis_count">{{ $dislikes_count}}</span>
				  				</div>
									<button class="btn float-right mr-2"><a href="{{ url('/posts/'. $post->id ) }}">Read More</a></button>
					    	</div>
					    </div>
					</div>
			    @endforeach
	    	</div>
		</div>
	    {{ $posts->links()}}
	@else
	    <div class="alert alert-danger">Sorry no posts found</div>
	@endif
@endsection
