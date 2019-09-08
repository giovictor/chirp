@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="intro">Hello There! Welcome to Chirp. The coolest social media platform. Register to join now or login to check some new cool posts.</h3>
    <div class="row">
        <div class="col-md-6">
            <img src="{{asset('images/chirp_logo.png')}}" class="page_logo">
        </div>

        <div class="col-md-6">
            <h4>Login</h4>
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
    
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail</label>
    
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
    
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
    
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
    
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
    
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                </div>
            </form>
            <p>Don't have a cool Chirp account? <a href="{{route('register')}}">Click here to create account now!</a></p>
        </div>
    </div>

</div>
@endsection
