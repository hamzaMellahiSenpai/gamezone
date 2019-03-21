@extends('layouts.app')

@section('content')
	<div class="card" class="col-sm-10 col-md-8">
		<div class="card-header">
			Edit Your Profile
		</div>
		<div class="card-body">
			{{ Form::open(['action'=> ["ProfileController@update", Auth::user()->id], "method" => "POST"])}}
				<div class="row">
						<div class="col-md-6 col-sm-10">
							<div class="form-group">
								<img src="{{ url('/storage/images/' . Auth::user()->avatar) }}">
							</div>
							<div class="form-group">
			          <div class="custom-file">
			              <input type="file" name="avatar" class="custom-file-input" id="customFile">
			              <label class="custom-file-label" for="customFile">Choose file</label>
			          </div>
			        </div>
			        {{form::hidden('_method', "PUT")}}
						</div>
						<div class="col-md-6 col-sm-10">
							<div class="form-group inline-form">
								{{ Form::label('name',"Name")}}
								{{ Form::text('name', Auth::user()->name , ['class'=> "form-control"])}}
							</div>
							<div class="form-group">
								{{ Form::label('email',"Email")}}
								{{ Form::text('email', Auth::user()->email , ['class'=> "form-control"])}}
							</div>
							<div class="form-group">
								{{ Form::label('password',"Password")}}
								{{ Form::text('name','' , ['class'=> "form-control"; "placeholder" => "Leave it blank if you don't want to change your password"])}}
							</div>
							{{form::submit("Save", ["class" => "btn"])}}
						</div>
				</div>
				{{ Form::close()}}
			</div>
		</div>
@endsection
