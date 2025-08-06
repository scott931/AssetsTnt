<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-yellow-300 via-yellow-600 to-yellow-900 px-4 py-12">
        <div class="w-full max-w-2xl bg-white shadow-2xl rounded-xl p-10 space-y-6 border border-yellow-400">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="App Logo" class="h-16 w-auto">
            </div>

            <!-- Title -->
            <h2 class="text-3xl font-bold text-center text-yellow-800">
                {{ __('Create a New Account') }}
            </h2>
             @livewire('auth.register-form')

            <!-- Livewire Register Form -->
            <form wire:submit.prevent="register" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-yellow-900 text-sm font-medium">Full Name</label>
                    <input wire:model.defer="name" id="name" type="text" class="mt-1 block w-full border-yellow-400 focus:border-yellow-600 focus:ring-yellow-500 rounded-md shadow-sm" required>
                    @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-yellow-900 text-sm font-medium">Email</label>
                    <input wire:model.defer="email" id="email" type="email" class="mt-1 block w-full border-yellow-400 focus:border-yellow-600 focus:ring-yellow-500 rounded-md shadow-sm" required>
                    @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-yellow-900 text-sm font-medium">Password</label>
                    <input wire:model.defer="password" id="password" type="password" class="mt-1 block w-full border-yellow-400 focus:border-yellow-600 focus:ring-yellow-500 rounded-md shadow-sm" required>
                    @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-yellow-900 text-sm font-medium">Confirm Password</label>
                    <input wire:model.defer="password_confirmation" id="password_confirmation" type="password" class="mt-1 block w-full border-yellow-400 focus:border-yellow-600 focus:ring-yellow-500 rounded-md shadow-sm" required>
                </div>

                <!-- Register Button -->
                <div>
                    <button type="submit" class="w-full flex justify-center px-4 py-2 bg-yellow-700 hover:bg-yellow-800 text-white font-semibold rounded-md shadow-sm transition">
                        Register
                    </button>
                </div>
            </form>

            <!-- Already Registered -->
            <p class="text-sm text-center text-yellow-900">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold hover:underline">Login here</a>
            </p>
        </div>

        <!-- Footer -->
        <footer class="mt-6 text-center text-sm text-yellow-100">
            &copy; {{ date('Y') }} <span class="font-semibold">AssetsTnt</span>. All rights reserved.
        </footer>
    </div>
</x-guest-layout>
