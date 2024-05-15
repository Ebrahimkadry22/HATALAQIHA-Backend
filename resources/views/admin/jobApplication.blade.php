@extends('front.layout.app')
@section('main')
    <!-- Account Settings -->
    <div class="seaction account">
        <div class="container">

            <div class="links">
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i>Home</a></li>
                    <li> / JobApplication</li>
                </ul>
            </div>

            <div class="row">
                @include('admin.sidebar')
                <div>
                    @include('front.message')
                    <div class="box">
                        <div class="heading-form">
                          <h3>JobApplication</h3>
                        </div>

                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th class="w-2">ID</th>
                                <th>Job Title</th>
                                <th>User</th>
                                <th>Employer</th>
                                <th>Applied Date</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                                @if ($jobApplications->isNotEmpty())
                                @foreach ( $jobApplications as $jobApplication)
                                <tr>
                                    <td>
                                      <div>
                                      <p>{{$loop->index + 1}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                      <p>{{$jobApplication->job->title}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                      <p>{{$jobApplication->user->name}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                      <p>{{$jobApplication->employer->name}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                     <p>{{$jobApplication->created_at->format('d-m-Y')}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div class="process">
                                        <div>

                                            <span class="view"><a href="{{route('view.job',$jobApplication->job->id)}}"><i class="fa-regular fa-eye"></i></a></span>
                                          </div>
                            </div>
                                  </td>
                                  </tr>
                                @endforeach
                                @else
                                <td colspan="6">
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
    </div>

    @include('front.layout.footer')
@endsection

@section('customjs')
