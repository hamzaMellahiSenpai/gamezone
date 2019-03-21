@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2> This is the posts have you created </h2>
                    @if(count($posts) > 0)
                        @foreach($posts as $post)
                            <div class="well">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                      <img src="/storage/images/" . {{ $post->cover_image }} . 'alt="post_cover"'>
                                    </div>
                                    <div class="col-sm-12 col-md-8">
                                        <h3 class="pull-left">{{ $post->title }} </h3>
                                        <button class="pull-right btn btn-primary" href="/posts/{{ $post->id }}">View</button>
                                        <button class="pull-right btn btn-primary" href="/posts/{{ $post->id }}/edit">Edit</button>
                                        {!! form::open(["method" => "POST", "action"=> ["PagesController@destroy",$post-id], "class" => "pull-right"]) !!}
                                            {{ form::hidden('_method' , DELETE)}}
                                            {{ form::submit('Delete', ["class" => "btn btn-danger"])}}
                                        {!! form::close() !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3> You don't have any posts yet </h3>
                    @endif
                    <button href="/posts/create" class="btn btn-aqua"> Add New Post </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
