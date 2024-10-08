<x-root-layout>
    <div class="container w-full max-w-7xl mx-auto">

        <h1 class="col-span-1 text-5xl text-center mt-10 mb-6 pb-2 font-bold uppercase">Featured <span
                class="text-pumpkin-550">Jobs</span></h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full h-full gap-4 mb-24">
            @forelse ($jobs as $job)
                <x-card :job="$job" />
            @empty
                <p class="text-center text-2xl">Sorry, no jobs found...</p>
            @endforelse
        </div>

        <a href="{{ route('jobs.index') }}"
            class="w-[80%] mx-auto cursor-pointer text-center shadow rounded-full font-semibold bg-marine-700 hover:bg-pumpkin-550 text-white transition py-2 flex items-center justify-center gap-3">
            <i class="fa-solid fa-copy text-xl"></i>
            VIEW ALL JOB LISTINGS
        </a>
    </div>
</x-root-layout>
