<div class="flex justify-center">
    <div x-data="{
        open: false,
        toggle() {
            if (this.open) {
                return this.close()
            }
    
            this.$refs.button.focus()
    
            this.open = true
        },
        close(focusAfter) {
            if (!this.open) return
    
            this.open = false
    
            focusAfter && focusAfter.focus()
        }
    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
        x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']" class="relative">
        <!-- Button -->
        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
            type="button" class="flex items-center rounded-full shadow-xl group overflow-hidden">

            @auth
                @if (Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                        class="w-14 h-14 rounded-full object-cover z-50 shadow  group-hover:scale-105 transition-all">
                @else
                    <img src="{{ asset('storage/avatars/placeholder.svg') }}" alt="Profile image"
                        class="w-14 h-14 rounded-full z-50 shadow  group-hover:scale-105 transition-all">
                @endif
            @else
                <img src="{{ asset('storage/avatars/placeholder.svg') }}" alt="Profile image"
                    class="w-14 h-14 rounded-full z-50 shadow  group-hover:scale-105 transition-all">
            @endauth

        </button>

        <!-- Panel -->
        <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
            :id="$id('dropdown-button')" style="display: none;"
            class="absolute right-1.5 -mt-3 w-48 rounded rounded-tr-none bg-white shadow-md overflow-hidden z-40">
            <h2>
                @auth

                    <p class="text-sm py-2 text-gray-800 font-semibold border-b text-center bg-marine-50">
                        {{ Auth::user()->name }}</p>
                @else
                    <p class="text-sm py-2 text-gray-800 font-semibold border-b text-center bg-marine-50">Guest</p>
                @endauth

            </h2>

            {{-- Home --}}
            <a
                href="/"class="lg:hidden flex items-center justify-center  gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 font-medium text-gray-800 hover:text-pumpkin-550 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                <i class="fa-solid fa-home"></i>
                Home
            </a>

            {{-- Jobs --}}
            <a
                href="/jobs"class="lg:hidden flex items-center justify-center  gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 font-medium text-gray-800 hover:text-pumpkin-550 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                <i class="fa-solid fa-briefcase"></i>
                Jobs
            </a>

            @auth
                {{-- Create job --}}
                <a href="/jobs/create"
                    class="lg:hidden flex items-center justify-center  gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 font-medium text-gray-800 hover:text-pumpkin-550 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                    <i class="fas fa-pen-to-square"></i>
                    Create Job
                </a>

                <hr class="lg:hidden">
                {{-- Dashboard --}}
                <a href="/dashboard"
                    class="flex items-center justify-center  gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 font-medium text-gray-800 hover:text-pumpkin-550 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                    <i class="fa-solid fa-gear"></i>
                    Dashboard
                </a>

                {{-- Saved jobs --}}
                <a href="/bookmarks"
                    class="flex items-center justify-center  gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 font-medium text-gray-800 hover:text-pumpkin-550 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                    <i class="fa-solid fa-bookmark"></i>
                    Saved Jobs
                </a>



                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center justify-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 font-medium text-gray-800 hover:text-pumpkin-550 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                        <i class="fa fa-sign-out"></i> Logout
                    </button>
                </form>
            @else
                {{-- Login --}}
                <a href="{{ route('login') }}"
                    class="flex items-center justify-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 font-medium text-gray-800 hover:text-pumpkin-550 text-sm hover:bg-gray-50 disabled:text-gray-500">
                    <i class="fa fa-sign-in text-xl mt-1"></i>
                    Login / Register
                </a>
            @endauth

        </div>
    </div>
</div>
