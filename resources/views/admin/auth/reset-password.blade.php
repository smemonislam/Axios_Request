
@extends('admin.layouts.app')

@section('title', 'Reset Password')

@section('login_register')

<div class="hold-transition login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
          <form action="{{ route('admin.password.store') }}" method="post">
          @csrf
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
            </div>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
              <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>

            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="input-group mb-3">
              <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>

            @error('password_confirmation')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Change password</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
    
          <p class="mt-3 mb-1">
            <a href="{{ route('admin.login') }}">Login</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
</div>
    
    
@endsection
