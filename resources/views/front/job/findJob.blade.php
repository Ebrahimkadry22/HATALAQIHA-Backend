@extends('front.layout.app')
@section('main')


<div class="seaction jobs">
    <div class="container">
      <div class="links">
        <ul>
          <li><a href="{{route('home')}}"><i class="fa-solid fa-home"></i>Home</a></li>
          <li> / Find Job</li>
        </ul>
      </div>
      <div class="heading-jobs">
        <h2>Find Jobs</h2>
        <div>
          <select name="sort" id="sort">
            <option {{ Request::get('sort') == 1 ? 'selected': ''}} value="1">Latest</option>
            <option {{ Request::get('sort') == 0 ? 'selected': ''}} value="0">Oldest</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div>
          <div class="box">
            <form action="" name="searchForm" id="searchForm">
            <div>
              <label for="">Keywords</label>
              <input type="text" name="keyword" value="{{Request::get('keyword')}}" id="keyword" placeholder="Keywords">
            </div>
            <div>
              <label for="">Location</label>
              <input type="text" name="location" value="{{Request::get('location')}}" id="location" placeholder="Location">
            </div>
            <div>
              <label for="">Catergory</label>
              <select name="catergory" id="catergory">
                <option value="">Select a Category</option>
                @if ($catergories->isNotEmpty())
                @foreach ($catergories as $category )
                <option {{ Request::get('catergory') == $category->id ? 'selected' : ""  }} value="{{$category->id}}">{{$category->name}}</option>
                @endforeach

                @endif
              </select>
            </div>
            <div class="heading-form">
              <h4>Job Type</h2>
            </div>
            @if ($jobType->isNotEmpty())
            @foreach ($jobType as $jobType )

            <div class="checkbox">
                <input {{ in_array($jobType->id,$jobArray)? 'checked' : "" }}  type="checkbox" name="job_type" id="job_type" value="{{$jobType->id}}" >
                <label for="">{{$jobType->name}}</label>
              </div>
            @endforeach

            @endif




            <div>
              <label for="">Experience</label>
              <select name="experience" id="experience">
                <option value="">Select Experience</option>
                @for ($i = 1 ; $i <= 10 ; $i++)
                        <option {{ Request::get('experience') == $i ? 'selected' : ""  }}  value="{{$i}}">{{$i}} Years</option>
                        @endfor
              </select>
            </div>
            <div>
                <button type="submit" class="btn btn-w btn-check">Search</button>
                <a href="{{route('find.jobs')}}" class="btn btn-w btn-no-check link-btn">Rests</a>
            </div>
        </form>
          </div>
        </div>
        <div>
          <div >
            <div class="jobs-find">


                @if($jobs->isNotEmpty())
                <div class="grid">
                  @foreach ($jobs as $job )

                  <div class="card">
                      <div class="card-body">
                          <h3>{{$job->title}}r</h3>
                          <p>{{ Str::words($job->description,10)}}</p>
                          <div>
                              <p><span><i class="fa-solid fa-location-dot"></i></span><span>{{$job->location}}</span></p>
                              <p><span><i class="fa-regular fa-clock"></i></span><span>{{$job->jobType->name}}</span></p>
                              <p><span><i class="fa-solid fa-list"></i></span><span>{{$job->catergory->name}}</span></p>
                              <p><span><i class="fa-solid fa-person-walking"></i></span><span>experience : {{$job->experience}}</span></p>
                              <p><span><i class="fa-regular fa-keyboard"></i></span><span>{{$job->keywords}}</span></p>
                              @if (!is_null($job->salary))
                              <p><span><i class="fa-solid fa-dollar-sign"></i></span><span>{{$job->salary}}</span></p>
                              @endif
                          </div>
                          <div>
                            <a href="{{route('view.job',$job->id)}}" class="btn btn-check">Details</a>
                          </div>
                      </div>
                  </div>
                  @endforeach

                </div>
                @else
                <h3 class="empty">There are no jobs</h3>
                @endif




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

    $('#searchForm').submit(function (e) {
        e.preventDefault();
        var url = '{{route("find.jobs")}}?' ;
        var keyword = $('#keyword').val();
        var location = $('#location').val();
        var experience = $('#experience').val();
        var checkedJobType =$('#input:checkbox[name="job_type"]:checked').map(function () {
            return $(this).val();
        }).get();
        var sort = $('#sort').val();



        var catergory = $('#catergory').val();

        // keyword has value
        if(keyword != "") {
            url += '&keyword='+keyword;
        }
        if(location != "") {
            url += '&location='+location;
        }
        if(experience != "") {
            url += '&experience='+experience;
        }
        if(checkedJobType.length > 0) {
            url += '&job_type='+checkedJobType;
        }
        if(catergory != "") {
            url += '&catergory='+catergory;
        }
        url += '&sort=' +sort ;
        window.location.href = url;

    });

    $("#sort").change(function () {
        $('#searchForm').submit();
    });
</script>

@endsection

