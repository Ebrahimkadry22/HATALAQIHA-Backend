@extends('front.layout.app')
@section('main')
  <!-- hero -->
  <header>
    <div class="hero">
      <div class="container">
      <div class="content">
        <h1>Find your dream job</h1>
        <p>Thounsands of jobs available.</p>
        <a href=""><button class="btn btn-check">explore Now</button></a>
      </div>
    </div>
   </div>
  </header>

  <!-- search -->
  <div class="seaction search">
    <div class="container">

        <form action="{{route('find.jobs')}}" class="row" method="GET">
            <div>
                <input type="text" name="keyword" id="keyword" placeholder="Keywords">
              </div>
              <div>
                <input type="text" name="location" id="location" placeholder="location">
              </div>
              <div>
               <select name="catergory" id="category">
                <option value="">Select a Category</option>
                @if ($newCatergories->isNotEmpty())
                      @foreach ($newCatergories as $newCatergory )
                      <option value="{{$newCatergory->id}}">{{$newCatergory->name}}</option>
                      @endforeach

                      @endif
               </select>
              </div>
              <div>
                <button class="btn btn-w btn-check" type="submit">Search</button>
              </div>
        </form>

    </div>
  </div>

  <!-- Popular Categories -->

  <div class="seaction categories">
    <div class="container">
      <div class="heading-seaction">
        <h2>Popular Categories</h2>
      </div>
      @if ($catergories->isNotEmpty())
        <div class="row">
        @foreach ( $catergories as $catergory )
        <div class="single-category">
            <a href="{{route('find.jobs').'?catergory='.$catergory->id}}">
              <h3>{{$catergory->name}}</h3>
              <p><span>50</span> Available position</p>
            </a>
          </div>
          @endforeach
        </div>
        @else
        <h3 class="empty">There are no Catergories</h3>
        @endif








    </div>
  </div>

  <!-- Featured Jobs -->

  <div class="seaction Featured-Jobs">
    <div class="container">
      <div class="heading-seaction">
        <h2>Featured Jobs</h2>
      </div>
      <div class="job_listing_area">
        <div class="job_lists">
            @if($featuredJobs->isNotEmpty())
          <div class="row">
            @foreach ($featuredJobs as $featuredJob )

            <div class="card">
                <div class="card-body">
                    <h3>{{$featuredJob->title}}r</h3>
                    <p>{{ Str::words($featuredJob->description,10)}}</p>
                    <div>
                        <p><span><i class="fa-solid fa-location-dot"></i></span><span>{{$featuredJob->location}}</span></p>
                        <p><span><i class="fa-regular fa-clock"></i></span><span>{{$featuredJob->jobType->name}}</span></p>
                        @if (!is_null($featuredJob->salary))
                        <p><span><i class="fa-solid fa-dollar-sign"></i></span><span>{{$featuredJob->salary}}</span></p>
                        @endif
                    </div>
                    <div>
                        <a href="{{route('view.job',$featuredJob->id)}}" class="btn btn-check">Details</a>
                    </div>
                </div>
            </div>
            @endforeach

          </div>
          @else
          <h3 class="empty">There are no jobs</h3>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Latest Jobs -->

  <div class="seaction Latest-Jobs">
    <div class="container">
      <div class="heading-seaction">
        <h2>latest Jobs</h2>
      </div>
      <div class="job_listing_area">
        <div class="job_lists">
            @if( $latestJobs->isNotEmpty())
            <div class="row">
              @foreach ( $latestJobs as  $latestJob )

              <div class="card">
                  <div class="card-body">
                      <h3>{{$latestJob->title}}r</h3>
                      <p>{{ Str::words($latestJob->description,10)}}</p>
                      <div>
                          <p><span><i class="fa-solid fa-location-dot"></i></span><span>{{$latestJob->location}}</span></p>
                          <p><span><i class="fa-regular fa-clock"></i></span><span>{{$latestJob->jobType->name}}</span></p>
                          @if (!is_null($latestJob->salary))
                          <p><span><i class="fa-solid fa-dollar-sign"></i></span><span>{{$latestJob->salary}}</span></p>
                          @endif
                      </div>
                      <div>
                        <a href="{{route('view.job',$latestJob->id)}}" class="btn btn-check">Details</a>
                      </div>
                  </div>
              </div>
              @endforeach

            </div>
            @else
            <h3 class="empty">There are no jobs</h3>
            @endif

        </div>
      </div>
    </div>
  </div>

@endsection
@section('footer')
@include('front.layout.footer')
@endsection


