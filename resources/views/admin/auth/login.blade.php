@extends('admin.layouts.app')

@section('title', 'Login')

@section('login_register')

<div class="login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ route('admin.login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3">
          <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input name="remember" type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <p class="mb-1">
        <a href="{{ route('admin.password.request') }}">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="{{ route('admin.register') }}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

@endsection