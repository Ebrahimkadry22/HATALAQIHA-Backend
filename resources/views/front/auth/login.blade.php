@extends('front.layout.app')
@section('main')

<div class="seaction login">
    <div class="container">
        @include('front.message')
      <div class="box">
       <div class="heading">
        <h2>Login</h2>
       </div>
       <form action="{{ route("account.authenticate")}}" method="post">
        @csrf
        <div>
          <label for="">Email</label>
          <input type="text" value="{{ old('email') }}" name="email" placeholder="Enter Email" class=" @error('email')
          is-invalid
          @enderror">
          @error('email')
          <p class="invalid-feedback">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="">Password</label>
          <input type="password" value="{{ old('password') }}" name="password" placeholder="Enter Password" class="@error('password')
          is-invalid
          @enderror">
          @error('password')
          <p class="invalid-feedback">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <div class="login-form">
            <div>
              <button class="btn btn-check">Login</button>
            </div>
            <div class="password">
              <a href="">Forgot Password?</a>
            </div>
          </div>
        </div>
       </form>
      </div>
      <div class="register">
        <p>Do not have an account? <a href="{{route("registration")}}">Register</a></p>
      </div>
    </div>
  </div>
@endsection
