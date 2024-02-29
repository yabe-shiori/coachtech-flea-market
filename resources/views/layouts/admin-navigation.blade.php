<nav x-data="{ open: false }" class="bg-black border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <div class="flex items-center">
            <a href="{{ route('admin.dashboard') }}" class="hidden md:flex">
                <x-application-logo class="block h-9 w-auto fill-current text-white" />
            </a>
        </div>
        <!-- Navigation Links -->
        <div class="hidden md:flex items-center space-x-4 sm:space-x-8 flex-wrap">
            <form id="logoutForm" method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <x-nav-link href="#"
                    onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                    class="text-white text-xl">
                    ログアウト
                </x-nav-link>
            </form>
        </div>
        <!-- Hamburger -->
        <div class="flex items-center md:hidden">
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
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('user.mypage.index')">
                ダッシュボード
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('admin.logout')"
                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
