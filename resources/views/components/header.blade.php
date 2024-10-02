@php
    $navLinks = [
        ['href' => '/', 'label' => 'Home', 'icon' => 'fa-solid fa-house'],
        ['href' => 'jobs', 'label' => 'All Jobs', 'icon' => 'fa-solid fa-briefcase '],
        ['href' => 'jobs/saved', 'label' => 'Saved Jobs', 'icon' => 'fa-solid fa-heart-circle-plus '],
        ['href' => 'login', 'label' => 'Login', 'icon' => 'fa-solid fa-right-to-bracket '],
        ['href' => 'register', 'label' => 'Register', 'icon' => 'fa-solid fa-user-plus '],
        ['href' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'fa-solid fa-gauge '],
    ]
@endphp

<header class="bg-blue-900 text-white p-4">
    <div class="container max-w-7xl mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <x-logo className="h-10 mt-1.5" />
        </h1>
        <nav class="hidden md:flex items-center space-x-6">
            @foreach ($navLinks as $navlink)
            <x-nav-link 
            url="{{url($navlink['href'])}}" 
            icon="{{$navlink['icon']}}"  
            className="font-medium hover:text-yellow-500 py-2 flex items-center gap-1 {{request()->is($navlink['href']) ? 'text-yellow-500 pointer-events-none': 'text-white'}}"
            >
                {{$navlink['label']}}
            </x-nav-link>
            @endforeach
            
            <x-button-link 
                url="{{url('/jobs/create')}}"
                icon="fa-solid fa-edit"
                className="hover:bg-yellow-600 text-black font-medium px-4 py-2 rounded hover:shadow-md transition duration-300 {{request()->is('jobs/create') ? 'bg-yellow-600 pointer-events-none': 'bg-yellow-500'}}">
                Create Job
            </x-button-link>
        </nav>
        <button id="hamburger" class="text-white md:hidden flex items-center">
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <nav id="mobile-menu" class="hidden md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2">
        @foreach($navLinks as $navlink)
        <x-nav-link 
          url="{{url($navlink['href'])}}" 
          icon="{{$navlink['icon']}}"  
          className="block px-4 py-2 hover:bg-blue-800 {{request()->is($navlink['href']) ? 'text-yellow-500': 'text-white'}}"
        >
            {{$navlink['label']}}
        </x-nav-link>
        @endforeach
       
        <a href="{{url('/jobs/create')}}" class="block px-4 py-2  bg-yellow-500 hover:bg-yellow-600 text-black">
            <i class="fa fa-edit"></i> Create Job
        </a>
    </nav>
</header>