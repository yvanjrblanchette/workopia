<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests;

    /**
     * @name: INDEX
     * @desc: Display a listing of the resource.
     * @route: GET /jobs
     */
    public function index(): View
    {
        $jobs = Job::paginate(6);

        return view('jobs.index')->with('jobs', $jobs);
    }



    /**
     * @name: CREATE
     * @desc: Show the form for creating a new resource.
     * @route: GET /jobs/create
     */
    public function create(): View
    {
        return view('jobs.create');
    }



    /**
     * @name: STORE
     * @desc: Store a newly created resource in storage.
     * @route: POST /jobs
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|min:3',
            'description' => 'required|string|min:10',
            'salary' => 'required|integer',
            'requirements' => 'required|string|min:10',
            'benefits' => 'required|string|min:10',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'address' => 'nullable|string|max:255|min:3',
            'city' => 'required|string|max:255',
            'state' => 'required|string',
            'zipcode' => 'nullable|string|max:255|min:3',
            'company_name' => 'required|string|max:255|min:3',
            'company_description' => 'required|string|min:10',
            'company_website' => 'nullable|url|max:255|min:3',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:255|min:3',
        ]);

        // Hardcoded user_id
        $validatedData['user_id'] = auth()->user()->id;

        // Check for image
        if ($request->hasFile('company_logo')) {
            // Store the file and get the path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path the validated data array
            $validatedData['company_logo'] = $path;
        }

        // Insert the data into the database
        Job::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('jobs.index')->with('success', 'Job listing created successfully!');
    }



    /**
     * @name: SHOW
     * @desc: Display the specified resource.
     * @route: GET /jobs/{id}
     */
    public function show(Job $job): View
    {
        return view('jobs.show')->with('job', $job);
    }



    /**
     * @name: EDIT
     * @desc: Show the form for editing the specified resource.
     * @route: GET /jobs/{id}/edit
     */
    public function edit(Job $job): View
    {
        // Check if user is authorized to view the job listing edit form
        $this->authorize('update', $job);

        return view('jobs.edit')->with('job', $job);
    }



    /**
     * @name: UPDATE
     * @desc: Update the specified resource in storage.
     * @route: POST /jobs/{id}
     */
    public function update(Request $request, Job $job): RedirectResponse
    {
        // Check if user is authorized to update the job listing
        $this->authorize('update', $job);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|min:3',
            'description' => 'required|string|min:10',
            'salary' => 'required|integer',
            'requirements' => 'required|string|min:10',
            'benefits' => 'required|string|min:10',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'address' => 'nullable|string|max:255|min:3',
            'city' => 'required|string|max:255|min:3',
            'state' => 'required|string',
            'zipcode' => 'nullable|string|max:255|min:3',
            'company_name' => 'required|string|max:255|min:3',
            'company_description' => 'required|string|min:10',
            'company_website' => 'nullable|url|max:255|min:3',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:255|min:3',
        ]);

        // Check for image
        if ($request->hasFile('company_logo')) {
            // Delete the old image
            Storage::delete('public/logos/' . basename($job->company_logo));

            // Store the file and get the path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path the validated data array
            $validatedData['company_logo'] = $path;
        }

        // Insert the data into the database
        $job->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('jobs.index', $job->id)->with('success', 'Job listing updated successfully!');
    }



    /**
     * @name: DELETE
     * @desc: Remove the specified resource from storage.
     * @route: POST /jobs/{id}
     */
    public function destroy(Job $job)
    {
        // Check if user is authorized to delete the job listing
        $this->authorize('delete', $job);

        // If logo, then delete it
        if ($job->company_logo) {
            Storage::delete('public/logos/' . $job->company_logo);
        }

        $job->delete();

        // Check the origine of the request
        if (request()->query('from') === 'dashboard') {
            return redirect()->route('dashboard')->with('success', 'Job listing deleted successfully!');
        }

        // Redirect to the index page with a success message
        return redirect()->route('jobs.index')->with('success', 'Job listing deleted successfully!');
    }
}
