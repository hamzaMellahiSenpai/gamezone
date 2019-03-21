@extends('layouts.app')

@section('content');
    <div class="card">
        <div class="card-header">
            <h2>Edit a Post</h2>
        </div>
        <div class="card-body">
            {!! Form::open(['action' => ["PostsController@update",$post->id ],  "method" => "POST", "enctype"=>"multipart/form-data"]) !!}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            {{form::label("title","Title")}}
                        </div>
                        <div class="col-sm-12 col-md-8">
                            {{form::text('title', $post->title, ['class' => "form-control", "placeholder" => "Type the title" ])}}
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                {{form::label("content","Content")}}
                            </div>
                            <div class="col-sm-12 col-md-8">
                                {{form::label("content","Content")}}
                                {{form::textarea('content', $post->content, ["id"=>"article-ckedito",'class' => "form-control", "placeholder" => "Type the content" ])}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file"name="cover_image" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                {{form::hidden('_method', "PUT")}}
                {{form::submit("Submit", ["class" => "btn btn-primary"])}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection
