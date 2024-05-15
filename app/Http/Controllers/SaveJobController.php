<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveJobController extends Controller
{
    public function saveJob (Request $request ) {
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


        $jobSaveCount = SavedJob::where([
            'user_id' => $uesr_id,
            'job_id' => $id
        ])->count();

        if($jobSaveCount > 0 ) {
            $message = 'You alread Saved on this job';
            Session()->flash('error',$message);
            return response()->json([
                'error' => false ,
                'message' => $message
            ]);
        }



        $saveJob = new SavedJob();
        $saveJob->job_id = $id;
        $saveJob->user_id = $uesr_id;

        $saveJob->save();
        // send notification email to employer

        $message = 'You have successfully Saved on This Job.';
            Session()->flash('success',$message);
            return response()->json([
                'error' => true ,
                'message' => $message
            ]);
        }


        // page Saved Job
        function mySavedJobs ()  {
            $uesrId = Auth::user()->id;

            $savedJobs = SavedJob::where(
                'user_id' , $uesrId,
            )->with(['job','job.jobtype','job.applications'])->orderBy('created_at','DESC')->get();
            // dd($savedJobs);
            return view('front.job.mySavedJobs' , compact('savedJobs'));
        }

         // delete Apply job
    public function removeJobs(Request $request)  {
        $jobId = $request->id;

        // dd($jobId);
        $userId = Auth::user()->id;
        $jobApplication = SavedJob::where(['id'=>$jobId,'user_id'=>$userId])->first();

        if($jobApplication == null) {
            session()->flash('error','Job saved not found.');
            return response()->json([
                'status'=> false,

            ]);
        }

        SavedJob::find($jobId)->delete();
        session()->flash('success','Job Saved removed success');
        return response()->json([
            'status'=> true,

        ]);
    }

    }
