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
                  <h3>My Jobs Applied</h3>
                  <a href="{{route('create.post')}}" class="btn btn-check">Post a Job</a>
                </div>

                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Applied Date</th>
                        <th>Applicants</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>


                        @if($jobSApplication ->isNotEmpty())
                        @foreach ($jobSApplication as $jobApplication )
                        <tr>
                            <td>
                              <div>
                              <p>{{$jobApplication->job->title}}</p>
                              <span>{{$jobApplication->job->jobType->name. "-" . $jobApplication->job->location}}</span>
                            </div>
                          </td>
                            <td>
                              <div>
                              <p>{{$jobApplication->created_at->format('d-m-Y')}}</p>
                            </div>
                          </td>
                            <td>
                              <div>
                              <p>{{$jobApplication->job->applications->count()}} Applications</p>
                            </div>
                          </td>
                            <td>
                              <div>
                                @if ($jobApplication->job->status == 1)
                                <p>active</p>
                                @else
                                <p>Block</p>
                                @endif
                            </div>
                          </td>
                            <td>
                              <div class="process">
                                <div>
                                    <span class="view"><a href="{{route('view.job',$jobApplication->job_id)}}"><i class="fa-regular fa-eye"></i></a></span>
                                    <span class="delete"><a  onclick="removeJob({{ $jobApplication->id}})"><i class="fa-regular fa-trash-can"></i></a></span>
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
function removeJob (id) {
    if(confirm("Are you sure want to remove ?")) {
        $.ajax({
            url: '{{route('remove.jobApply')}}',
            type : 'post',
            dataType : 'json',
            data :{Id: id},
            success :function (response) {
                window.location.href='{{ route('myjobApplication') }}'
            }
        });
    }
}
</script>

@endsection

