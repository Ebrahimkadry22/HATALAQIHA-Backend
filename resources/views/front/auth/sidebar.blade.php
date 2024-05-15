<div>
    <div class="box">
      <div class="img">
        @if (Auth::user()->image != '')
        <img src="{{ asset('asstes/image/'.Auth::user()->image)}}" alt="">
        @else
        <img src="{{asset('asstes/image/avatar7.png')}}" alt="">

        @endif
      </div>
      <div class="box-body">
        <h4>{{ Auth::user()->name}}</h4>
        <p>{{ Auth::user()->designation}}</p>
        <div>
          <button class="btn btn-check" id="image">
            Change Profile picture
          </button>
        </div>
    </div>

    <div class="image" id="changeImage">
        <div>
          <h5>Change Profile Picture</h5>
          <div>
            <form id="profilePicForm" method="post" enctype="multipart/form-data" >
                <div>
                  <label for="">Profile image</label>
                  <input type="file" name="photo" id="image">
                  <p></p>
                </div>
                <div>
                  <button type="submit" class="btn btn-check">Update</button>
                  <a id="close" class="btn btn-no-check">Close</a>
                </div>
            </form>
          </div>
        </div>
      </div>

    </div>

    <div class="box">
      <ul class="sidebar">
        <li><a href="{{route('account.profile')}}" class="{{ Request::is('account/profile') ? 'active' : '' }}">Account Settings</a></li>
        <li><a href="{{route('create.post')}}" class="{{ Request::is('createpost') ? 'active' : '' }}">Post a Job</a></li>
        <li><a href="{{route('account.myjobs')}}" class="{{ Request::is('myjobs') ? 'active' : '' }}">My Jobs</a></li>
        <li><a href="{{route('myjobApplication')}}" class="{{ Request::is('my-job-application') ? 'active' : '' }}">Jobs Applied</a></li>
        <li><a href="{{route('mySavedjobs')}}" class="{{ Request::is('my-saved-jobs') ? 'active' : '' }}">Saved Jobs</a></li>

        <li class="logout"><a href="{{route('account.logout')}}">Logout</a></li>
      </ul>
    </div>

  </div>
{{--
@section('customjs')
<script>
    $('#profilePicForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url : '{{route("account.updatePic")}}',
            type : 'PUT',
            dataType : 'json',
            data : $("#profilePicForm").serializeArray(),
            contenttype : false ,
            processData : false ,
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
 --}}


