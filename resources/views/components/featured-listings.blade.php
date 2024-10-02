@props(['Jobs' => []])

<section class="mx-auto max-w-7xl my-8">
    <h1 class="col-span-1 text-5xl text-center mt-8 mb-6 pb-2 font-bold uppercase">Featured Job listings</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full h-full  gap-4 mb-6">
      @forelse ($jobs as $job)
      <x-card :job="$job" />
      @empty
      <p class="text-center text-2xl">Sorry, no jobs found...</p>
      @endforelse
    </div>
  </section>