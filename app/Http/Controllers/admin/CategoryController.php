<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Catergory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index () {
        $categories = Catergory::orderBy('created_at','DESC')->get();
        return view('admin.category',compact('categories'));
    }

    public function createCategory () {
        return view('admin.addCategory');
    }

    function addCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:200',
            'status' => 'required|integer'
        ]);

        if($validator->passes()) {
            $category = new Catergory();

            $category->name = $request->name;
            $category->status = $request->status;
            $category->save();
            Session()->flash('success', 'category add successfully. ');

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


    public function editCategory($id) {
        $category = Catergory::find($id);
        return view('admin.editCategory',compact('category'));
    }

    function updateCategory(Request $request , $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:200',
            'status' => 'required|integer'
        ]);

        if($validator->passes()) {
            $category = Catergory::find($id);

            $category->name = $request->name;
            $category->status = $request->status;
            $category->update();
            Session()->flash('success', 'category updated successfully. ');

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
        $job = Catergory::find($id);
        if($job == null) {
            session()->flash('error','Category Not Found');
            return response()->json([
                'status'=> false
            ]);
        }
        $job->delete();
        session()->flash('success','Category Delete Successfully');
            return response()->json([
                'status'=> true
            ]);

    }
}
