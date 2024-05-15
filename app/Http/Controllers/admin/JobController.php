<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Catergory;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function index () {
        $jobs = Job::orderBy('created_at','DESC')->with('user')->get();
        return view('admin.jobs',compact('jobs'));
    }

    public function editJob ($id) {
        $categories = Catergory::orderBy('name', 'ASC')->where('status', 1)->get();
        $jobType = JobType::orderBy('name', 'ASC')->where('status', 1)->get();
        $job = Job::find($id);
        return view('admin.editJob',compact('job','categories','jobType'));
    }
    public function updateJob(Request $request , $id) {
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
            'isFeatured'=> 'required',
            'status'=> 'required',
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
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->experience = $request->experience;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keyword;
            $job->isFeatured = (!empty($request->isFeatured)) ? $request->isFeatured : 0;
            $job->status = (!empty($request->status)) ? $request->status : 0;
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


    public function destroy(Request $request) {
        $id = $request->id;
        $job = Job::find($id);
        if($job == null) {
            session()->flash('error','job Not Found');
            return response()->json([
                'status'=> false
            ]);
        }
        $job->delete();
        session()->flash('success','Job Delete Successfully');
            return response()->json([
                'status'=> true
            ]);

    }



}
