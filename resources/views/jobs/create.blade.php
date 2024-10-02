<x-root-layout>
    <x-slot name=title>Create Job Listing</x-slot>
  <div
  class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-5xl"
>
  <h2 class="text-4xl text-center font-bold mb-4">
      Create Job Listing
  </h2>
  <form
      method="POST"
      action="{{route('jobs.store')}}"
      enctype="multipart/form-data"
  >
  @csrf
  
      <h2
          class="text-2xl font-bold mb-2 text-center text-yellow-500/50"
      >
          Job Informations
      </h2>

      <x-input id="title" name="title" label="Job Title" type="text" placeholder="Software Engineer" className="mb-4 space-y-1" required />
  
      <x-text-area id="description" name="description" label="Job Description" placeholder="We are seeking a skilled and motivated Software Developer to join our growing development team..." className="mb-4 space-y-1" required  />
      
      <x-input id="salary" name="salary" label="Annual Salary" type="number" placeholder="90000" className="mb-4 space-y-1"  required />

      <x-text-area id="requirements" name="requirements" label="Requirements" placeholder="Bachelor's degree in Computer Science" className="mb-4 space-y-1" rows='3'  required />

      <x-text-area id="benefits" name="benefits" label="Benefits" placeholder="Health insurance, 401k, paid time off" className="mb-4 space-y-1" rows="3"  required />
      
      <x-input id="tags" name="tags" label="Tags (comma-separated)" type="text" placeholder="development, coding, java, python" className="mb-4 space-y-1" />
      

      <x-select id="job_type" name="job_type" label="Job Type" value="{{ old('job_type') }}" :options="['Full-Time' => 'Full-Time', 'Part-Time' => 'Part-Time', 'Contract' => 'Contract', 'Temporary' => 'Temporary', 'Internship' => 'Internship', 'Volunteer' => 'Volunteer', 'On-Call' => 'On-Call']" className="mb-4 space-y-1" required />

      <x-select id="remote" name="remote" label="Remote" value="{{ old('remote') }}" :options="[0 => 'No', 1 => 'Yes']" className="mb-4 space-y-1" required />

      <x-input id="address" name="address" label="Address" type="text" placeholder="123 Main St" className="mb-4 space-y-1" />
      
      <x-input id="city" name="city" label="City" type="text" placeholder="Albany" className="mb-4 space-y-1" required />
      
      <x-input id="state" name="state" label="State" type="text" placeholder="NY" className="mb-4 space-y-1" required />

      <x-input id="zipcode" name="zipcode" label="ZIP Code" type="text" placeholder="12345" className="mb-4 space-y-1" />
      <div class="border-b pb-10"></div>
      
      <h2
          class="text-2xl font-bold mt-10 mb-2 text-center text-yellow-500/50"
      >
          Company Informations
      </h2>

      <x-input id="company_name" name="company_name" label="Company Name" type="text" placeholder="Workopia" className="mb-4 space-y-1" required />

      <x-text-area id="company_description" name="company_description" label="Company Description" placeholder="We are looking for talented developers to join our team." required className="mb-4 space-y-1" rows="3" />

      <x-input id="company_website" name="company_website" label="Company Website" type="url" placeholder="Enter website" className="mb-4 space-y-1" />

      <x-input id="contact_phone" name="contact_phone" label="Contact Phone" type="phone" placeholder="123-456-7890" className="mb-4 space-y-1" />

      <x-input id="contact_email" name="contact_email" label="Contact Email" type="email" placeholder="Email where you want to receive job applications" className="mb-4 space-y-1" required />

      <x-file id="company_logo" name="company_logo" label="Company Logo" className="mb-8 space-y-1" />

      <x-button type="submit" label="Post Job Listing" icon="fa-solid fa-table-list" ></x-button>
  </form>
</div>
</x-root-layout>