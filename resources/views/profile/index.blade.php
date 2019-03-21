@extends('layouts.app')

@section('content')
<div id="profile">
	<div class="container">
		<div class="card">
			<div class="card-header">
				My Profile
			</div>
			<div class="card-body">
				<div class="row">
					<div class="avatar col-sm-12 col-md-6">
						<img src="{{ url( '/storage/images/' . auth()->User()->avatar) }}">
					</div>
					<div class="info col-sm-12 col-md-6">
						<h2>
							<strong>Full Name :</strong>{{ Auth::user()->name }}
						</h2>
						<h2><strong> Email Adress :</strong>  {{ Auth::user()->email }}</h2>
						<h2>
							<strong>Member Since :</strong>
							{{ Auth::user()->created_at->format("Y") }}
						</h2>
						<button class="btn btn-success"><a href="/users/{{ Auth::user()->name }}/edit">Edit</a></button>
						<h2> Delete your Account </h2>
						{{ Form::open(['action'=>['ProfileController@destroy', Auth::user()->id ]])}}
						{{form::hidden('_method', "PUT")}}
	                		{{form::submit("Delete", ["class" => "btn btn-primary"])}}
	            		{!! Form::close() !!}
            		</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
