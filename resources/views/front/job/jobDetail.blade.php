@extends('front.layout.app')
@section('main')
    <div class="seaction account detail">
        <div class="container">
            <div class="links">
                <ul>
                    <li><a href="{{ route('find.jobs') }}"><i class="fa-solid fa-arrow-left"></i>Back to Jobs</a></li>
                </ul>
            </div>

            <div class="row">
                <div>
                    @include('front.message')
                    <div class="box">
                        <div class="heading-form">
                            <h3>{{ $job->title }}</h3>
                            @if (Auth::check())
                            <span class=" {{($jobSaveCount == 1) ? "heart": "hidden"}}"><i class="  {{($jobSaveCount == 1) ? "fa-solid fa-heart": "fa-regular fa-heart"}}"></i></span>
                            @endif
                        </div>
                        <div class="location">
                            <p><span><i class="fa-solid fa-location-dot"></i></span><span>{{ $job->location }}</span></p>
                            <p><span><i class="fa-regular fa-clock"></i></span><span>{{ $job->jobType->name }}</span></p>
                        </div>

                        @if (!empty($job->description))
                            <div class="heading-form">
                                <h4>Job description</h3>
                            </div>
                            <p class="text">
                                {!! nl2br($job->description) !!}
                            </p>
                        @endif

                        @if (!empty($job->responsibility))
                            <div class="heading-form">
                                <h4>Responsibility</h4>
                            </div>

                            <ul class="list-detail">
                                <li><span><i class="fa-solid fa-circle"></i></span>{!! nl2br($job->responsibility) !!}</li>

                            </ul>
                        @endif

                        @if (!empty($job->qualifications))
                            <div class="heading-form">
                                <h4>Qualifications</h4>
                            </div>

                            <ul class="list-detail">
                                <li><span><i class="fa-solid fa-circle"></i></span>{!! nl2br($job->qualifications) !!}</li>


                            </ul>
                        @endif

                        @if (!empty($job->benefits))
                            <div class="heading-form">
                                <h4>Benefits</h3>
                            </div>
                            <p class="text">
                                {!! nl2br($job->benefits) !!}
                            </p>
                        @endif

                        <hr>
                        <div class="buttons">

                            @if (Auth::check())
                                <a href="" class="btn btn-check" onclick="saveJob({{ $job->id }})">Save</a>
                                <a href="" class="btn btn-no-check" onclick="applyJob({{ $job->id }})">Apply</a>
                            @else
                                <a href="javascript:void(0);" class="btn btn-check">Login To save</a>
                                <a href="javascript:void(0);" class="btn btn-no-check ">Login To Apply</a>
                            @endif
                        </div>





                    </div>
                    @if (Auth::user())
                    @if (Auth::user()->id ==$job->user_id)

                    <div class="box">
                        <div class="heading-form">
                            <h4>Applicants</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="applicants">Name</th>
                                  <th class="applicants">Email</th>
                                  <th class="applicants">Applied Date</th>

                                </tr>
                              </thead>
                              <tbody>

                                   @if($applications->isNotEmpty())
                                  @foreach ($applications as $application )
                                  <tr>
                                      <td>
                                        {{$application->user->name}}
                                    </td>
                                      <td>
                                        {{$application->user->email}}
                                    </td>
                                      <td>
                                        {{$application->created_at->format('d-m-Y')}}
                                    </td>




                                    </tr>
                                  @endforeach
                                  @else
                                  <td colspan="3">Applicants not found .</td>
                                  @endif


                              </tbody>
                            </table>
                          </div>

                        <div>
                    </div>

                    </div>
                    @endif
                    @endif

                </div>
                <div>
                    <div class="box">
                        <div class="heading-form">
                            <h4>Job Summery</h4>
                        </div>
                        <ul class="list-detail">

                            @if (!empty($job->created_at))
                                <li><span><i class="fa-solid fa-circle"></i></span>Published on:
                                    <span>{{ $job->created_at->format('d-m-Y') }}</span></li>
                            @endif
                            @if (!empty($job->vacancy))
                                <li><span><i class="fa-solid fa-circle"></i></span>Vacancy: <span>{{ $job->vacancy }}
                                        Position</span></li>
                            @endif
                            @if (!empty($job->salary))
                                <li><span><i class="fa-solid fa-circle"></i></span>Salary: <span>{{ $job->salary }}</span>
                                </li>
                            @endif
                            @if (!empty($job->location))
                                <li><span><i class="fa-solid fa-circle"></i></span>Location:
                                    <span>{{ $job->location }}</span></li>
                            @endif
                            @if (!empty($job->job_type_id))
                                <li><span><i class="fa-solid fa-circle"></i></span>Job Nature:
                                    <span>{{ $job->jobType->name }}</span></li>
                            @endif

                        </ul>
                    </div>
                    <div class="box">
                        <div class="heading-form">
                            <h4>Company Details</h4>
                        </div>
                        <ul class="list-detail">
                            @if (!empty($job->company_name))
                                <li><span><i class="fa-solid fa-circle"></i></span>Name:
                                    <span>{{ $job->company_name }}</span></li>
                            @endif
                            @if (!empty($job->company_location))
                                <li><span><i class="fa-solid fa-circle"></i></span>Locaion:
                                    <span>{{ $job->company_location }}</span></li>
                            @endif
                            @if (!empty($job->company_website))
                                <li><span><i class="fa-solid fa-circle"></i></span>Webite:
                                    <span>{{ $job->company_website }}</span></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('front.layout.footer')
@endsection

@section('customjs')
    <script>
        function applyJob(id) {
            if (confirm('Are you sure you want to apply on this job ?')) {
                $.ajax({
                    url: '{{ route('apply.job') }}',
                    type: 'post',
                    dataType: 'json',

                    data: {
                        id: id
                    },
                    success: function(response) {
                        if(response.this.error == false ) {
                            window.location.reload();
                        }

                    }
                })
            }
        }

        function saveJob(id) {
            if (confirm('Are you sure you want to save on this job ?')) {
                $.ajax({
                    url: '{{ route('save.job') }}',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        window.location.href = "{{ url()->current() }}";

                    }
                })
            }
        }
    </script>
@endsection
