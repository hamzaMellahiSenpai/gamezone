@extends('layouts.app')
@section('content')
	{!! Form::open(['url' => "contact/send", "method" => "POST", "enctype" => "multipart/form-data"]) !!}
			<div class="form-group">
                {{form::label("username","Username")}}
                {{form::text('username', "", ['class' => "form-control", "placeholder" => "Type a username" ])}}
            </div>
            <div class="form-group">
                {{form::label("subject","Subject")}}
                {{form::text('subject', "", ['class' => "form-control", "placeholder" => "Type the subject" ])}}
            </div>
            <div class="form-group">
                {{form::label("email","email")}}
                {{form::text('email', "", ['class' => "form-control", "placeholder" => "Type the title" ])}}
            </div>
            <div class="form-group">
                {{form::label("content","Content")}}
                {{form::textarea('content', "", ["id"=>"article-ckedito",'class' => "form-control", "placeholder" => "Type the content" ])}}
            </div>
            {{form::submit("Submit", ["class" => "btn btn-primary"])}}
        </div>
    {{!! Form::close() !!}}
@endsection