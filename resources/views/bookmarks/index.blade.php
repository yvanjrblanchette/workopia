<x-root-layout>
    <h1 class="text-5xl uppercase text-center mt-10 mb-8 font-semibold">Bookmarked Job Listings</h1>

    {{-- Pagination Links --}}
    {{ $bookmarks->links() }}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full h-full gap-4 mb-6 mt-8">
        @forelse($bookmarks as $bookmark)
            <x-card :job="$bookmark" />
        @empty
            <p class="w-full text-center text-gray-400 text-2xl">No bookmarks available at the moment</p>
        @endforelse
    </div>

</x-root-layout>
