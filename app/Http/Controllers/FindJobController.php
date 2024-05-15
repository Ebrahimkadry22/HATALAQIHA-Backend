<?php

namespace App\Http\Controllers;

use App\Models\Catergory;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;

class FindJobController extends Controller
{
    public function index (Request $request) {
        $catergories = Catergory::where('status',1)->get();

        $jobType = JobType::where('status',1)->get();
        $jobs = Job::where('status',1);

        // search keyword
        if(!empty($request->keyword)) {
            $jobs =$jobs->where(function ($query) use ($request) {
                $query->orWhere('title','like','%'.$request->keyword.'%');
                $query->orWhere('keywords','like','%'.$request->keyword.'%');
            });
            // dd($jobs);
        }

        // search location
        if(!empty($request->location)) {
            $jobs =$jobs->where('location','like','%'.$request->location.'%');
        }

        // search job Type
        $jobArray = [];
        if(!empty($request->job_type)) {
            $jobArray = explode(',' , $request->job_type);
            $jobs =$jobs->whereIn('job_type_id',$jobArray);
        }


        if(!empty($request->catergory)) {

            $jobs =$jobs->where('catergory_id',$request->catergory);
        }
        // dd($jobArray);

        //search experience
        if(!empty($request->experience)) {
            $jobs =$jobs->where('experience',$request->experience);
        }

        if(!empty($request->sort) ) {
            $jobs = $jobs->orderBy('created_at','ASC');
        }else {
            $jobs = $jobs->orderBy('created_at','DESC');

        }



        $jobs = $jobs->with('jobType','catergory')
        ->orderBy('created_at','DESC')->get();




        return view('front.job.findJob' ,compact('catergories','jobType','jobs' , 'jobArray'));
    }
}
