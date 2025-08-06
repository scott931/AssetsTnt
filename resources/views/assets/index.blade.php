<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-yellow-300 via-yellow-600 to-yellow-900 px-4 py-12">
        <div class="w-full max-w-2xl bg-white shadow-2xl rounded-xl p-10 space-y-6 border border-yellow-400">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="App Logo" class="h-16 w-auto">
            </div>

            <!-- Title -->
            <h2 class="text-3xl font-bold text-center text-yellow-800">
                {{ __('Login to Your Account') }}
            </h2>

            @if (session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Livewire Login Form -->
            <form wire:submit.prevent="login" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-yellow-900 text-sm font-medium">Email</label>
                    <input wire:model.defer="email" id="email" type="email" class="mt-1 block w-full border-yellow-400 focus:border-yellow-600 focus:ring-yellow-500 rounded-md shadow-sm" required autofocus>
                    @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-yellow-900 text-sm font-medium">Password</label>
                    <input wire:model.defer="password" id="password" type="password" class="mt-1 block w-full border-yellow-400 focus:border-yellow-600 focus:ring-yellow-500 rounded-md shadow-sm" required>
                    @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Remember Me + Forgot -->
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center">
                        <input wire:model.defer="remember" type="checkbox" class="rounded border-gray-300 text-yellow-700 shadow-sm focus:ring-yellow-600">
                        <span class="ms-2 text-sm text-yellow-900">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-yellow-800 hover:underline">Forgot password?</a>
                    @endif
                </div>

                <!-- Login Button -->
                <div>
                    <button type="submit" class="w-full flex justify-center px-4 py-2 bg-yellow-700 hover:bg-yellow-800 text-white font-semibold rounded-md shadow-sm transition">
                        Log in
                    </button>
                </div>
            </form>

            <!-- Register Prompt -->
            <p class="text-sm text-center text-yellow-900">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-semibold hover:underline">Register here</a>
            </p>
        </div>

        <!-- Footer -->
        <footer class="mt-6 text-center text-sm text-yellow-100">
            &copy; {{ date('Y') }} <span class="font-semibold">AssetsTnt</span>. All rights reserved.
        </footer>
    </div>
</x-guest-layout>
