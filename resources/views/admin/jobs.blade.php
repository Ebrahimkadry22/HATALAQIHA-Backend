@extends('front.layout.app')
@section('main')
    <!-- Account Settings -->
    <div class="seaction account">
        <div class="container">

            <div class="links">
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i>Home</a></li>
                    <li> / Jobs</li>
                </ul>
            </div>

            <div class="row">
                @include('admin.sidebar')
                <div>
                    @include('front.message')
                    <div class="box">
                        <div class="heading-form">
                          <h3>Jobs</h3>

                        </div>

                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Create By</th>
                                <th>Created At</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if ($jobs->isNotEmpty())
                                @foreach ( $jobs as $job)
                                <tr>
                                    <td>
                                      <div>
                                      <p>{{$loop->index + 1}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                      <p>{{$job->title}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                      <p>{{$job->user->name}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                        {{$job->created_at->format('d-m-Y')}}
                                    </div>
                                  </td>
                                    <td>
                                      <div class="process">
                                        <div>

                                            <span class="edit"><a href="{{route('admin.edit.job',$job->id)}}"><i class="fa-regular fa-pen-to-square"></i></a></span>
                                            <span class="delete"><a href="" onclick="deleteUser({{$job->id}})"><i class="fa-regular fa-trash-can"></i></a></span>
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
    </div>

    @include('front.layout.footer')
@endsection
@section('customjs')
<script>
function deleteUser (id) {
    if(confirm('Are you sure want to delete Job')){
        $.ajax({
            url:'{{route('admin.delete.job')}}',
            type:'delete',
            data:{'id':id},
            dataType: 'json',
            success : function (response) {
                window.location.href = '{{route('admin.jobs')}}'
            }
        });
    }
}
</script>
@endsection
