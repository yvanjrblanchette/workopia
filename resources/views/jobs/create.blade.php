<x-root-layout>
    <x-slot name="title">Create Job Listing</x-slot>
    <div class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-5xl">
        <h2 class="text-4xl text-center font-bold mb-4">
            Create Job Listing
        </h2>
        <form method="POST" action="{{ route('jobs.store') }}" enctype="multipart/form-data" x-data="{ existingCompany: false }">
            @csrf

            <h2 class="text-2xl font-bold mb-2 text-center text-pumpkin-550/50">
                Job Information
            </h2>

            <x-input id="title" name="title" label="Job Title" type="text" placeholder="Software Engineer"
                className="mb-4 space-y-1" required />

            <x-text-area id="job_description" name="job_description" label="Job Description"
                placeholder="We are seeking a skilled and motivated Software Developer to join our growing development team..."
                className="mb-4 space-y-1" required />

            <x-input id="salary" name="salary" label="Annual Salary" type="number" placeholder="90000"
                className="mb-4 space-y-1" required />

            <x-text-area id="requirements" name="requirements" label="Requirements"
                placeholder="Bachelor's degree in Computer Science" className="mb-4 space-y-1" rows='3'
                required />

            <x-text-area id="benefits" name="benefits" label="Benefits"
                placeholder="Health insurance, 401k, paid time off" className="mb-4 space-y-1" rows="3"
                required />

            <x-input id="tags" name="tags" label="Tags (comma-separated)" type="text"
                placeholder="development, coding, java, python" className="mb-4 space-y-1" />

            <x-select id="job_type" name="job_type" label="Job Type" value="{{ old('job_type') }}" :options="[
                'Full-Time' => 'Full-Time',
                'Part-Time' => 'Part-Time',
                'Contract' => 'Contract',
                'Temporary' => 'Temporary',
                'Internship' => 'Internship',
                'Volunteer' => 'Volunteer',
                'On-Call' => 'On-Call',
            ]"
                className="mb-4 space-y-1" required />

            <x-select id="remote" name="remote" label="Remote" value="{{ old('remote') }}" :options="[0 => 'No', 1 => 'Yes']"
                className="mb-4 space-y-1" required />

            <!-- Show existing company section only if companies are available -->
            @if ($companies->isNotEmpty())
                <div class="mb-4">
                    <!-- Checkbox for Existing Company -->
                    <label for="existingCompany" class="inline-flex items-center">
                        <input type="checkbox" id="existingCompany" name="existingCompany" x-model="existingCompany"
                            value="1" {{ old('existingCompany') == 1 ? 'checked' : '' }} class="mr-2">
                        <span>Existing Company</span>
                    </label>
                </div>

                <!-- Show select box for companies when checkbox is checked -->
                <div x-show="existingCompany" x-cloak>
                    <x-select id="company_select" name="company_select" label="Select a Company"
                        value="{{ old('company_select') ?? '' }}" :options="$companies->pluck('name', 'id')->toArray()" className="mb-4 space-y-1"
                        required />
                </div>
            @endif

            <!-- Show company creation form if no existing company is selected -->
            <div x-show="!existingCompany" x-cloak>
                <h2 class="text-2xl font-bold mt-10 mb-2 text-center text-pumpkin-550/50">
                    Company Information
                </h2>

                <x-input id="name" name="name" label="Company Name" type="text"
                    placeholder="Enter company name" className="mb-4 space-y-1" required />

                <x-text-area id="description" name="description" label="Company Description"
                    placeholder="Enter company description" className="mb-4 space-y-1" required />

                <x-input id="website" name="website" label="Company Website" type="url"
                    placeholder="Enter website" className="mb-4 space-y-1" />

                <x-input id="contact_phone" name="contact_phone" label="Contact Phone" type="phone"
                    placeholder="123-456-7890" className="mb-4 space-y-1" />

                <x-input id="contact_email" name="contact_email" label="Contact Email" type="email"
                    placeholder="Email for job applications" className="mb-4 space-y-1" required />

                <x-input id="address" name="address" label="Address" type="text" placeholder="123 Main St"
                    className="mb-4 space-y-1" />

                <x-input id="city" name="city" label="City" type="text" placeholder="Albany"
                    className="mb-4 space-y-1" required />

                <x-input id="state" name="state" label="State" type="text" placeholder="NY"
                    className="mb-4 space-y-1" required />

                <x-input id="zipcode" name="zipcode" label="ZIP Code" type="text" placeholder="12345"
                    className="mb-4 space-y-1" />

                <x-file id="logo" name="logo" label="Company Logo" className="mb-8 space-y-1" />
            </div>

            <button type="submit"
                class="w-full mt-10 bg-marine-700 hover:bg-pumpkin-550 text-white font-bold py-2 px-4 rounded-full transition-all">
                <i class="fas fa-plus mr-2"></i>
                Create Job
            </button>
        </form>
    </div>
</x-root-layout>
