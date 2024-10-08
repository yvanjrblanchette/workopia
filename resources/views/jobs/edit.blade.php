<x-root-layout>
    <x-slot name=title>Edit Job Listing</x-slot>
    <a class="block p-4 text-marine-700 hover:text-pumpkin-550 transition duration-300 font-medium  mx-auto md:max-w-5xl"
        href="{{ route('jobs.destroy', $job->id) }}">
        <i class="fa fa-arrow-alt-circle-left"></i>
        Back To Listing
    </a>
    <div class="bg-white mx-auto p-8 shadow-md w-full md:max-w-5xl">
        <h2 class="text-4xl text-center font-bold mb-4">
            Edit Job Listing
        </h2>
        <form method="POST" action="{{ route('jobs.update', $job->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h2 class="text-2xl font-bold mb-2 text-center text-pumpkin-550/50">
                Job Informations
            </h2>

            <x-input id="title" name="title" label="Job Title" type="text" placeholder="Software Engineer"
                :value="old('title', $job->title)" className="mb-4 space-y-1" required />

            <x-text-area id="description" name="description" label="Job Description"
                placeholder="We are seeking a skilled and motivated Software Developer to join our growing development team..."
                :value="old('description', $job->description)" className="mb-4 space-y-1" required />

            <x-input id="salary" name="salary" label="Annual Salary" type="number" placeholder="90000"
                :value="old('salary', $job->salary)" className="mb-4 space-y-1" required />

            <x-text-area id="requirements" name="requirements" label="Requirements"
                placeholder="Bachelor's degree in Computer Science" :value="old('requirements', $job->requirements)" className="mb-4 space-y-1"
                rows='3' required />

            <x-text-area id="benefits" name="benefits" label="Benefits"
                placeholder="Health insurance, 401k, paid time off" :value="old('benefits', $job->benefits)" className="mb-4 space-y-1"
                rows="3" required />

            <x-input id="tags" name="tags" label="Tags (comma-separated)" type="text"
                placeholder="development, coding, java, python" :value="old('tags', $job->tags)" className="mb-4 space-y-1" />


            <x-select id="job_type" name="job_type" label="Job Type" :options="[
                'Full-Time' => 'Full-Time',
                'Part-Time' => 'Part-Time',
                'Contract' => 'Contract',
                'Temporary' => 'Temporary',
                'Internship' => 'Internship',
                'Volunteer' => 'Volunteer',
                'On-Call' => 'On-Call',
            ]" :value="old('job_type', $job->job_type)"
                className="mb-4 space-y-1" required />

            <x-select id="remote" name="remote" label="Remote" :options="[0 => 'No', 1 => 'Yes']" :value="old('remote', $job->remote)"
                className="mb-4 space-y-1" required />

            <x-input id="address" name="address" label="Address" type="text" placeholder="123 Main St"
                :value="old('address', $job->address)" className="mb-4 space-y-1" />

            <x-input id="city" name="city" label="City" type="text" placeholder="Albany" :value="old('city', $job->city)"
                className="mb-4 space-y-1" required />

            <x-input id="state" name="state" label="State" type="text" placeholder="NY" :value="old('state', $job->state)"
                className="mb-4 space-y-1" required />

            <x-input id="zipcode" name="zipcode" label="ZIP Code" type="text" placeholder="12345"
                :value="old('zipcode', $job->zipcode)" className="mb-4 space-y-1" />
            <div class="border-b pb-10"></div>

            <h2 class="text-2xl font-bold mt-10 mb-2 text-center text-pumpkin-550/50">
                Company Informations
            </h2>

            <x-input id="company_name" name="company_name" label="Company Name" type="text" placeholder="workscout"
                :value="old('company_name', $job->company_name)" className="mb-4 space-y-1" required />

            <x-text-area id="company_description" name="company_description" label="Company Description"
                placeholder="We are looking for talented developers to join our team." required :value="old('company_description', $job->company_description)"
                className="mb-4 space-y-1" rows="3" />

            <x-input id="company_website" name="company_website" label="Company Website" type="url"
                placeholder="Enter website" :value="old('company_website', $job->company_website)" className="mb-4 space-y-1" />

            <x-input id="contact_phone" name="contact_phone" label="Contact Phone" type="phone"
                placeholder="123-456-7890" :value="old('contact_phone', $job->contact_phone)" className="mb-4 space-y-1" />

            <x-input id="contact_email" name="contact_email" label="Contact Email" type="email"
                placeholder="Email where you want to receive job applications" :value="old('contact_email', $job->contact_email)"
                className="mb-4 space-y-1" required />

            <x-file id="company_logo" name="company_logo" label="Company Logo" className="mb-8 space-y-1" />

            <x-button type="submit" label="Edit Job Listing" icon="fa-solid fa-pen-to-square"></x-button>
        </form>
    </div>
</x-root-layout>
