<?php

namespace App\Http\Controllers;

use App\Models\Catergory;
use App\Models\Job;

class HomeController extends Controller
{
    public function index()
    {
        $catergories = Catergory::where('status', 1)
            ->orderBy('name', 'ASC')
            ->take(8)->get();


        $newCatergories = Catergory::where('status',1)
        ->orderBy('name','ASC')
        ->get();


        $featuredJobs = Job::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->with('jobType')
            ->where('isFeatured', 1)
            ->take(6)->get();

        $latestJobs = Job::where('status', 1)
            ->with('jobType')
            ->orderBy('created_at', 'DESC')
            ->take(6)->get();



        return view('front.home',
        compact(
            'catergories',
             'featuredJobs',
              'latestJobs',
              'newCatergories'
            ));
    }
}
