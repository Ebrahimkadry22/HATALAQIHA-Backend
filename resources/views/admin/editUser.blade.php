@extends('front.layout.app')
@section('main')
    <!-- Account Settings -->
    <div class="seaction account">
        <div class="container">

            <div class="links">
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i>Home</a></li>
                    <li> / Edit User</li>
                </ul>
            </div>

            <div class="row">
                @include('admin.sidebar')
                <div>
                    @include('front.message')
                    <div class="box">
                        <div class="heading-form">
                            <h3>Edit User </h3>
                        </div>
                        <div class="form">
                            <form action="" class="editUser" id="editUser" method="post">

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
                                    <label for="">Role</label>
                                    <select name="role" id="role">
                                        <option {{ $user->role == 'user' ? 'selected': '' }} sele value="user">User</option>
                                        <option {{ $user->role == 'admin' ? 'selected': '' }} value="admin">Admin</option>
                                    </select>
                                    <p></p>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-m btn-check">Update</button>
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
    $("#editUser").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route('admin.update.users',$user->id) }}',
            type: 'put',
            data: $("#editUser").serializeArray(),
            dataType: 'json',
            success: function(response) {
                if (response.status == true) {
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
                    if (errors.relo) {
                        $("#relo").addClass('is-invalid').siblings('p').addClass(
                            'invalid-feedback').html(errors.relo);
                    } else {
                        $("#relo").removeClass('is-invalid').siblings('p').addClass('valid').html(
                            '');

                    }
                } else {
                    $("#name").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                    $("#email").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                    window.location.href = '{{ route("admin.users") }}'
                }
            }
        })
    });
</script>
@endsection
