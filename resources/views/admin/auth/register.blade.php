@extends('admin.layouts.app')

@section('title', 'Register')

@section('login_register')
<div class="register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Register a new membership</p>
  
        <form action="{{ route('admin.register') }}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input name="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" placeholder="Full name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>            
          </div>
          @error('fullname')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
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
          <div class="input-group mb-3">
            <input name="password_confirmation" type="password" class="form-control" placeholder="Retype password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>            
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input name="terms" type="checkbox" id="agreeTerms" value="agree" class="@error('terms') is-invalid @enderror">
                <label for="agreeTerms">
                 I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>
            @error('terms')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
  
        <a href="{{ route('admin.login') }}" class="text-center">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
</div>
@endsection