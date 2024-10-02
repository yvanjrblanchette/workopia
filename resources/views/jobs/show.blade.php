<x-root-layout>
    <x-slot name=title>Job Listing Details</x-slot>
    <main class="container mx-auto max-w-7xl px-4">
        <div class="flex justify-between items-center -mt-6 mb-2">
            <a class="block p-4 text-blue-900 hover:text-yellow-500 transition duration-300 font-medium" href="/jobs">
                <i class="fa fa-arrow-alt-circle-left"></i>
                Back To Listings
            </a>
            
                <div class="flex space-x-3 ml-4">
                    <!-- Edit Button -->
                    <a href="{{ route('jobs.edit', $job->id) }}"
                        class="px-4 py-2 bg-blue-900 hover:bg-yellow-500 text-white font-medium rounded transition duration-200 flex items-center gap-2">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit
                    </a>
                    <!-- Delete Button -->
                    <form method="POST" action="{{ route('jobs.destroy', $job->id) }}" onsubmit="return confirm('Are you sure you want to delete this job?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded transition duration-200 flex items-center gap-2">
                            <i class="fa-solid fa-trash-can"></i>
                            Delete
                        </button>
                    </form>
                </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Job Details Column -->
            <section class="md:col-span-3">
                <div class="w-full h-full shadow-md bg-white p-8 flex flex-col justify-between">
                    <div>
                        <h2 class="text-4xl text-center font-semibold">
                            {{ $job->title }}
                        </h2>
                        <p class="text-sm text-center font-medium">Posted {{ $job->created_at->diffForHumans() }}</p>
                        <p class="text-gray-700 text-lg text-justify mt-6 border-b pb-6">
                            {{ $job->description }}
                        </p>

                        <h3 class="mt-6 text-2xl font-bold mb-2 text-yellow-500">Job Details</h3>
                        <div class="pb-8">
                            <ul class="space-y-1 grid grid-cols-12 mb-6">
                                <div class="col-span-12 md:col-span-4 space-y-1">
                                    {{-- Job Type --}}
                                    <li>
                                        <strong class="mr-2">Job Type:</strong> {{ $job->job_type }}
                                    </li>
                                    
                                    {{-- Remote Work --}}
                                    <li>
                                        <strong class="mr-2">Remote work:</strong> {{ $job->remote ? 'Yes' : 'No' }}
                                    </li>
                                    
                                    {{-- Salary --}}
                                    <li>
                                        <strong class="mr-2">Salary: </strong>${{ number_format($job->salary) }} / year
                                    </li>
                                </div>

                                <div class="col-span-12 md:col-span-8 space-y-1">
                                    {{-- Contact Email --}}
                                    <li>
                                        <a href="mailto:{{ $job->contact_email }}" class="flex items-center gap-3">
                                            <strong>Contact Email:</strong> <span class="text-blue-900 hover:text-yellow-500 font-medium transition flex items-center gap-1"><i class="fa-solid fa-envelope ml-1"></i> {{ $job->contact_email }}</span>
                                        </a>
                                    </li>

                                    {{-- Contact Phone --}}
                                    @if($job->contact_phone)
                                    <li>
                                        <a href="tel:{{ $job->contact_phone }}" class="flex items-center gap-3">
                                            <strong>Contact Phone:</strong> <span class="text-blue-900 hover:text-yellow-500 font-medium transition flex items-center gap-1"><i class="fa-solid fa-phone"></i>{{ $job->contact_phone }}</span>
                                        </a>
                                    </li>
                                    @endif

                                    {{-- Location --}}
                                    <li>
                                        <a href="{{ $job->url }}" class="flex items-center gap-3">
                                            <strong>Location:</strong> <span class="text-blue-900 hover:text-yellow-500 font-medium transition flex items-center gap-1"><i class="fa-solid fa-location-dot"></i> <span>@if( $job->address) {{$job->address}}, @endif{{ $job->city }}, {{ $job->state }}, @if( $job->zipcode) {{$job->zipcode}}@endif</span></span>
                                        </a>
                                    </li>
                                </div>

                                {{-- Tags --}}
                                <li class="col-span-12 mb-2">
                                    <strong>Tags:</strong> {{ucwords(str_replace(',', ', ', $job->tags))}}
                                </li>
                            </ul>

                            <h3 class="text-2xl font-bold mb-1 text-yellow-500">
                                Job Requirements
                            </h3>
                            <p>
                                {{ $job->requirements }}
                            </p>
                            <h3 class="text-2xl font-bold mt-5 mb-1 text-yellow-500">
                                Benefits
                            </h3>
                            <p>
                                {{ $job->benefits }}
                            </p>
                        </div>
                    </div>

                    <a href="mailto:manager@company.com" class="text-center shadow rounded-full bg-blue-900 hover:bg-yellow-500 text-white transition py-2">
                        <i class="fa-solid fa-file-lines text-xl"></i>
                        Apply Now
                    </a>
                </div>
            </section>

            <!-- Sidebar -->
            <aside class="bg-white shadow-md p-8">
                <a href="{{ $job->company_website }}" target="_blank" title="Visit {{ $job->company_name }}'s website">
                    @if($job->company_logo)
                    <div class="mx-auto w-[200px] h-auto">
                        <img src="/storage/{{ $job->company_logo }}" alt="{{ $job->company_name }}"
                        class="w-full rounded-full mb-4 m-auto" />
                    </div>
                    @endif
                    <h4 class="text-2xl font-bold text-center">{{ $job->company_name }}</h4>
                    @if($job->company_description)
                    <p class="text-gray-700 text-center my-3">{{ $job->company_description }}</p>
                    @endif
                </a>
                <a href=""
                    class="mt-10 bg-blue-900 hover:bg-yellow-500 transition text-white font-bold w-full py-2 px-4 rounded-full flex items-center justify-center">
                    <i class="fas fa-bookmark mr-3"></i>
                    Bookmark Listing
                </a>
            </aside>
        </div>
        <section class="mb-12">
            <div class="bg-white p-6 shadow-md mt-6">
                <div id="map"></div>
            </div>
        </section>
    </main>

</x-root-layout>