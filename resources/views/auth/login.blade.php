<x-root-layout>

    <main class="container mx-auto p-4 my-4">
        <div class="bg-white shadow-md w-full md:max-w-xl mx-auto p-12">
            <div class="flex justify-center">
                <x-logo className="h-20 my-1.5" color="color" />
            </div>
            <h3 class="text-lg text-center text-marine-700 font-semibold tracking-wide mb-4">Please login to your account
                to continue</h3>
            <form method="POST" action="{{ route('authenticate') }}">
                @csrf
                <x-input type="email" label="Email Address" id="email" name="email" placeholder="Email Address"
                    className="mb-4" />
                <x-password label="Password" id="password" name="password" placeholder="Password" className="mb-6" />
                <x-button type="submit" icon="fa-solid fa-user" label="Login"
                    className="w-full text-center shadow uppercase" />

                <p class="mt-4 text-gray-500 text-center">Don't have an account? <a
                        class="text-marine-700 font-medium hover:border-b hover:text-pumpkin-550 transition"
                        href="{{ route('register') }}">Register</a></p>
            </form>
        </div>
    </main>

</x-root-layout>
