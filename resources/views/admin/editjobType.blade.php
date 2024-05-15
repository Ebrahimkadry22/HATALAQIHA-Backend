@extends('front.layout.app')
@section('main')
    <!-- Account Settings -->
    <div class="seaction account">
        <div class="container">

            <div class="links">
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i>Home</a></li>
                    <li> / Edit TypeJob</li>
                </ul>
            </div>

            <div class="row">
                @include('admin.sidebar')
                <div>
                    <div class="box">
                        <div class="heading">
                         <h2>Edit TypeJob</h2>
                        </div>
                        <form action="" method="post" name="editTypejob" id="editTypejob">
                         @csrf

                         <div>
                           <label for="">Name</label>
                           <input type="text" name="name" id="name" value="{{$jobType->name}}"  placeholder="Enter Name">
                           <p></p>
                         </div>

                         <div>
                           <label for="">status</label>
                           <select name="status" id="status">
                            @for ($i = 1 ; $i <= 2 ; $i++)
                        <option {{ $jobType->status == $i ? 'selected':""  }} value="{{$i}}">{{1 == $i ? 'Active':"Block"}}</option>

                            @endfor

                           </select>
                           <p></p>
                         </div>





                         <div>
                           <div class="login-form">
                             <div>
                               <button type="submit" class="btn btn-check">update</button>
                             </div>
                           </div>
                         </div>
                        </form>
                       </div>







                </div>
            </div>




        </div>
    </div>

    @include('front.layout.footer')
@endsection
@section('customjs')
<script>
    $("#editTypejob").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{route('admin.update.typejob',$jobType->id)}}',
            type: 'put',
            data: $("#editTypejob").serializeArray(),
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
                    if (errors.status) {
                        $("#status").addClass('is-invalid').siblings('p').addClass(
                            'invalid-feedback').html(errors.status);
                    } else {
                        $("#status").removeClass('is-invalid').siblings('p').addClass('valid').html(
                            '');

                    }

                } else {
                    $("#name").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                    $("#status").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                    window.location.href = '{{ route('admin.jobType') }}'
                }
            }
        })
    });
</script>
@endsection
