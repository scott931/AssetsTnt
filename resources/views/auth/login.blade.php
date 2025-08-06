<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-yellow-300 via-yellow-600 to-yellow-900 px-4 py-12">
        <div class="w-full max-w-md bg-white shadow-2xl rounded-xl p-8 space-y-6 border border-yellow-400">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo2.png') }}" alt="App Logo" class="h-20 w-auto">
            </div>

            <!-- Page Title -->
            <h2 class="text-2xl font-bold text-center text-yellow-800 tracking-tight">
                {{ __('Login to Your Account') }}
            </h2>
            
            <!-- Livewire Login Form -->
            @livewire('auth.login-form')
        </div>

        <!-- Footer with Branding -->
        <footer class="mt-6 text-center text-sm text-yellow-100">
            &copy; {{ date('Y') }} <span class="font-semibold">The National Treasury</span>. All rights reserved.
            <br>
            <span class="font-semibold"></span>.
        </footer>
    </div>
</x-guest-layout>
