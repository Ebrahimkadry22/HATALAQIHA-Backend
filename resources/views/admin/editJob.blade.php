@extends('front.layout.app')
@section('main')
<!-- Account Settings -->
<div class="seaction account">
    <div class="container">

      <div class="links">
        <ul>
            <li><a href="index.html"><i class="fa-solid fa-home"></i>Home</a></li>
            <li> / Edit Job</li>
        </ul>
      </div>

      <div class="row">
        @include('admin.sidebar')
        <div>
            @include('front.message')
            <div class="box">
                <div class="heading-form">
                  <h3>Edit Job</h3>
                </div>
                <div class="form">
                  <form  id="admineditjob" method="post">

                    <div class="row">
                      <div>
                        <div>
                          <label for="">Job Title</label>
                          <input type="text" value="{{$job->title}}" name="title" id="title" placeholder="Job title">
                          <p></p>
                        </div>
                        <div>
                          <label for="">Job Nature</label>
                          <select name="jobType" id="jobType">
                            <option value="">Select a Job Type</option>
                            @if ($jobType->isNotEmpty())
                            @foreach ($jobType as $jobType )
                            <option {{ $job->job_type_id == $jobType->id ? 'selected':""  }} value="{{$jobType->id}}">{{$jobType->name}}</option>
                            @endforeach

                            @endif
                         </select>
                         <p></p>
                        </div>
                        <div>
                          <label for="">Salary</label>
                          <input type="text"salary" value="{{$job->salary}}" name="salary" id="salary" placeholder="Salary">
                          <p></p>
                        </div>
                      </div>
                      <div>
                        <div>
                          <label for="">Category</label>
                          <select name="category" id="category">
                          <option value="">Select a Category</option>
                          @if ($categories->isNotEmpty())
                          @foreach ($categories as $category )
                          <option {{ $job->catergory_id == $category->id ? 'selected':""  }} value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach

                          @endif
                         </select>
                         <p></p>
                        </div>
                        <div>
                          <label for="">Vacancy</label>
                          <input type="text" placeholder="Vacancy" value="{{$job->vacancy}}" id="vacancy" name="vacancy">
                          <p></p>
                        </div>
                        <div>
                          <label for="">Location</label>
                          <input type="text" placeholder="Location" value="{{$job->location}}" id="location" name="location">
                          <p></p>
                        </div>
                      </div>
                    </div>
                    <div>
                        <label for="">Experience</label>
                        <select name="experience" id="experience">
                        <option >Experience</option>

                        @for ($i = 1 ; $i <= 10 ; $i++)
                        <option {{ $job->experience == $i ? 'selected':""  }} value="{{$i}}">{{$i}} Years</option>
                        @endfor

                       </select>
                       <p></p>
                      </div>
                      <div>
                        <label for="">Featured</label>
                        <select name="isFeatured" id="status">
                         @for ($i = 0 ; $i <= 1 ; $i++)
                     <option {{ $job->isFeatured == $i ? 'selected':""  }} value="{{$i}}">{{1 == $i ? 'Featured':"normal"}}</option>

                         @endfor

                        </select>
                        <p></p>
                      </div>
                      <div>
                        <label for="">status</label>
                        <select name="status" id="status">
                         @for ($i = 0 ; $i <= 1 ; $i++)
                     <option {{ $job->status == $i ? 'selected':""  }} value="{{$i}}">{{1 == $i ? 'Active':"Block"}}</option>

                         @endfor

                        </select>
                        <p></p>
                      </div>
                    <div>
                      <label for="">Description</label>
                      <textarea  rows="7" placeholder="Description" name="description" id="description">{{$job->description}}</textarea>
                      <p></p>
                    </div>
                    <div>
                      <label for="">Benefits</label>
                      <textarea  rows="7" placeholder="Benefits" name="benefits" id="benefits">{{$job->benefits}}</textarea>
                      <p></p>
                    </div>
                    <div>
                      <label for="">Responsibility</label>
                      <textarea rows="7" placeholder="Responsibility" name="responsibility" id="responsibility">{{$job->responsibility}}</textarea>
                      <p></p>
                    </div>
                    <div>
                      <label for="">Qualifications</label>
                      <textarea  rows="7" placeholder="Qualifications" name="qualifications" id="qualifications">{{$job->qualifications}}</textarea>
                      <p></p>
                    </div>
                    <div>
                      <label for="">Keywords</label>
                      <input type="text" placeholder="Keywords" value="{{$job->keywords}}" name="keyword" id="keyword">
                      <p></p>
                    </div>
                    <div class="heading-form">
                      <h3>Company Details</h3>
                    </div>
                    <div class="row">
                      <div>
                        <label for="">Name</label>
                        <input type="text" placeholder="Company Name" value="{{$job->company_name}}" name="company_name" id="companyname">
                        <p></p>
                      </div>
                      <div>
                        <label for="">Location</label>
                        <input type="text" placeholder="Location" value="{{$job->company_location}}" name="locationcompany" id="locationcompany">
                        <p></p>
                      </div>
                    </div>
                    <div>
                      <label for="">Website</label>
                      <input type="text" placeholder="Website" value="{{$job->company_website}}" name="website" id="website">
                      <p></p>
                    </div>
                    <div>
                      <button class="btn btn-check" type="submit">Update Job</button>
                    </div>
                  </form>
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
$("#admineditjob").submit(function(e){
    e.preventDefault();
    console.log($("#FormPost").serializeArray());
    $.ajax({
        url: "{{route('admin.update.job',$job->id)}}",
        type : "put",
        dataType : 'json',
        data : $("#admineditjob").serializeArray(),
        success : function (response) {
            var errors = response.errors;
            if(response.status === true) {
                if(errors.title) {
                    $("#title").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.title);
                }else {
                $("#title").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.category) {
                    $("#category").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.category);
                }else {
                $("#category").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.salary) {
                    $("#salary").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.salary);
                }else {
                $("#salary").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.jobType) {
                    $("#jobType").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.jobType);
                }else {
                $("#jobType").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.location) {
                    $("#location").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.location);
                }else {
                $("#location").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.experience) {
                    $("#experience").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.experience);
                }else {
                $("#experience").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.description) {
                    $("#description").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.description);
                }else {
                $("#description").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.benefits) {
                    $("#benefits").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.benefits);
                }else {
                $("#benefits").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.responsibility) {
                    $("#responsibility").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.responsibility);
                }else {
                $("#responsibility").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.qualifications) {
                    $("#qualifications").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.qualifications);
                }else {
                $("#qualifications").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.keyword) {
                    $("#keyword").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.keyword);
                }else {
                $("#keyword").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }

                if(errors.vacancy) {
                    $("#vacancy").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.vacancy);
                }else {
                $("#vacancy").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.isFeatured) {
                    $("#isFeatured").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.isFeatured);
                }else {
                $("#isFeatured").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.status) {
                    $("#status").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.status);
                }else {
                $("#status").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.company_name) {
                    $("#companyname").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.company_name);
                }else {
                $("#companyname").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.locationcompany) {
                    $("locationcompany").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.locationcompany);
                }else {
                $("locationcompany").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }
                if(errors.website) {
                    $("website").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.website);
                }else {
                $("website").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                }

            }else {
                $("#title").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                $("#vacancy").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                $("#category").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                $("#jobType").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                $("#location").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                $("#isFeatured").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                $("#status").removeClass('is-invalid').siblings('p').addClass('valid').html('');
                $("#companyname").removeClass('is-invalid').siblings('p').addClass('valid').html('');

                window.location.href="{{route('admin.jobs')}}"
            }
        }
    })



});
</script>

@endsection


