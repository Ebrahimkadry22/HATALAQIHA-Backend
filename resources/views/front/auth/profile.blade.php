@extends('front.layout.app')
@section('main')
    <!-- Account Settings -->
    <div class="seaction account">
        <div class="container">

            <div class="links">
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i>Home</a></li>
                    <li> / Account Settings</li>
                </ul>
            </div>

            <div class="row">
                @include('front.auth.sidebar')
                <div>
                    @include('front.message')
                    <div class="box">
                        <div class="heading-form">
                            <h3>My Profile</h3>
                        </div>
                        <div class="form">
                            <form action="" class="userForm" id="ProfileForm" method="post">

                                <div>
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                                        placeholder="Enter name">
                                    <p></p>
                                </div>
                                <div>
                                    <label for="">Email</label>
                                    <input type="text" name="email" id="email" value="{{ $user->email }}"
                                        placeholder="Enter Email">
                                    <p></p>
                                </div>
                                <div>
                                    <label for="">Designation</label>
                                    <input type="text" name="designation" value="{{ $user->designation }}"
                                        id="designation" placeholder="Enter Designation">
                                    <p></p>
                                </div>
                                <div>
                                    <label for="">Mobile</label>
                                    <input type="text" name="mobile" id="mobile" value="{{ $user->mobile }}"
                                        placeholder="Enter Mobile">
                                    <p></p>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-check btn-m">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="box">
                        <div class="heading-form">
                            <h3>Change Password</h3>
                        </div>
                        <div class="form">
                            <form action="" method="post" id="changePasswordForm" name="changePasswordForm">

                                <div>
                                    <label for="">Old Password</label>
                                    <input type="password" name="oldpassword" id="oldpassword" placeholder="Old Password">
                                    <p></p>
                                </div>
                                <div>
                                    <label for="">New Password</label>
                                    <input type="password" name="newpassword" id="newpassword" placeholder="New Password">
                                    <p></p>
                                </div>
                                <div>
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirmpassword" id="confirmpassword"
                                        placeholder="Confirm Password">
                                    <p></p>
                                </div>
                                <div>
                                    <button class="btn btn-check btn-m" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>




        </div>
    </div>

    @include('front.layout.footer')
@endsection

@section('customjs')
    <script>
        // change user data
        $("#ProfileForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('account.update') }}',
                type: 'PUT',
                data: $("#ProfileForm").serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == false) {
                        var errors = response.errors;
                        if (errors.name) {
                            $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html(errors.name);
                        } else {
                            $("#name").removeClass('is-invalid').siblings('p').addClass('valid').html(
                                '');

                        }
                        if (errors.email) {
                            $("#email").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors.email);
                        } else {
                            $("#email").removeClass('is-invalid').siblings('p').addClass('valid').html(
                                '');

                        }
                    } else {
                        $("#name").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                        $("#email").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                        window.location.href = '{{ route('account.profile') }}'
                    }
                }
            })
        });

        // change password
        $('#changePasswordForm').submit(function(e) {
            e.preventDefault();
            console.log(e);
            $.ajax({
                url: '{{ route('update.password') }}',
                type: 'post',
                dataType: 'json',
                data: $("#changePasswordForm").serializeArray(),
                success: function(response) {
                    if (response.status == false) {
                        var errors = response.errors;
                        if (errors.oldpassword) {
                            $("#oldpassword").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.oldpassword);
                        } else {
                            $("#oldpassword").removeClass('is-invalid').siblings('p').addClass('valid')
                                .html(
                                    '');

                        }
                        if (errors.newpassword) {
                            $("#newpassword").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.newpassword);
                        } else {
                            $("#newpassword").removeClass('is-invalid').siblings('p').addClass('valid')
                                .html(
                                    '');

                        }
                        if (errors.confirmpassword) {
                            $("#confirmpassword").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.confirmpassword);
                        } else {
                            $("#confirmpassword").removeClass('is-invalid').siblings('p').addClass(
                                'valid').html(
                                '');

                            }

                    } else {
                        $("#oldpassword").removeClass('is-invalid').siblings('p').addClass('valid')
                            .html(
                                '');
                        $("#newpassword").removeClass('is-invalid').siblings('p').addClass('valid')
                            .html(
                                '');
                        $("#confirmpassword").removeClass('is-invalid').siblings('p').addClass('valid')
                            .html(
                                '');
                        window.location.href = '{{ route('account.profile') }}'
                    }

                }

            });
        });

// update image user
$('#updateImage').submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    console.log(formData);
    $.ajax({
            url : '{{route('account.updateImage')}}',
            type : 'PUT',
            dataType : 'json',
            data: formData,
                    contentType: false,
                    processData: false,
            success : function (response) {
                var errors = response.errors;
                if(response.status == false) {
                    if(errors.image) {
                        $("#image").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.image);
                    }
                }else {
                    $("#image").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                }
            }

        });

});

    </script>
@endsection
