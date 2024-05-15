@extends('front.layout.app')
@section('main')
    <!-- Account Settings -->
    <div class="seaction account">
        <div class="container">

            <div class="links">
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i>Home</a></li>
                    <li> / User</li>
                </ul>
            </div>

            <div class="row">
                @include('admin.sidebar')
                <div>
                    @include('front.message')
                    <div class="box">
                        <div class="heading-form">
                          <h3>Users</h3>

                        </div>

                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th class="w-2">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if ($users->isNotEmpty())
                                @foreach ( $users as $user)
                                <tr>
                                    <td>
                                      <div>
                                      <p>{{$loop->index + 1}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                      <p>{{$user->name}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                      <p>{{$user->email}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                     @if($user->mobile)
                                      <p>{{$user->mobile}}</p>
                                      @else
                                      <p>-</p>
                                      @endif
                                    </div>
                                  </td>
                                    <td>
                                      <div class="process">
                                        <div>

                                            <span class="edit"><a href="{{route('admin.edit.users',$user->id)}}"><i class="fa-regular fa-pen-to-square"></i></a></span>
                                            <span class="delete"><a href="" onclick="deleteUser({{$user->id}})"><i class="fa-regular fa-trash-can"></i></a></span>
                                          </div>
                            </div>
                                  </td>
                                  </tr>
                                @endforeach
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
    if(confirm('Are you sure want to delete user')){
        $.ajax({
            url:'{{route('admin.delete.users')}}',
            type:'delete',
            data:{'id':id},
            dataType: 'json',
            success : function (response) {
                window.location.href = '{{route('admin.users')}}'
            }
        });
    }
}
</script>
@endsection
