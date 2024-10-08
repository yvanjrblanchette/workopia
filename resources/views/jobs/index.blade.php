<x-root-layout>
    <x-slot name=title>Job Listings</x-slot>
    <div class="mx-auto max-w-7xl my-8">
        <h1 class="col-span-1 text-5xl text-center mt-8 mb-6 pb-2 font-bold uppercase">Available <span
                class="text-pumpkin-550">Jobs</span></h1>
        {{-- Pagination Links --}}
        {{ $jobs->links() }}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full h-full  gap-4 my-6">
            @forelse ($jobs as $job)
                <x-card :job="$job" />
            @empty
                <p class="text-center text-2xl w-full">Sorry, no jobs found...</p>
            @endforelse
        </div>
    </div>

</x-root-layout>
