<div>
    <form wire:submit.prevent="login" class="space-y-5">
        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-yellow-800">Email</label>
            <input
                wire:model.defer="email"
                type="email"
                id="email"
                required
                class="mt-1 block w-full rounded-md border-yellow-400 shadow-sm focus:border-yellow-600 focus:ring-yellow-600"
            />
            @error('email')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-yellow-800">Password</label>
            <input
                wire:model.defer="password"
                type="password"
                id="password"
                required
                class="mt-1 block w-full rounded-md border-yellow-400 shadow-sm focus:border-yellow-600 focus:ring-yellow-600"
            />
            @error('password')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input type="checkbox" wire:model.defer="remember" id="remember" class="mr-2 border-yellow-400 rounded text-yellow-700 focus:ring-yellow-600">
            <label for="remember" class="text-yellow-900 text-sm">Remember me</label>
        </div>

        <!-- Submit -->
        <div>
            <button
                type="submit"
                class="w-full py-2 px-4 bg-yellow-700 hover:bg-yellow-800 text-white font-semibold rounded-md shadow-md transition duration-300"
            >
                Login
            </button>
        </div>
    </form>
</div>
