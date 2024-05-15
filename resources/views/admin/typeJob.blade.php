@extends('front.layout.app')
@section('main')
    <!-- Account Settings -->
    <div class="seaction account">
        <div class="container">

            <div class="links">
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i>Home</a></li>
                    <li> / JobType</li>
                </ul>
            </div>

            <div class="row">
                @include('admin.sidebar')
                <div>
                    @include('front.message')
                    <div class="box">
                        <div class="heading-form">
                          <h3>jobType</h3>
                          <a href="{{route('admin.create.TypeJob')}}" class="btn btn-check">Add JobType</a>
                        </div>

                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th class="w-2">ID</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if ($jobTypes->isNotEmpty())
                                @foreach ( $jobTypes as $jobType)
                                <tr>
                                    <td>
                                      <div>
                                      <p>{{$loop->index + 1}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                      <p>{{$jobType->name}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                      <p>{{$jobType->created_at->format('d-m-Y')}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                     @if($jobType->status == 1)
                                      <p>Active</p>
                                      @else
                                      <p>Block</p>
                                      @endif
                                    </div>
                                  </td>
                                    <td>
                                      <div class="process">
                                        <div>

                                            <span class="edit"><a href="{{route('admin.edit.typeJob',$jobType->id)}}"><i class="fa-regular fa-pen-to-square"></i></a></span>
                                            <span class="delete"><a href="" onclick="deleteTypeJob({{$jobType->id}})"><i class="fa-regular fa-trash-can"></i></a></span>
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
function deleteTypeJob (id) {
    if(confirm('Are you sure want to delete TypeJob')){
        $.ajax({
            url:'{{route('admin.delete.typejob')}}',
            type:'delete',
            data:{'id':id},
            dataType: 'json',
            success : function (response) {
                window.location.href = '{{route('admin.delete.typejob')}}'
            }
        });
    }
}
</script>
@endsection

