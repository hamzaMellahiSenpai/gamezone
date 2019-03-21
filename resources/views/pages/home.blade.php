@extends('layouts.app')

@section('content')
<!-- RANDOM POSTS START  -->
<div id="random_posts" class="text_center">
	<div class="container">
		<div class="row">
			@if(count($randposts) > 0)
				@foreach($randposts as $post)
					<div class="post p-0 col-sm-12 col-md-3">
						<img src="storage/images/{{ $post->cover_image }}"style='width:100%;height:100%'>
						<div class="overlay">
							<i class="far fa-play-circle"></i>
						</div>
						<!--<i class="ion ion-ios-play-outline">-->
					</div>
				@endforeach
			@endif
		</div>
	</div>
</div>
<!-- Random Posts End -->
<!-- Latest Reviews START  -->
<div id= "latest_reviews" class="text_center">
	<div class="container">
		<h2> <strong>Recent</strong> Reviews </h2>
		<div class="row">
			@if(count($posts) > 0)
				@foreach($posts as $post)
					<div class="post col-sm-12 col-md-3">
						<div class="cover_image">
							<img src="storage/images/{{ $post->cover_image }}"style='width:100%;height:100%'>
						</div>
						<h5>{{$post->title}}</h5>
						<p>{{ $post->created_at->format('d M Y') }}</p>
						<span class="ribbon"> {{ $post->plateform }} </span>
					</div>
				@endforeach
			@endif
		</div>
	</div>
</div>
<!-- Latest Reviews End -->
<!-- Latest News Start --> 
<div id="latest_news" class="posts">
	<div class="container">
		@if(count($posts) > 0)
			@foreach($posts as $post)
				<div class="post my-3">
					<div class="row">
						<div class="col-sm-12 col-md-4">
							<div class="image_cover">
								<img src="storage/images/{{ $post->cover_image }}"style='width:100%;height:100%'>
							</div>
						</div>
						<div class="col-sm-12 col-md-8">
							<div class="float-left">
								<h2> {{ $post->title }}</h2>
								<p> {{ str_limit($post->content, 200)}}</p>
								<p><small> {{ $post->created_at->format("D M Y") }}</small></p>
								<i class="fas fa-comment ml-2"></i> 15
								<i class="fas fa-heart ml-2"></i> 55
							</div>

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
				  		    <div class="like grow" data-postid="{{$post->id}}">
				    			<i class="fa fa-thumbs-up fa-2x like {{ $like_active ? 'active' : ''}} " aria-hidden="true"></i> <span id="li_count">{{ $likes_count }}</span>
				 			</div>
				 			<!-- Thumbs down -->
				  			<div class="dislike grow">
				    			<i class="fa fa-thumbs-down fa-2x like {{ $dislike_active ? 'active' : ''}}" aria-hidden="true"></i><span id="dis_count">{{ $dislikes_count}}</span>
				  			</div>
							<button class="btn float-right"><a href="/posts/{{ $post->id}}"> Read More </a></button>
						</div>
					</div>
				</div>
		@endforeach
		@else
			<h2>There is no posts to show</h2>
		@endif
	</div>
</div>
<!-- Recent Posts End -->

<!--Video Games Start -
<div id="videogames">
	<div class="container">
		@if(count($posts) > 0)
			@foreach($posts as $post)
			<div class="col-sm-12 col-md-6">
				<img src="images/{{ $post->cover_image }}">
			</div>
			<div class="col-sm-12 col-md-6">
				<img src="images/{{ $post->cover_image }}" style="height:50%">
				<img src="images/{{ $post->cover_image }}" style="height:50%">
			</div>
			@endforeach
		@endif
	</div>
</div>
 Video Games End -->
<!-- GAME STORE START-->
<div class="games_store section">
	<div class="container">
		<h2 class="section-title">
			 Games Store
		</h2>
		<div class='row'>
			<div class="post col">
				<div class="cover_image">
					<img src="images/fortnite.jpg" style="height:50%">
				</div>
				<h2> Fortnite</h2>
				<h3> Price : 40$ </h3>
			</div>
			<div class="post col">
				<div class="cover_image">
					<img src="images/gt_sport.jpg" style="height:50%">
				</div>
				<h2> geat sport</h2>
				<h3> Price : 50$ </h3>
			</div>
			<div class="post col">
				<div class="cover_image">
					<img src="images/play4.jpg" style="height:50%">
				</div>
				<h2> PlayStation 4 </h2>
				<h3> Price : 400$ </h3>
			</div>
			<div class="post col">
				<div class="cover_image">
					<img src="images/xbox_mannete.jpg" style="height:50%">
				</div>
				<h2> Xbox One Mannete</h2>
				<h3> Price : 200$ </h3>
			</div>
		</div>
	</div>
</div>
<!-- GAME STORE END -->
@endsection