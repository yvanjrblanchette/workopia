@props(['job', 'className' => ''])


<div class="relative bg-white p-6 rounded-xl shadow-xl w-full h-[400px] {{ $className }}">
    <div class="w-full flex items-center justify-between border-b pb-2 border-gray-200 mb-4">
        <div class="flex flex-col">

            <h2 class="font-bold {{ dynamicFontSize($job->title) }} flex items-start gap-2">
                {{ $job->title }}
                @auth
                    @if (!auth()->user()->id == $job->user_id)
                        <form method="POST"
                            action="{{ auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists()? route('bookmarks.destroy', $job->id): route('bookmarks.store', $job->id) }}"
                            class="">
                            @csrf
                            @if (auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists())
                                @method('DELETE')
                            @endif
                            <button type="submit"
                                title="{{ auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists()? 'Remove Bookmark': 'Add Bookmark' }}"
                                class="{{ auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists()? 'text-yellow-300 hover:text-yellow-400': 'text-gray-300 hover:text-yellow-100' }} transition">
                                <i class="fas fa-star text-lg"></i>
                            </button>
                        </form>
                    @endauth
                @endif
            </h2>

            <p class="text-xs font-medium mb-1">Posted {{ $job->created_at->diffForHumans() }}</p>
            <div class="flex items-center gap-3">
                <p class="text-sm font-medium">{{ $job->company->name }}

                </p>
                @if ($job->remote)
                    <div class="flex items-bottom gap-2 text-sm">
                        <i class="fa-solid fa-house-chimney-user primary" title="Remote Job"></i>
                    </div>
                @endif
            </div>
        </div>

        @if ($job->company->logo)
            <img src="{{ $job->company->logo }}" alt="{{ $job->company->name }}" class="h-16 w-auto rounded-full">
        @endif
    </div>

    <div class="w-full h-full flex flex-col justify-between pb-24">
        <div class="space-y-1 text-sm">
            <p class="line-clamp-4 mb-2">{{ $job->job_description }}</p>
            <p><strong>Job Type: </strong>{{ $job->job_type }}</p>
            <p><strong>Salary: </strong>${{ number_format($job->salary) }} / year</p>
            <p><strong>Location: </strong>{{ $job->company->city }}, {{ $job->company->state }}</p>

            @if ($job->tags)
                <div class="pt-2">{{ ucwords(str_replace(',', ', ', $job->tags)) }}</div>
            @endif
        </div>

        <div>
            <a href="/jobs/{{ $job->id }}"
                class="block w-full bg-marine-700 hover:bg-pumpkin-550 transition duration-200 rounded-full text-white text-center py-2 font-semibold">
                See Job Details
            </a>
        </div>
    </div>

</div>
