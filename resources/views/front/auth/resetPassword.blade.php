@extends('front.layout.app')
@section('main')

<div class="seaction login">
    <div class="container">
        @include('front.message')
      <div class="box">
       <div class="heading">
        <h2>Reset Password </h2>
       </div>
       <form action="{{ route('processResetPassword')}}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{$token}}">
        <div>
          <label for="">new Password</label>
          <input type="password" value="{{ old('newpassword') }}" name="newpassword" placeholder="Enter password" class=" @error('newpassword')
          is-invalid
          @enderror">
          @error('newpassword')
          <p class="invalid-feedback">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="">Confirm Password</label>
          <input type="password" value="{{ old('confirmpassword') }}" name="newpassword" placeholder="Enter password" class=" @error('confirmpassword')
          is-invalid
          @enderror">
          @error('confirmpassword')
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

    </div>
  </div>
@endsection
