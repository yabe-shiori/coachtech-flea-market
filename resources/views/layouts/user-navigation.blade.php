<nav x-data="{ open: false }" class="bg-black border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="{{ route('user.item.index') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-white" />
            </a>
        </div>

        <!-- Search Box -->
        <div class="flex flex-grow justify-center items-center">
            <input type="text" class="form-input w-96 rounded-lg" placeholder="なにをお探しですか？">
        </div>

        <!-- Navigation Links -->
        <div class="flex items-center space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <form id="logoutForm" method="POST" action="{{ route('user.logout') }}">
                @csrf
            </form>
            <x-nav-link href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                class="text-white text-xl font-normal">
                ログアウト
            </x-nav-link>

            <x-nav-link :href="route('user.item.index')" :active="request()->routeIs('user.index')" class="text-white text-xl font-normal">
                マイページ
            </x-nav-link>
            <x-nav-link :href="route('user.item.create')" :active="request()->routeIs('user.item.create')"
                class="inline-flex items-center justify-center bg-white text-xl font-normal text-black px-4 py-1.5 rounded-md text-lg"
                style="line-height: 1.25rem;">
                出品
            </x-nav-link>
        </div>

        <!-- Hamburger -->
        <div class="-me-2 flex items-center sm:hidden">
            <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('user.item.index')" :active="request()->routeIs('user.index')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">
                    @if (Auth::check())
                        {{ Auth::user()->name }}
                    @endif
                </div>
                <div class="font-medium text-sm text-gray-500">
                    @if (Auth::check())
                        {{ Auth::user()->email }}
                    @endif
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('user.profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('user.logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
