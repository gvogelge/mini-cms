<x-app-layout>
    <div class="flex items-center justify-center min-h-screen">
        <form method="POST" action="{{ route('register') }}"
              class="max-w-md w-full border border-black p-6 bg-white shadow space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-black font-medium mb-1">Name</label>
                <input id="name" type="text" name="name"
                       value="{{ old('name') }}"
                       required autofocus autocomplete="name"
                       class="w-full border border-black px-4 py-2
                              focus:outline-none focus:ring-0 focus:border-lime-400">
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-black font-medium mb-1">Email</label>
                <input id="email" type="email" name="email"
                       value="{{ old('email') }}"
                       required autocomplete="email"
                       class="w-full border border-black px-4 py-2
                              focus:outline-none focus:ring-0 focus:border-lime-400">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-black font-medium mb-1">Password</label>
                <input id="password" type="password" name="password"
                       required autocomplete="new-password"
                       class="w-full border border-black px-4 py-2
                              focus:outline-none focus:ring-0 focus:border-lime-400">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-black font-medium mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       required autocomplete="new-password"
                       class="w-full border border-black px-4 py-2
                              focus:outline-none focus:ring-0 focus:border-lime-400">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between mt-4">
                <a href="{{ route('login') }}"
                   class="text-sm text-gray-600 hover:text-lime-600 underline">
                    Already signed up?
                </a>

                <button type="submit"
                        class="border border-black bg-lime-600 text-black px-6 py-2 hover:bg-lime-400 transition">
                    Sign Up
                </button>
            </div>
        </form>
    </div>
</x-app-layout>