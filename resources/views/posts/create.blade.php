@extends('layouts.app')

@section('content')
    <div class="card col-md-12">
        <div class="card-header">
            <h2>Create a Post</h2>
        </div>
        <div class="card-body">
            {!! Form::open(['action' => "PostsController@store", "method" => "POST", "enctype" => "multipart/form-data"]) !!}
                <div class="form-group">
                    {{form::label("title","Title")}}
                </div>
                <div class="form-group">
                    {{form::text('title', "", ['class' => "form-control", "placeholder" => "Type the title" ])}}
                </div>
                <div class="form-group">
                    {{form::label("content","Content")}}
                    {{form::textarea('content', "", ["id"=>"article-ckedito",'class' => "form-control", "placeholder" => "Type the content" ])}}
                </div>
                <div class="form-group">
                    <!--{{ Form::file("cover_image", [ "class"=> "custom-file-label", "id" => "customFile"]) }}
                    {{ form::label('Choose File', "" , [ "class" => "custom-file-label"])}}-->
                    <div class="custom-file">
                        <input type="file"name="cover_image" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::select('plateform', ['playstation 4' => 'Playstation 4', 'xbox 360' => 'Xbox 360', "PC" => "PC", 'playstation 3' => 'Playstation 3', 'xbox 1' => 'Xbox 1', "PC" => "PC"], 'playstation 4', ['class'=> "custom-select"]) }}
                </div>
                {{ Form::submit("Submit", ["class" => "btn btn-primary"]) }}
            {{!! Form::close() !!}}
        </div>
    </div>
@endsection
