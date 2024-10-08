<x-root-layout>
    <main class="container mx-auto p-4 grid grid-cols-12 grid-rows-2 gap-4">
        <!-- Profile Information Section (4 cols wide, full height) -->
        <aside class="col-span-12 md:col-span-3 row-span-2 bg-white p-8 rounded-lg shadow-md h-full pb-16">
            <div class="w-[100%] mx-auto h-[85%]">
                <h3 class="col-span-12 text-4xl text-center font-bold mb-10">
                    Profile
                </h3>
                <div class="flex flex-col h-full">
                    {{-- Profile Image --}}
                    <div title="{{ $user->name }}'s Profile Image" alt="{{ $user->name }}' Profile Image"
                        class="w-[150px] drop-shadow-lg rounded-full aspect-square overflow-hidden mx-auto mb-8">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="Profile Image"
                                class="w-full h-full object-cover rounded-full">
                        @else
                            <img src="{{ asset('storage/avatars/placeholder.svg') }}" alt="Profile Image"
                                class="w-full h-full object-cover rounded-full">
                        @endif
                    </div>
                    <div class='text-center'>
                        {{-- Profile Name --}}
                        <div class="mb-1">
                            <p class="block text-gray-900/20 text-sm font-semibold">Full name</p>
                            <p class="text-gray-900 text-2xl font-medium">{{ $user->name }}</p>
                        </div>

                        {{-- Profile Email --}}
                        <div class="mb-1">
                            <p class="block text-gray-900/20 text-sm font-semibold">Email</p>
                            <a href="mailto:{{ $user->email }}" title="Send an email to {{ $user->email }}"
                                class="text-gray-900 hover:text-pumpkin-550 text-xl font-medium">{{ $user->email }}</a>
                        </div>

                        {{-- Profile Member since --}}
                        <div class="mb-4">
                            <p class="block text-gray-900/20 text-xs font-semibold">Member since</p>
                            <p class="text-gray-900 text-lg font-medium">
                                {{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Edit Profile Modal --}}
                <x-modal buttonLabel="Edit profile" buttonIcon="fa-solid fa-pen-to-square"
                    buttonClass="bg-marine-700 hover:bg-pumpkin-550 transition-all duration-300 font-semibold mb-5">
                    <h3 class="text-3xl text-center text-marine-700 font-bold tracking-wide mb-8">Edit your profile</h3>
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-row-reverse items-start gap-6">
                            <img id="avatar_preview"
                                src="{{ $user->avatar ?? asset('storage/avatars/placeholder.svg') }}"
                                alt="Profile avatar image"
                                class="w-[150px] h-auto shadow-xl aspect-square rounded-full object-cover overflow-hidden mx-auto mb-8">
                            <div class="w-2/3 h-full flex flex-col justify-between">
                                {{-- Profile Name --}}
                                <x-input type="text" name="name" id="name" value="{{ $user->name }}"
                                    label="Name" placeholder="Full Name" className="mb-4" />

                                {{-- Profile Email --}}
                                <x-input type="email" name="email" id="email" value="{{ $user->email }}"
                                    label="Email" placeholder="Email Address" className="mb-4" />
                            </div>
                        </div>

                        {{-- Profile avatar --}}
                        <x-input type="file" name="avatar" id="avatar" label="Profile Avatar" className="mb-4" />

                        {{-- Profile Password --}}
                        <x-password name="password" id="password" label="Password" className="mb-4" />

                        <x-password name="password_confirmation" id="password_confirmation" label="Confirm Password"
                            className="mb-4" />
                        <div class="flex justify-end gap-4">
                            <button @click="modelOpen = false" type="button"
                                class="bg-transparent hover:text-pumpkin-550 transition-all rounded-full text-black font-semibold px-6 py-2">Cancel</button>

                            <button type="submit"
                                class="bg-marine-700 hover:bg-pumpkin-550 transition rounded-full text-white font-semibold px-6 py-2">Save</button>
                        </div>
                    </form>
                </x-modal>
            </div>
        </aside>

        <!-- Company Information Section (9 cols wide, top half) -->
        <section
            class="col-span-12 md:col-span-9 bg-white p-8 rounded-lg shadow-md w-[100%] lg:h-[400px] overflow-hidden py-10">
            <div class="w-[100%] mx-auto h-full grid grid-cols-12 justify-between lg:gap-x-10">
                <h3 class="col-span-12 text-3xl lg:text-4xl text-center font-bold uppercase">
                    @if ($company)
                        {{ $company['name'] }}
                    @else
                        Company Name
                    @endif
                </h3>

                {{-- Company Logo --}}
                <div class="col-span-12 md:col-span-4">
                    @if ($company)
                        <a href="{{ $company['website'] }}" target="_blank"
                            title="Visit {{ $company['name'] }}'s website"
                            class="w-[250px] h-[250px] mx-auto rounded-full block group">
                            <img src="/storage/{{ $company['logo'] }}" alt="Company Logo"
                                class="-translate-y-4 w-full h-full object-cover group-hover:scale-105 transition-all duration-300 rounded-full">
                        </a>
                    @else
                        <img src="{{ asset('storage/logos/logo_placeholder.svg') }}" alt="Company Logo"
                            class="w-[200px] h-[200px] object-contain mx-auto block">
                    @endif
                </div>


                {{-- Company details --}}
                <div
                    class="col-span-12 md:col-span-8 mt-4 w-full ml-auto text-center lg:text-start flex flex-col items-center lg:items-start">
                    <div class="mb-3">
                        <p class="block text-gray-900/20 text-sm font-semibold">Company description</p>
                        @if ($company)
                            <p class="text-gray-900 text-lg font-medium">{{ $company['description'] }}</p>
                        @else
                            <p class="text-gray-900 text-lg font-medium">Lorem ipsum dolor sit, amet consectetur
                                adipisicing elit. Dicta voluptas, iusto eos minima distinctio odio temporibus
                                voluptatibus ipsa aperiam. Aut error molestias quidem ipsum culpa dolor eaque corporis.
                            </p>
                        @endif
                    </div>
                    <div class="mb-1">
                        <p class="block text-gray-900/20 text-sm font-semibold">Contact informations</p>
                        @if ($company)
                            <p class="text-gray-900/70 text-lg font-medium flex gap-2 items-center">
                                <i class="fa-solid fa-location-dot text-sm"></i>
                                {{ $company['address'] }}, {{ $company['city'] }},
                                {{ $company['state'] }},
                                {{ $company['zipcode'] }}
                            </p>
                        @else
                            <p class="text-gray-900/70 font-medium flex gap-2 items-center w-fit">
                                <i class="fa-solid fa-location-dot text-sm"></i>
                                Address, City, State, postal code
                            </p>
                        @endif
                        </p>
                    </div>
                    <div class="mb-1">
                        @if ($company)
                            <a href="mailto:{{ $company['contact_email'] }}"
                                title="Send an email to {{ $company['contact_email'] }}"
                                class="text-gray-900/70 hover:text-pumpkin-550 text-lg font-medium flex gap-2 items-center w-fit">
                                <i class="fa-solid fa-envelope text-sm"></i>
                                {{ $company['contact_email'] }}
                            </a>
                        @else
                            <p class="text-gray-900/70 font-medium flex gap-2 items-center w-fit">
                                <i class="fa-solid fa-envelope text-sm"></i>
                                Contact Email
                            </p>
                        @endif
                    </div>

                    <div class="mb-1">
                        @if ($company)
                            <a href="tel:{{ $company['contact_phone'] }}" title="Call {{ $company['name'] }}"
                                class="text-gray-900/70 hover:text-pumpkin-550  text-lg font-medium flex gap-2 items-center w-fit">
                                <i class="fa-solid fa-phone text-sm"></i>
                                {{ $company['contact_phone'] }}
                            </a>
                        @else
                            <p title="Call the company"
                                class="text-gray-900/70 font-medium flex gap-2 items-center w-fit">
                                <i class="fa-solid fa-phone text-sm"></i>
                                Contact Phone
                            </p>
                        @endif
                    </div>
                    <div class="text-end w-full">
                        <button
                            class="bg-marine-700 hover:bg-pumpkin-550 transition rounded-full text-white font-semibold px-6 py-2">Edit
                            Company Details</button>
                    </div>
                </div>

            </div>
        </section>

        <!-- Job Listings Section (8 cols wide, bottom half) -->
        <section
            class="col-span-12 md:col-span-9 bg-white p-8 rounded-lg shadow-md w-full lg:h-[400px] overflow-hidden">
            <h3 class="text-4xl text-center font-bold mb-6 flex justify-center items-center gap-4">
                My Job Listings
                <a href="/jobs/create" title="Create a new job listing"
                    class="text-marine-700 hover:text-pumpkin-550 font-bold text-2xl" x-on:mouseenter="tooltip = true"
                    x-on:mouseleave="tooltip = false">
                    <i class="fa-solid fa-file-circle-plus"></i>
                </a>
            </h3>
            <div class="w-full h-[250px] overflow-y-auto">
                <table class="w-full shadow">
                    <!-- Table Header -->
                    <thead class="sticky top-0 bg-marine-50 border-b border-marine-700">
                        <tr>
                            <th class="text-center py-2 px-4">Title</th>
                            <th class="hidden lg:table-cell text-center py-2 px-4">Job type</th>
                            <th class="hidden lg:table-cell text-center py-2 px-4">Salary</th>
                            <th class="hidden lg:table-cell text-center py-2 px-4">Location</th>
                            <th class="text-center py-2 px-4">Actions</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @forelse ($jobs as $index => $job)
                            <tr class="{{ $index % 2 == 1 ? 'bg-marine-50' : '' }}">
                                <td class="text-center py-2 px-4">{{ $job->title }}</td>
                                <td class="hidden lg:table-cell text-center py-2 px-4">{{ $job->job_type }}</td>
                                <td class="hidden lg:table-cell text-center py-2 px-4">
                                    ${{ number_format($job->salary) }} / year</td>
                                <td class="hidden lg:table-cell text-center py-2 px-4">{{ $job->company->city }},
                                    {{ $job->company->state }}</td>
                                <td class="text-center py-2 px-4">
                                    <!-- Actions (View, Edit, Delete) -->
                                    <div class="flex gap-4 items-center justify-center text-lg">
                                        <a href="{{ route('jobs.show', $job->id) }}"
                                            class="text-gray-900 hover:text-marine-700" title="View Listing">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('jobs.edit', $job->id) }}"
                                            class="text-gray-900 hover:text-pumpkin-550" title="Edit Listing">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form method="POST"
                                            action="{{ route('jobs.destroy', $job->id) }}?from=dashboard"
                                            onsubmit="return confirm('Are you sure you want to delete this job?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-900 hover:text-red-500"
                                                title="Delete Listing">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-2 px-4">No jobs found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            </div>
        </section>
    </main>
    </x-layout>


    {{-- Script to preview the avatar image in the modal --}}
    <script>
        const avatar = document.getElementById('avatar');
        const avatarPreview = document.getElementById('avatar_preview');

        avatar.addEventListener('change', (event) => {
            const file = event.target.files[0];

            if (file) {
                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Please select a valid image file (JPEG, JPG, PNG, GIF).');
                    // Clear the file input
                    avatar.value = '';
                    // Exit the function to prevent further processing
                    return;
                }

                // Check file size
                const maxSizeInBytes = 2 * 1024 * 1024; // 2 MB in bytes
                if (file.size > maxSizeInBytes) {
                    alert('The selected image is larger than 2 MB. Please select a smaller image.');
                    // Clear the file input
                    avatar.value = '';
                    // Exit the function to prevent further processing
                    return;
                }

                // Create a URL for the selected file and update the previous file URL
                const fileURL = URL.createObjectURL(file);
                // Update the preview image with the selected file URL
                avatarPreview.src = fileURL;
            }
        });
    </script>
