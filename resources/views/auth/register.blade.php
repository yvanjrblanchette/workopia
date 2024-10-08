<x-root-layout>

    <main class="container mx-auto p-4 my-4">
        <div class="bg-white rounded-lg shadow-md w-full md:max-w-xl mx-auto p-12">
            {{-- <h2 class="text-4xl text-center font-bold mb-2">Welcome to workscout</h2> --}}
            <div class="flex justify-center">
                <x-logo className="h-20 my-1.5" color="black" />
            </div>
            <h3 class="text-lg text-center text-marine-700 font-semibold tracking-wide mb-4">Please create an account to
                continue</h3>
            <form method="POST" action="{{ route('store') }}">
                @csrf
                <x-input type="text" label="Full Name" id="name" name="name" placeholder="Full Name"
                    className="mb-4" />
                <x-input type="email" label="Email Address" id="email" name="email" placeholder="Email Address"
                    className="mb-4" />

                <x-password label="Password" id="password" name="password" placeholder="Password" className="mb-4" />
                <x-password label="Confirm Password" id="password_confirmation" name="password_confirmation"
                    placeholder="Confirm Password" className="mb-6" />

                <x-button type="submit" icon="fa-solid fa-user-plus" label="Create Account"
                    className="w-full text-center shadow uppercase" />
                <p class="mt-4 text-gray-500 text-center">Already have an account? <a
                        class="text-pumpkin-550 font-medium hover:border-b" href="{{ route('login') }}">Login</a></p>
            </form>
        </div>
    </main>

</x-root-layout>
