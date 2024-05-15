@extends('front.layout.app')

@section('main')
<div class="seaction login">
    <div class="container">
      <div class="box">
       <div class="heading">
        <h2>Register</h2>
       </div>
       <form action="" method="post" name="registrationForm" id="registrationForm">
        @csrf

        <div>
          <label for="">Name</label>
          <input type="text" name="name" id="name"  placeholder="Enter Name">
          <p></p>
        </div>

        <div>
          <label for="">Email</label>
          <input type="text" name="email" id="email" placeholder="Enter Email">
          <p></p>
        </div>

        <div>
          <label for="">Password</label>
          <input type="password" name="password" id="password" placeholder="Enter Password">
          <p></p>
        </div>

        <div>
          <label for="">Confirm Password</label>
          <input type="password" name="confirm_password" id="confirm_password" placeholder="please Confirm Password">
          <p></p>
        </div>

        <div>
          <div class="login-form">
            <div>
              <button type="submit" class="btn btn-check">Register</button>
            </div>
          </div>
        </div>
       </form>
      </div>

      <div class="register">
        <p>Have an account?  <a href="{{ route("accountlogin")}}">Login</a></p>
      </div>

    </div>
  </div>
@endsection
@section('customjs')
<script>

$("#registrationForm").submit(function (e) {
    e.preventDefault();

    $.ajax({
        url: '{{ route("account.registration") }}',
        type :"post",
        data : $("#registrationForm").serializeArray(),
        dataType : 'json' ,
        success : function (response) {

            if(response.status == false) {
                var errors = response.errors;
                if(errors.name) {
                    $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                }else {
                    $("#name").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.email) {
                    $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email);
                }else {
                    $("#email").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }

                if(errors.password) {
                    $("#password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.password);
                }else {
                    $("#password").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.confirm_password) {
                    $("#confirm_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.confirm_password);
                }else {
                    $("#confirm_password").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }

            }
            else {
            $("#name").removeClass('is-invalid').siblings('p').addClass('valid').html('');
            $("#email").removeClass('is-invalid').siblings('p').addClass('valid').html('');
            $("#password").removeClass('is-invalid').siblings('p').addClass('valid').html('');
            $("#confirm_password").removeClass('is-invalid').siblings('p').addClass('valid').html('');
            window.location.href='{{ route("accountlogin") }}';
        }

        }

    });
});

</script>
@endsection

