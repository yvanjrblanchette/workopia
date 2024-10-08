@props([
    'title' => 'Looking to hire?',
    'subtitle' => 'Post your job listing now and find the perfect
candidate',
])

<section class="w-full bg-marine-700 container mx-auto mt-6">
    <div class="mx-auto max-w-7xl  text-white p-4 flex flex-col items-center justify-center">
        <x-logo className="h-16 mt-1.5" color="white" />
        <p>&copy; {{ now()->year }} {{ config('app.name') }}. All rights reserved.</p>
        <p>Designed and created by <a href="{{ config('app.creator_url') }}" target="_blank"
                class="text-pumpkin-550 hover:text-pumpkin-600 transition">{{ config('app.creator') }}</a></p>
    </div>
</section>
