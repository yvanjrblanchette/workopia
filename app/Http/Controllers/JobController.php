<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Job;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

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
        $jobs = Job::with('company')->paginate(6);

        return view('jobs.index')->with('jobs', $jobs);
    }



    /**
     * @name: CREATE
     * @desc: Show the form for creating a new resource.
     * @route: GET /jobs/create
     */
    public function create(): View
    {
        $companies = Company::where('user_id', Auth::id())->orderBy('name', 'asc')->get();

        return view('jobs.create')->with('companies', $companies);
    }



    public function store(Request $request): RedirectResponse
    {
        // Ensure the user is authenticated before proceeding
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to post a job.');
        }
    
        // Check if the user selected an existing company
        $existingCompany = $request->input('existingCompany') == 1;
    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|min:3',
            'job_description' => 'required|string|min:10',
            'salary' => 'required|integer',
            'requirements' => 'required|string|min:10',
            'benefits' => 'required|string|min:10',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'address' => $existingCompany ? 'nullable' : 'required|string|max:255|min:3',
            'city' => $existingCompany ? 'nullable' : 'required|string|max:255',
            'state' => $existingCompany ? 'nullable' : 'required|string',
            'zipcode' => 'nullable|string|max:255|min:3',
            'name' => $existingCompany ? 'nullable' : 'required|string|max:255|min:3',
            'description' => $existingCompany ? 'nullable' : 'required|string|min:10',
            'website' => 'nullable|url|max:255|min:3',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'contact_email' => $existingCompany ? 'nullable' : 'required|email',
            'contact_phone' => 'nullable|string|max:255|min:3',
            'company_select' => $existingCompany ? 'required|exists:companies,id' : 'nullable',
        ]);
    
        // Handle company creation or retrieval
        if ($existingCompany) {
            $company = Company::findOrFail($validatedData['company_select']);
        } else {
            $company = Company::where('name', $validatedData['name'])->first();
            if (!$company) {
                $companyData = [
                    'name' => $validatedData['name'],
                    'description' => $validatedData['description'],
                    'website' => $validatedData['website'] ?? null,
                    'contact_email' => $validatedData['contact_email'],
                    'contact_phone' => $validatedData['contact_phone'],
                    'address' => $validatedData['address'],
                    'city' => $validatedData['city'],
                    'state' => $validatedData['state'],
                    'zipcode' => $validatedData['zipcode'],
                    'user_id' => auth()->id(),  // Set the user_id
                ];

                if ($request->hasFile('logo')) {
                    $path = $request->file('logo')->store('logos', 'public');
                    $companyData['logo'] = $path;
                }

                $company = Company::create($companyData);
            }
        }
    
        // Create the job and associate it with the company
        Job::create([
            'title' => $validatedData['title'],
            'job_description' => $validatedData['job_description'],
            'salary' => $validatedData['salary'],
            'requirements' => $validatedData['requirements'],
            'benefits' => $validatedData['benefits'],
            'tags' => $validatedData['tags'],
            'job_type' => $validatedData['job_type'],
            'remote' => $validatedData['remote'],
            'user_id' => auth()->id(),
            'company_id' => $company->id,
        ]);
    
        return redirect()->route('jobs.index')->with('success', 'Job listing created successfully!');
    }
    






    /**
     * @name: SHOW
     * @desc: Display the specified resource.
     * @route: GET /jobs/{id}
     */
    public function show(Job $job): View
    {
        // Eager load the company data
        $job->load('company');

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
