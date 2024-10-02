<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /* --- HOME PAGE --- */
    // @desc: Show the home page
    // @route: GET /
    public function home(): View
    {
        $jobs = Job::latest()->limit(6)->get();

        return view('pages.home')->with('jobs', $jobs);
    }
}
