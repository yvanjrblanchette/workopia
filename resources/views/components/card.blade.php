@props(['job', 'className' => ''])

<div class="bg-white p-6 rounded-xl shadow-xl w-full h-[400px] {{ $className }}">
    <div class="w-full flex items-center justify-between border-b pb-2 border-gray-200 mb-4">
        <div class="flex flex-col">
            <h2 class="font-bold {{ dynamicFontSize($job->title) }}">{{ $job->title }}</h2>
            <p class="text-xs font-medium mb-1">Posted {{ $job->created_at->diffForHumans() }}</p>
            <div class="flex items-center gap-3">
                <p class="text-sm font-medium">{{ $job->company_name }}</p>
                @if ($job->remote)
                <div class="flex items-bottom gap-2 text-sm">
                    <i class="fa-solid fa-house-chimney-user primary" title="Remote Job"></i>
                </div>
                @endif
            </div>
        </div>
        
        @if ($job->company_logo)
        <a href="{{ $job->company_website }}" target="_blank">
            <img src="{{ $job->company_logo }}" alt="{{ $job->company_name }}" class="h-16 w-auto rounded-full">
        </a>
        @endif
    </div>

    <div class="w-full h-full flex flex-col justify-between pb-24">
        <div class="space-y-1 text-sm">
            <p class="line-clamp-4 mb-2">{{ $job->description }}</p>
            <p><strong>Job Type: </strong>{{ $job->job_type }}</p>
            <p><strong>Salary: </strong>${{ number_format($job->salary) }} / year</p>
            <p><strong>Location: </strong>{{ $job->city }}, {{ $job->state }}</p>
            
            @if ($job->tags)
            <div class="pt-2">{{ ucwords(str_replace(',', ', ', $job->tags)) }}</div>
            @endif
        </div>

        <div>
            <a href="/jobs/{{ $job->id }}" class="block w-full bg-blue-900 hover:bg-yellow-500 transition duration-200 rounded-full text-white text-center py-2 font-semibold">
                See Job Details
            </a>
        </div>
    </div>
</div>
