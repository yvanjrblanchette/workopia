<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    /* --- DASHBOARD PAGE --- */
    // @desc: Show the dashboard page
    // @route: GET /dashboard
    public function dashboard(): View
    {
        // Get current user
        $user = Auth::user();

        // Get companies for the current user
        $companies = Company::where('user_id', $user->id)->get();
        $company = $companies->first();

        // Get jobs for the current user
        $jobs = Job::where('user_id', $user->id)->get();

        return view('pages.dashboard', compact('user', 'jobs', 'companies', 'company'));
    }
}
