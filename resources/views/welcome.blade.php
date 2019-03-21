@extends('layouts.app')
@section('content')
    <div class="container">
    <h1>{{ $title }}</h1>
    <h2>Welcome from home page</h2>
    <div class="card col-sm-12 col-md-5 p-0 mx-auto">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form action="">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" placeholder="Username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" placeholder="password"  class="form-control">
                </div>
            </form>
        </div>
    </div>
@endsection
