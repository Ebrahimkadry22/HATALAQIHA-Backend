<?php

namespace App\Http\Controllers;

use App\Mail\JobNotificationEmail;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApplyJob extends Controller
{
    public function applyJob (Request $request ) {
        $uesr_id = Auth::user()->id;
        $id = $request->id ;
        $job = Job::where('id',$id)->first();
        if($job == null) {
            $message = 'job does not exist ';
            Session()->flash('error',$message);
            return response()->json([
                'error' => false ,
                'message' => $message
            ]);
        }
        $employer_id = $job->user_id;
        if($employer_id == Auth::user()->id) {
            $message = 'You can not apply on your own job';
            Session()->flash('error',$message);
            return response()->json([
                'error' => false ,
                'message' => $message
            ]);
        }

        $jobApplicationCount = JobApplication::where([
            'user_id' => $uesr_id,
            'job_id' => $id
        ])->count();

        if($jobApplicationCount > 0 ) {
            $message = 'You alread applied on this job';
            Session()->flash('error',$message);
            return response()->json([
                'error' => false ,
                'message' => $message
            ]);
        }



        $application = new JobApplication();
        $application->job_id = $id;
        $application->user_id = $uesr_id;
        $application->employer_id = $employer_id;
        $application->applied_date = now() ;
        $application->save();
        // send notification email to employer
        // $employer = User::where('id',$employer_id)->first();

        // $mailData = [
        //     'employer' => $employer,
        //     'user'=> Auth::user(),
        //     'job' => $job
        // ];
        // Mail::to($employer->email)->send(new JobNotificationEmail ($mailData));
        $message = 'You have successfully applied';
        Session()->flash('success',$message);
        return response()->json([
            'error' => false,
            'message' => $message
        ]);
    }




    // page Applation Job
    public function myjobApplication()  {
        $userId = Auth::user()->id;
        $jobSApplication = JobApplication::where('user_id',$userId)
        ->with(['job','job.jobType','job.applications'])
        ->get();
        // dd($jobs);
        return view('front.job.myJobApplication',compact('jobSApplication'));
    }

    // delete Apply job
    public function removeJobs(Request $request)  {
        $jobId = $request->Id;
        // dd($jobId);
        $userId = Auth::user()->id;
        $jobApplication = JobApplication::where(['id'=>$jobId,'user_id'=>$userId])->first();

        if($jobApplication == null) {
            session()->flash('error','Job application not found.');
            return response()->json([
                'status'=> false,

            ]);
        }

        JobApplication::find($jobId)->delete();
        session()->flash('success','Job application removed success');
        return response()->json([
            'status'=> true,

        ]);
    }
}
