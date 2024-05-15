<div>


    <div class="box">
      <ul class="sidebar">
        <li><a href="{{route('admin.users')}}" class="{{Request::is('admin/users') ? "active" : ''}}">Users</a></li>
        <li><a href="{{route('admin.jobs')}}" class="{{Request::is('admin/jobs') ? "active" : ''}}">Jobs</a></li>
        <li><a href="{{route('admin.jobApplication')}}" class="{{Request::is('admin/jobApplication') ? "active" : ''}}">Job Applications</a></li>
        <li><a href="{{route('admin.category')}}" class="{{Request::is('admin/category') ? "active" : ''}}">Categories</a></li>
        <li><a href="{{route('admin.jobType')}}" class="{{Request::is('admin/jobType') ? "active" : ''}}">Job Type</a></li>
        <li class="logout"><a href="{{route('account.logout')}}">Logout</a></li>
      </ul>
    </div>

  </div>

