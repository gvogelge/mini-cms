<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Branding und Navigation -->
            <div class="flex items-center space-x-4">
                <p class="border border-1 border-black px-2 text-lime-500 select-none">Mini-CMS</p>

                <a href="{{ route('home') }}" class="text-gray-700 hover:text-lime-500 font-medium transition">
                    Home
                </a>

                @auth
                    <a href="{{ route('posts.create') }}" class="text-gray-700 hover:text-lime-500 font-medium transition">
                        Beitrag erstellen
                    </a>
                @endauth
            </div>

            <!-- User Dropdown / Login Links -->
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-sm text-gray-600">Hallo, {{ Auth::user()->name }}</span>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 hover:text-lime-600 focus:outline-none transition">
                                <span>Menu</span>
                                <svg class="ms-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profil
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-lime-500">Login</a>
                    <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-lime-500">Sign Up</a>
                @endguest
            </div>
        </div>
    </div>
</nav>