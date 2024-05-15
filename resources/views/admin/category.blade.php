@extends('front.layout.app')
@section('main')
    <!-- Account Settings -->
    <div class="seaction account">
        <div class="container">

            <div class="links">
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i>Home</a></li>
                    <li> / Category</li>
                </ul>
            </div>

            <div class="row">
                @include('admin.sidebar')
                <div>
                    @include('front.message')
                    <div class="box">
                        <div class="heading-form">
                          <h3>Categories</h3>
                          <a href="{{route('admin.add.category')}}" class="btn btn-check">Add Category</a>
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
                                @if ($categories->isNotEmpty())
                                @foreach ( $categories as $category)
                                <tr>
                                    <td>
                                      <div>
                                      <p>{{$loop->index + 1}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                      <p>{{$category->name}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                      <p>{{$category->created_at->format('d-m-Y')}}</p>
                                    </div>
                                  </td>
                                    <td>
                                      <div>
                                     @if($category->status == 1)
                                      <p>Active</p>
                                      @else
                                      <p>Block</p>
                                      @endif
                                    </div>
                                  </td>
                                    <td>
                                      <div class="process">
                                        <div>

                                            <span class="edit"><a href="{{route('admin.edit.category',$category->id)}}"><i class="fa-regular fa-pen-to-square"></i></a></span>
                                            <span class="delete"><a href="" onclick="deleteCategory({{$category->id}})"><i class="fa-regular fa-trash-can"></i></a></span>
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
function deleteCategory (id) {
    if(confirm('Are you sure want to delete Category')){
        $.ajax({
            url:'{{route('admin.delete.category')}}',
            type:'delete',
            data:{'id':id},
            dataType: 'json',
            success : function (response) {
                window.location.href = '{{route('admin.category')}}'
            }
        });
    }
}
</script>
@endsection
