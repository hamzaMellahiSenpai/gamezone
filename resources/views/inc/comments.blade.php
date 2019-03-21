<div class="comments">
	<div class="container">
		@if(count($comments) > 0)
			<h2> <i class="fa fa-comments"></i> {{count($comments)}} Comment </h2>
			@foreach($comments as $comment)
				<div class="comment">
					<div class="row">
						<div class="col-sm-4 col-md-2">
							<div class="avatar">
								<img class="rounded-circle" src="{{ url( '/storage/images/' . $comment->User->avatar) }}" style="width:70px;height:70px" alt="post_cover">
							</div>
						</div>
						<div class="col-sm-8 col-md-10">
							<h5> {{ $comment->User->name }} </h5>
							<p> {{str_limit($comment->text)}}</p>
							@if(!Auth::guest())
								@if(Auth::user()->id === $comment->user_id)
				             		<button class="btn btn-primary float-left"><a href="/posts/{{$PostDemo->id}}/edit">Edit</a></button>
				             		{!! Form::open(["method" => "POST",
				                        "action"=> ["CommentsController@destroy",$comment->id],
				                        "class" => "float-right"]) !!}
				             			{{ Form::hidden('_method' , "DELETE")}}
				             			{{ Form::submit( 'Delete', ["class" => "btn btn-danger"] ) }}
				             		{!! Form::close() !!}
				        		@endif
				        	@endif
						</div>
					</div>
				</div>
			@endforeach
		@endif
		@if(!Auth::guest())
			<div class="comment">
				<div class="row">
					<div class="col-sm-4 col-md-2">
						<div class="avatar">
							<img class="rounded-circle" src="{{ url( '/storage/images/' . $comment->User->avatar) }}"  style="width:70px;height:70px">
							</div>
						</div>
						<div class="col-sm-8 col-md-10">
							{{ Form::open(['action'=>"CommentsController@store", "method" => "POST"])}}
								<div class="row mt-3">
									<div class="col-md-8 form-group">
										{{ Form::hidden('post_id', $PostDemo->id)}}
										{{ Form::text('text','',['placeholder'=> "Don't be shy type a comment", "class"=>"form-control"]) }}
									</div>
									<div class="ml-2 col-md-3 form-group">
										{{ Form::submit("Add",['class'=>"btn"])}}
									</div>
								</div>
							{{ Form::close() }}
						</div>
					</div>
				</div>
		@else
			<h3>You Couldn't Leave a Comment You have To Login First</h3>
		@endif
	</div>
</div>
