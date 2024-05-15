@extends('front.layout.app')

@section('main')
<div class="seaction account">
    <div class="container">

      <div class="links">
        <ul>
          <li><a href="index.html"><i class="fa-solid fa-home"></i>Home</a></li>
          <li> / Account Settings</li>
        </ul>
      </div>

      <div class="row">
        @include('front.auth.sidebar')
        <div>
            @include('front.message')
            <div class="box">
                <div class="heading-form">
                  <h3>My Jobs</h3>
                  <a href="{{route('create.post')}}" class="btn btn-check">Post a Job</a>
                </div>

                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Job Created</th>
                        <th>Applicants</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                        @if($jobs->isNotEmpty())
                        @foreach ($jobs as $job )
                        <tr>
                            <td>
                              <div>
                              <p>{{$job->title}}</p>
                              <span>{{$job->jobType->name. "-" . $job->location}}</span>
                            </div>
                          </td>
                            <td>
                              <div>
                              <p>{{$job->created_at->format('d-m-Y')}}</p>
                            </div>
                          </td>
                            <td>
                              <div>
                              <p>0 Applications</p>
                            </div>
                          </td>
                            <td>
                              <div>
                                @if ($job->status == 1)
                                <p>active</p>
                                @else
                                <p>Block</p>
                                @endif
                            </div>
                          </td>
                            <td>
                              <div class="process">
                                <div>
                                    <span class="view"><a href="{{route('view.job',$job->id)}}"><i class="fa-regular fa-eye"></i></a></span>
                                    <span class="edit"><a href="{{route('edit.job',$job->id)}}"><i class="fa-regular fa-pen-to-square"></i></a></span>
                                    <span class="delete"><a href="" onclick="deleteJob({{$job->id}})"><i class="fa-regular fa-trash-can"></i></a></span>
                                  </div>
                    </div>
                          </td>
                          </tr>
                        @endforeach
                        @else
                        <td colspan="5">
                            <div>
                            <p>There is nothing to display</p>
                          </div>
                        </td>
                        @endif


                    </tbody>
                  </table>
                </div>
                {{-- {{$jobs->links()}} --}}

              </div>




        </div>
      </div>




    </div>
  </div>

  @include('front.layout.footer')

@endsection
@section('customjs')
<script>
function deleteJob (jobId) {
    if(confirm("Are you sure you want to delete ?")) {
        $.ajax({
            url : '{{ route("delete.job") }}',
            type : 'post',
            data : {jobId : jobId},
            dataType :'json',
            success : function (response) {
                window.location.href='{{ route('account.myjobs') }}'
            }
        });
    }
}
</script>
@endsection
