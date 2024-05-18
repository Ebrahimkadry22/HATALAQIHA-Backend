@extends('front.layout.app')
@section('main')

<div class="seaction login">
    <div class="container">
        @include('front.message')
      <div class="box">
       <div class="heading">
        <h2>Forget Password </h2>
       </div>
       <form action="{{ route('processForgetPassword')}}" method="post">
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
          <div class="login-form">
            <div>
              <button class="btn btn-check">Submit</button>
            </div>

          </div>
        </div>
       </form>
      </div>
      <div class="register">
        <p>Do not have an account? <a href="{{route('accountlogin')}}">Back to Login</a></p>
      </div>
    </div>
  </div>
@endsection
