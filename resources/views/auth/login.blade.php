@extends('layouts.loginLayout')

@section('content')
<!-- main -->
<div class="login-box">
  <div class="login-logo">
    MCQS TEST PORTAL
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in</p>
                             @if(session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                            <strong></strong> {{ session('success') }}</div>
                            @endif
                            @if(session('error_message'))
                            <div class="alert alert-error alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                            <strong>Error!</strong> {{ session('error_message') }}</div>
                            @endif
                            
                            @if (count($errors) > 0)
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>Error!</strong> 
                                            @foreach ($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </div>
                            @endif
    <form method="POST" action="{{ route('login') }}">
            @csrf
      <div class="form-group has-feedback">
      <input id="login" type="text" name="username" placeholder="Enter Email/Username" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"  value="{{ old('username') ?: old('email') }}" required autofocus />
                
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      <input id="password" placeholder="Enter Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
          <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                
                <label for="remember">
                    {{ __('Remember Me') }}
                </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-danger btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

    @if (Route::has('password.request'))
        <a  href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif<br>
    <a href="{{ url('/register') }}" class="text-center">Register</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- //main -->

@endsection
@section('script')

@stop

@section('style')


@stop