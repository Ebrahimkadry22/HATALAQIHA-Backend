@extends('front.layout.app')
@section('main')
    <!-- Account Settings -->
    <div class="seaction account">
        <div class="container">

            <div class="links">
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i>Home</a></li>
                    <li> / Dasboard</li>
                </ul>
            </div>

            <div class="row">
                @include('admin.sidebar')
                <div>

                    <div class="box admin">
                        <img src="{{asset('asstes/image/5031659-removebg-preview.png')}}" alt="">
                    </div>




                </div>
            </div>




        </div>
    </div>

    @include('front.layout.footer')
@endsection
