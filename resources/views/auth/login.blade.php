<x-app-layout>
    <div class="flex items-center justify-center min-h-screen">
        <form method="POST" action="{{ route('login') }}"
              class="max-w-md w-full mt-10 border border-black p-6 bg-white shadow space-y-6">
            @csrf

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-black font-medium mb-1">Email</label>
                <input id="email" type="email" name="email"
                       value="{{ old('email') }}"
                       required autofocus autocomplete="username"
                       class="w-full border border-black px-4 py-2
                              focus:outline-none focus:ring-0 focus:border-lime-400">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-black font-medium mb-1">Password</label>
                <input id="password" type="password" name="password"
                       required autocomplete="current-password"
                       class="w-full border border-black px-4 py-2
                              focus:outline-none focus:ring-0 focus:border-lime-400">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                       class="border-black text-lime-400 focus:ring-0 focus:outline-none">
                <label for="remember_me" class="ms-2 text-sm text-gray-700">Remember me</label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-gray-600 hover:text-lime-600 underline">
                        Forgot your password?
                    </a>
                @endif

                <button type="submit"
                        class="border border-black bg-lime-600 text-black px-6 py-2 hover:bg-lime-400 transition">
                    Log in
                </button>
            </div>
        </form>
    </div>
</x-app-layout>