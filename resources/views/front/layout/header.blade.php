<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{csrf_token()}}" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css" integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('asstes/css/style.css')}}" >
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <title>Jobs</title>
</head>
<body>

  <!-- navbar -->
  <nav class="nav ">
    <div class="container">
      <div class="navbar">
        <div class="logo">
          <a href="{{route('home')}}"><span>hatalaqiha</span></a>
         </div>

         <div class="lists">
          <ul>
            <li><a href="{{ route("home")}}" class="{{Request::is('/') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{route('find.jobs')}}" class="{{Request::is('find-jobs') ? 'active' : '' }}">find jobs</a></li>

            </ul>
          <div class="left">
           <ul>
            @if (!Auth::check())
            <li><a href="{{route('accountlogin')}}" ><button class="btn btn-check">login</button></a></li>
            <li><a href="{{route('registration')}}" ><button class="btn btn-no-check">registra</button></a></li>
            @else
            @if (Auth::user()->role == 'admin')
            <li><a href="{{route('admin.dasboard')}}" ><button class="btn btn-check">Admin</button></a></li>
            @endif
            <li><a href="{{route('account.profile')}}" ><button class="btn btn-check">Profile</button></a></li>
            <li><a href="{{route('create.post')}}" ><button class="btn btn-no-check">post a job</button></a></li>
            <li><a href="{{route('account.logout')}}" ><button class="btn btn-logout">logout</button></a></li>
            @endif



           </ul>
          </div>
         </div>

         <div class="icon-bar">
           <i class="fa-solid fa-bars" id="bar"></i>
         </div>
      </div>


    </div>
  </nav>
