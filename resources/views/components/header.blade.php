@php
    $PublicRoutes = [
        ['href' => '/', 'label' => 'Home', 'icon' => 'fa-solid fa-house'],
        ['href' => 'jobs', 'label' => 'All Jobs', 'icon' => 'fa-solid fa-briefcase '],
    ];

    $ProtectedRoutes = [
        ['href' => '/', 'label' => 'Home', 'icon' => 'fa-solid fa-house'],
        ['href' => 'jobs', 'label' => ' Jobs', 'icon' => 'fa-solid fa-briefcase '],
        ['href' => '/jobs/create', 'label' => 'Create Jobs', 'icon' => 'fa-solid fa-pen-to-square'],
    ];
@endphp

<header class="bg-marine-700 text-white p-4">
    <div class="container max-w-7xl mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <x-logo className="h-14 mt-1.5" color="white" />
        </h1>
        <div class="flex items-center space-x-4">
            <nav class="hidden md:flex items-center space-x-6">

                @auth

                    {{-- Protected Routes --}}
                    @foreach ($ProtectedRoutes as $navlink)
                        <x-nav-link url="{{ url($navlink['href']) }}" icon="{{ $navlink['icon'] }}"
                            className="font-medium hover:text-pumpkin-550 py-2 flex items-center gap-1 {{ request()->is($navlink['href']) ? 'text-pumpkin-550 pointer-events-none' : 'text-white' }}">
                            {{ $navlink['label'] }}
                        </x-nav-link>
                    @endforeach
                @else
                    {{-- Public Routes --}}
                    @foreach ($PublicRoutes as $navlink)
                        <x-nav-link url="{{ url($navlink['href']) }}" icon="{{ $navlink['icon'] }}"
                            className="font-medium hover:text-pumpkin-550 py-2 flex items-center gap-1 {{ request()->is($navlink['href']) ? 'text-pumpkin-550 pointer-events-none' : 'text-white' }}">
                            {{ $navlink['label'] }}
                        </x-nav-link>
                    @endforeach

                @endauth

                <button id="hamburger" class="text-white md:hidden flex items-center">
                    <i class="fa fa-bars text-2xl"></i>
                </button>
            </nav>
            <x-user-button />
        </div>
    </div>


    <!-- Mobile Menu -->
    <nav id="mobile-menu" class="hidden md:hidden bg-marine-700 text-white mt-5 pb-4 space-y-2">

        @auth

            {{-- Protected Routes --}}
            @foreach ($ProtectedRoutes as $navlink)
                <x-nav-link url="{{ url($navlink['href']) }}" icon="{{ $navlink['icon'] }}"
                    className="block px-4 py-2 hover:bg-marine-700 {{ request()->is($navlink['href']) ? 'text-pumpkin-550' : 'text-white' }}">
                    {{ $navlink['label'] }}
                </x-nav-link>
            @endforeach

            <a href="{{ url('/jobs/create') }}" class="block px-4 py-2  bg-pumpkin-550 hover:bg-pumpkin-600 text-black">
                <i class="fa fa-edit"></i> Create Job
            </a>
        @else
            {{-- Public Routes --}}
            @foreach ($PublicRoutes as $navlink)
                <x-nav-link url="{{ url($navlink['href']) }}" icon="{{ $navlink['icon'] }}"
                    className="block px-4 py-2 hover:bg-marine-700 {{ request()->is($navlink['href']) ? 'text-pumpkin-550' : 'text-white' }}">
                    {{ $navlink['label'] }}
                </x-nav-link>
            @endforeach

        @endauth
    </nav>
</header>
