@if($paginator->hasPages())
    <nav class="flex justify-center" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-1 pe-6 bg-marine-700/10 text-gray-500/10 rounded-l-full">
                <i class="fa-solid fa-backward text-xs mt-1.5"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-1 pe-6 bg-marine-700/10 text-black/30 hover:text-black/50 rounded-l-full transition-all">
                <i class="fa-solid fa-backward text-xs mt-1.5"></i>
            </a>
        @endif


        {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{--"Three Dots" Separator --}}
    @if (is_string($element))
    <span class="px-4 py-1 bg-marine-700/10 text-gray-500">{{ $element }}</span>
    @endif
    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <span class="px-4 py-1 bg-marine-700/10 text-pumpkin-550 font-bold">{{ $page }}</span>
    @else
    <a href="{{ $url }}" class="px-4 py-1 font-semibold bg-marine-700/10 text-black/30 hover:text-black/50 ">{{ $page }}</a>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next link --}}
    @if($paginator->hasMorePages())
    <a href="{{$paginator->nextPageUrl()}}" class="px-4 py-1 ps-6 bg-marine-700/10 text-black/30 hover:text-black/50 rounded-r-full">
        <i class="fa-solid fa-forward text-xs mt-1.5"></i>
    </a>
    @else
    <span class="px-4 py-1 ps-6 bg-marine-700/10 text-gray-500/10 rounded-r-full">
        <i class="fa-solid fa-forward text-xs mt-1.5"></i>
    </span>
    @endif
    </nav>
@else

@endif