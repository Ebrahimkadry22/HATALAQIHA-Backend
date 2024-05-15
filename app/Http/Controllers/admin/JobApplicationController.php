<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    function index() {
        $jobApplications = JobApplication::orderby('created_at','DESC')->with('job','user','employer')->get();
        return view('admin.jobApplication',compact('jobApplications'));
    }
}
