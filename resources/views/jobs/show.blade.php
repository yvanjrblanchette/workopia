<x-root-layout>
    <x-slot name=title>Job Listing Details</x-slot>
    <main class="container mx-auto max-w-7xl px-4">
        <div class="flex justify-between items-center -mt-6 mb-2">
            <a class="block p-4 text-marine-700 hover:text-pumpkin-550 transition duration-300 font-medium"
                href="/jobs">
                <i class="fa fa-arrow-alt-circle-left"></i>
                Back To Listings
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Job Details Column -->
            <section class="md:col-span-3">
                <div class="w-full h-full shadow-md bg-white p-8 flex flex-col justify-between">
                    <div>
                        <h2 class="text-3xl lg:text-4xl text-center font-semibold">
                            {{ $job->title }}
                        </h2>
                        <p class="text-sm text-center font-medium mt-1">Posted {{ $job->created_at->diffForHumans() }}
                        </p>
                        <p class="text-gray-700 text-sm lg:text-lg text-justify mt-4 border-b pb-6">
                            {{ $job->job_description }}
                        </p>

                        <h3 class="mt-6 text-xl lg:text-2xl font-bold mb-2 text-marine-700">Job Details</h3>
                        <div class="pb-8">
                            <ul class="space-y-1 grid grid-cols-12 mb-8">
                                <div class="col-span-12 md:col-span-4 space-y-2 text-sm lg:text-base">
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
                                        <strong class="mr-2">Salary: </strong>${{ number_format($job->salary) }} /
                                        year
                                    </li>
                                </div>

                                <div class="lg:ml-auto col-span-12 md:col-span-8 space-y-2  text-sm lg:text-base">
                                    {{-- Contact Email --}}
                                    <li>
                                        <a href="mailto:{{ $job->company->contact_email }}"
                                            title="Send an email to {{ $job->company->name }}"
                                            class="flex items-center gap-3">
                                            <strong>Contact Email:</strong> <span
                                                class="text-marine-700 hover:text-pumpkin-550 font-medium transition flex items-center gap-1"><i
                                                    class="fa-solid fa-envelope text-xs"></i>
                                                {{ $job->company->contact_email }}</span>
                                        </a>
                                    </li>

                                    {{-- Contact Phone --}}
                                    @if ($job->company->contact_phone)
                                        <li>
                                            <a href="tel:{{ $job->company->contact_phone }}"
                                                title="Call {{ $job->company->name }}" class="flex items-center gap-3">
                                                <strong>Contact Phone:</strong> <span
                                                    class="text-marine-700 hover:text-pumpkin-550 font-medium transition flex items-center gap-1"><i
                                                        class="fa-solid fa-phone text-xs lg:text-base"></i>{{ $job->company->contact_phone }}</span>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Location --}}
                                    <li>
                                        <a href="{{ $job->url }}" title="Visit {{ $job->company->name }}"
                                            class="flex items-center gap-3">
                                            <strong>Location:</strong> <span
                                                class="text-marine-700 hover:text-pumpkin-550 font-medium transition flex items-center gap-1 text-xs lg:text-base"><i
                                                    class="fa-solid fa-location-dot"></i> <span>
                                                    @if ($job->company->address)
                                                        {{ $job->company->address }},
                                                    @endif{{ $job->company->city }},
                                                    {{ $job->company->state }},
                                                    @if ($job->company->zipcode)
                                                        {{ $job->company->zipcode }}
                                                    @endif
                                                </span></span>
                                        </a>
                                    </li>
                                </div>

                                {{-- Tags --}}
                                <li class="col-span-12 mb-2 text-sm lg:text-base">
                                    <strong>Tags:</strong> {{ ucwords(str_replace(',', ', ', $job->tags)) }}
                                </li>
                            </ul>

                            <h3 class="text-xl font-semibold mb-1 text-marine-700">
                                Job Requirements
                            </h3>
                            <p class="text-sm lg:text-base">
                                {{ $job->requirements }}
                            </p>
                            <h3 class="text-xl font-semibold mt-8 mb-1 text-marine-700">
                                Benefits
                            </h3>
                            <p class="text-sm lg:text-base">
                                {{ $job->benefits }}
                            </p>
                        </div>
                    </div>

                    @auth
                        <div x-data="{ open: false }" class="w-full">
                            {{-- Modal Trigger --}}
                            @if (auth()->user()->id != $job->user_id)
                                <button @click="open = true"
                                    class="w-full text-center shadow rounded-full font-semibold bg-marine-700 hover:bg-pumpkin-550 text-white transition py-2 flex items-center justify-center gap-3">
                                    <i class="fa-solid fa-file-lines text-xl"></i>
                                    Apply Now
                                </button>
                            @endif
                            {{-- Modal Overlay --}}
                            <div x-show="open"
                                class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 backdrop-blur-sm"
                                x-cloak role="dialog" aria-modal="true">

                                {{-- Modal --}}
                                <div @click.away="open = false" x-init="$watch('open', value => document.body.classList.toggle('overflow-hidden', value))"
                                    class="relative bg-white px-10 py-6 shadow-xl w-full max-w-4xl">
                                    <h3 class="text-3xl mt-10 font-semibold text-center">Job Application Form</h3>
                                    <p class="text-center text-sm mt-1 mb-3.5 text-gray-700">Fill the form below to apply
                                        for the <span class="font-semibold text-marine-700">{{ $job->title }}</span> job
                                    </p>

                                    <form action="{{ route('applicant.store', $job->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        {{-- Name --}}
                                        <x-input type="text" id="name" name="name" label="Full Name"
                                            placeholder="Full Name" value="{{ old('name') }}" :required="true"
                                            className="w-full" />


                                        {{-- Contact Information --}}
                                        <p class="block text-gray-700">Contact informations<span
                                                class="text-red-600 text-sm"> *</span></p>
                                        <div class="flex flex-col lg:flex-row gap-2 mb-3.5">

                                            {{-- Contact Phone --}}
                                            <x-input value="{{ old('contact_phone') }}" type="tel" id="contact_phone"
                                                name="contact_phone" placeholder="Phone number" :required="true"
                                                className="w-full" />

                                            {{-- Contact Email --}}
                                            <x-input value="{{ old('contact_email') }}" type="email" id="contact_email"
                                                name="contact_email" placeholder="Email address" :required="true"
                                                className="w-full" />
                                        </div>

                                        {{-- Location --}}
                                        <x-input value="{{ old('location') }}" type="text" id="location"
                                            name="location" label="Location" placeholder="Enter your Location"
                                            className="mb-3.5 w-full" />


                                        {{-- Presentation Letter --}}
                                        <x-text-area id="message" name="message" label="Presentation Letter"
                                            placeholder="Tell us about yourself..." value="{{ old('message') }}"
                                            className="mb-3.5 w-full" cols="30" rows="5" />

                                        {{-- Resume --}}
                                        <x-file id="resume_path" name="resume_path" label="Upload your Resume"
                                            className="mb-3.5 w-full" required="true" />

                                        <button type="submit"
                                            class="w-full text-center shadow rounded-full font-semibold bg-marine-700 hover:bg-pumpkin-550 text-white transition py-2 flex items-center gap-2 justify-center">
                                            <i class="fa-solid fa-paper-plane"></i>
                                            Send Application</button>
                                    </form>
                                    <button @click="open = false"
                                        class=" absolute top-6 right-6 px-2.5 py-1 text-center text-lg font-semibold hover:bg-gray-100 transition">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                    <img src="{{ asset('storage/' . $job->company->logo) }}"
                                        alt="{{ $job->company->name }} logo"
                                        class="hidden lg:block opacity-50 absolute top-4 left-16 w-32 h-auto m-auto rounded-full">
                                </div>
                            </div>
                        </div>
                    @endauth

            </section>

            <!-- Sidebar -->
            <aside class="bg-white shadow-md p-8">
                <a href="{{ $job->company->website }}" target="_blank"
                    title="Visit {{ $job->company->name }}'s website">
                    <h4 class="text-4xl font-bold text-center uppercase">{{ $job->company->name }}</h4>
                    @if ($job->company->logo)
                        <div class="mx-auto w-[200px] h-auto block overflow-hidden group">
                            <img src="/storage/{{ $job->company->logo }}" alt="{{ $job->company->name }}"
                                class="w-full rounded-full m-auto p-4 group-hover:scale-105 transition-all duration-300" />
                        </div>
                    @endif
                    @if ($job->company->description)
                        <p class="text-gray-700 text-center text-sm lg:text-base mt-3">
                            {{ $job->company->description }}
                        </p>
                    @endif
                </a>
                <div class="flex flex-col justify-between items-center" title="Bookmark Job Listing">
                    {{-- Bookmark Button --}}

                    @auth
                        @can('update', $job)
                            <div class=" w-full">

                                <!-- Edit Button -->
                                <a href="{{ route('jobs.edit', $job->id) }}" title="Edit Job Listing"
                                    class="mt-10 bg-marine-700 hover:bg-pumpkin-550 transition text-white font-semibold w-full py-2.5 px-4 rounded-full flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </a>
                                <!-- Delete Listing Button -->
                                <form method="POST" title="Delete Job Listing"
                                    action="{{ route('jobs.destroy', $job->id) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this job?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="mt-3 bg-red-600 hover:bg-red-700 transition text-white font-semibold w-full py-2.5 px-4 rounded-full flex items-center justify-center gap-2">
                                        <i class="fa-solid fa-trash-can"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                            {{-- @else
                            <form method="POST"
                                action="{{ auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists()? route('bookmarks.destroy', $job->id): route('bookmarks.store', $job->id) }}"
                                class="w-full">
                                @csrf
                                @if (auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists())
                                    @method('DELETE')
                                @endif
                                <button type="submit"
                                    class="mt-10 {{ auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists()? 'bg-red-500 hover:bg-red-600': 'bg-marine-700 hover:bg-pumpkin-550' }} transition text-white font-semibold w-full py-2.5 px-4 rounded-full flex items-center justify-center gap-3">
                                    <i class="fas fa-bookmark"></i>
                                    {{ auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists()? 'Remove Bookmark': 'Add Bookmark' }}
                                </button>
                            </form> --}}
                        @endcan
                    @endauth
                </div>
            </aside>
        </div>
        <section class="mb-12">
            <div class="bg-white p-6 shadow-md mt-6">
                <div id="map"></div>
            </div>
        </section>
    </main>

</x-root-layout>
