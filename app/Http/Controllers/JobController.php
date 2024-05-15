<?php

namespace App\Http\Controllers;

use App\Models\Catergory;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function createJob()
    {
        $categories = Catergory::orderBy('name', 'ASC')->where('status', 1)->get();
        $jobType = JobType::orderBy('name', 'ASC')->where('status', 1)->get();
        return view('front.job.create', compact('categories', 'jobType'));
    }

    public function storeJob(Request $request)
    {
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'salary' => 'required',
            'experience' => 'required',
            'benefits' => 'required',
            'responsibility' => 'required',
            'qualifications' => 'required',
            'keyword' => 'required|min:3|max:20',
            'description' => 'required|min:5|max:255',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'company_name' => 'required|min:3|max:75',
            'locationcompany' => 'required|min:3|max:75',
            'website' => 'required|min:3|max:75',
        ]);

        if ($validator->passes()) {
            $job = new Job();

            $job->title = $request->title;
            $job->catergory_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->user_id = $id;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->experience = $request->experience;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keyword;
            $job->company_name = $request->company_name;
            $job->company_location = $request->locationcompany;
            $job->company_website = $request->website;

            $job->save();

            Session()->flash('success', 'Job Added successfully. ');

            return response()->json([
                'status' => false,
                'errors' => []
            ]);
        } else {
            return response()->json(
                [
                    'status' => true,
                    'errors' => $validator->errors()
                ]
            );
        }
    }


    public function myJobs()
    {
        $id = Auth::user()->id;
        $jobs = Job::where('user_id', $id)->with('jobType')->orderBy('created_at','DESC')->paginate(5);

        return view('front.job.myjobs', compact('jobs'));
    }

    public function viewjob($id) {


            $job = Job::where(['id'=>$id,'status' => 1])->with(['jobType','catergory'])->first();
            $jobSaveCount = SavedJob::where([
                'job_id' => $id
            ])->count();

            $applications = JobApplication::where('job_id',$id)->with('user')->get();
            // dd($applications);

            return view('front.job.jobDetail',compact('job','jobSaveCount','applications'));

    }


    public function editJob($id)
    {
        $categories = Catergory::orderBy('name', 'ASC')->where('status', 1)->get();
        $jobType = JobType::orderBy('name', 'ASC')->where('status', 1)->get();
        $job = Job::where('id', $id)->first();
        if($job == null) {
            abort(404);
        }else {
            return view('front.job.editJob', compact('categories', 'jobType','job'));
        }
    }


    public function updateJob(Request $request , $id) {
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'salary' => 'required',
            'experience' => 'required',
            'benefits' => 'required',
            'responsibility' => 'required',
            'qualifications' => 'required',
            'keyword' => 'required|min:3|max:20',
            'description' => 'required|min:5|max:255',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'company_name' => 'required|min:3|max:75',
            'locationcompany' => 'required|min:3|max:75',
            'website' => 'required|min:3|max:75',
        ]);

        if ($validator->passes()) {
            $job = Job::find($id);

            $job->title = $request->title;
            $job->catergory_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->user_id = $id;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->experience = $request->experience;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keyword;
            $job->company_name = $request->company_name;
            $job->company_location = $request->locationcompany;
            $job->company_website = $request->website;

            $job->update();

            Session()->flash('success', 'Job updated successfully. ');

            return response()->json([
                'status' => false,
                'errors' => []
            ]);
        } else {
            return response()->json(
                [
                    'status' => true,
                    'errors' => $validator->errors()
                ]
            );
        }
    }



    public function deletejob (Request $request) {
        $job = Job::where('id',$request->jobId)->first();
        if($job == null) {
            Session()->flash('error','Either Job Delete Or Not Found.');
            return response()->json([
                'status'=> true ,

            ]);
        }else {
            Job::where('id' , $request->jobId)->delete();
            Session()->flash('success','Job Deleted Successfully.');
        }

    }





}
