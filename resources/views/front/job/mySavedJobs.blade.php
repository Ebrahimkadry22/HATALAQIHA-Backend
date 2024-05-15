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
                        <th class="save">Title</th>
                        <th class="save">Applicants</th>
                        <th class="save">Status</th>
                        <th class="save">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                         @if($savedJobs->isNotEmpty())
                        @foreach ($savedJobs as $savrdJob )
                        <tr>
                            <td>
                              <div>
                              <p>{{$savrdJob->job->title}}</p>
                              <span>{{$savrdJob->job->jobType->name. "-" . $savrdJob->job->location}}</span>
                            </div>
                          </td>

                            <td>
                              <div>
                              <p>0 Applications</p>
                            </div>
                          </td>
                            <td>
                              <div>
                                @if ($savrdJob->job->status == 1)
                                <p>active</p>
                                @else
                                <p>Block</p>
                                @endif
                            </div>
                          </td>
                            <td>
                              <div class="process">
                                <div>
                                    <span class="view"><a href="{{route('view.job',$savrdJob->job->id)}}"><i class="fa-regular fa-eye"></i></a></span>
                                    <span class="delete"><a href="" onclick="removesavedJob ({{$savrdJob->id}})"><i class="fa-regular fa-trash-can"></i></a></span>
                                  </div>
                    </div>
                          </td>
                          </tr>
                        @endforeach
                        @else
                        <td colspan="4">
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
function removesavedJob (id) {
    if(confirm("Are you sure want to remove ?")) {
        $.ajax({
            url: '{{route("remove.jobsaved")}}',
            type : 'post',
            dataType : 'json',
            data :{id: id},
            success :function (response) {
                window.location.href='{{ route('myjobApplication') }}'
            }
        });
    }
}
</script>

@endsection
