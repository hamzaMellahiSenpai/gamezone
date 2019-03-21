@extends('layouts.app')

@section('content')
<div class="loginForm" style="background:url('images/slider_2.jpg');background-size:cover">
    <div class="overlay">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Register') }}</div>

                        <div class="card-body">
                          <div class="row">
                            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" class="col-sm-12 col-md-6">
                                @csrf
                                <div class="form-group">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Type your user name">
                                    <!--<i class="fa fa-user">-->
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="type your email">
                                    <!--<i class="fa fa-user">-->
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="type a strong  password">
                                    <!--<i class="fa fa-key"> -->                                   
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input id="password-confirm" type="password" class="form-control" placeholder="confirm password" name="password_confirmation" required>
                                    <!--<i class="fa fa-user">-->
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn row btn-primary m-4">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                                </form>
                                <div class="col-sm-12 col-md-6">
                                    <div class="social-media">
                                        <button class="btn btn-block btn-danger">
                                            <i class="fab fa-google float-left"></i> Connect with google
                                        </button>
                                        <button class="btn btn-block btn-info">
                                            <i class="fab fa-facebook-f float-left"></i> Connect with facebook
                                        </button>
                                        <button class="btn btn-block btn-info">
                                            <i class="fab fa-twitter float-left"></i> Connect with facebook
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
