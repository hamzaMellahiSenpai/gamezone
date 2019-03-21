@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header">
		<h3>Users</h3>
	</div>
	<div class="card-body">
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">ID</th>
		      <th scope="col">First Name</th>
		      <th scope="col">Last Name</th>
		      <th scope="col">Email</th>
		      <th scope='col'>Role</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($users as $user)
		  	@php
		  		$fullname = $user->name;
			    $arr = preg_split('/\s+/', $fullname);
			    $firstName = $arr[0];
			    $lastName  = $arr[1];
			@endphp
			    <tr>
			      <th scope="row">{{ $user->id }}</th>
			      <td>{{ $firstName}}</td>
			      <td>{{ $lastName }}</td>
			      <td>{{ $user->email }}</td>
			      <td> <button class="btn btn-danger">Admin</button></td>
			    </tr>
		    @endforeach
		  </tbody>
		</table>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<h3>Posts</h3>
	</div>
	<div class="card-body">
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">ID</th>
		      <th scope="col">Cover</th>
		      <th scope="col">Title</th>
		      <th scope="col">Created_at</th>
		      <th scope="col">Content</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($posts as $post)
			    <tr>
			      <th scope="row">{{ $post->id }}</th>
			      <td>
			      	<img src='/storage/images/{{ $post->cover_image}}' style="width:50px;height:50px">
			      	</td>
			      <td>{{ $post->title }}</td>
			      <td>{{ $post->created_at->format('Y M D') }}</td>
			      <td>{{ str_limit($post->content, 40) }}</td>
			    </tr>
		    @endforeach
		  </tbody>
		</table>
	</div>
</div>

@endsection
