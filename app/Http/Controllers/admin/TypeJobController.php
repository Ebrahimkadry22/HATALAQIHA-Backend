<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeJobController extends Controller
{
    public function index () {
        $jobTypes = JobType::orderBy('created_at','DESC')->get();
        return view('admin.typeJob',compact('jobTypes'));
    }
    public function createTypeJob() {
        return view('admin.addTypejob');
    }


    function addTypejob(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:200',
            'status' => 'required|integer'
        ]);

        if($validator->passes()) {
            $jobType = new JobType();

            $jobType->name = $request->name;
            $jobType->status = $request->status;
            $jobType->save();
            Session()->flash('success', 'TypeJob add successfully. ');

            return response()->json([
                'status' => false,
                'errors' => []
            ]);
        }else {
            return response()->json(
                [
                    'status' => true,
                    'errors' => $validator->errors()
                ]
            );
        }
    }

    public function editTypeJob($id) {
        $jobType = JobType::find($id);
        return view('admin.editjobType',compact('jobType'));
    }

    function updateTypeJob(Request $request , $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:200',
            'status' => 'required|integer'
        ]);

        if($validator->passes()) {
            $jobType = JobType::find($id);

            $jobType->name = $request->name;
            $jobType->status = $request->status;
            $jobType->update();
            Session()->flash('success', 'TypeJob updated successfully. ');

            return response()->json([
                'status' => false,
                'errors' => []
            ]);
        }else {
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
        $jobType = JobType::find($id);
        if($jobType == null) {
            session()->flash('error','TypeJob Not Found');
            return response()->json([
                'status'=> false
            ]);
        }
        $jobType->delete();
        session()->flash('success','TypeJob Delete Successfully');
            return response()->json([
                'status'=> true
            ]);

    }
}
