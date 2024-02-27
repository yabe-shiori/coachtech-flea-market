<nav x-data="{ open: false }" class="bg-black border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <!-- Logo and Text -->
        <div class="flex items-center">
            <a href="{{ route('user.item.index') }}" class="hidden lg:flex">
                <x-application-logo class="block h-9 w-auto fill-current text-white" />
                {{-- <h1 class="text-white text-3xl font-bold ml-4 mr-6">COACHTECH</h1> --}}
            </a>
        </div>

        <!-- Search Box -->
        <div class="flex-grow justify-center items-center space-x-4 ml-8">
            <form action="{{ route('user.item.search') }}" method="GET">
                <input type="text" name="query" class="form-input w-4/5 rounded-lg" placeholder="何をお探しですか？">
            </form>
        </div>

        <!-- Navigation Links -->
        <div class="hidden md:flex items-center space-x-4 sm:space-x-8 flex-wrap">
            @auth
                <form id="logoutForm" method="POST" action="{{ route('user.logout') }}">
                    @csrf
                </form>
                <x-nav-link href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                    class="text-white">
                    ログアウト
                </x-nav-link>

                <x-nav-link :href="route('user.mypage.index')" :active="request()->routeIs('user.mypage.index')" class="text-white">
                    マイページ
                </x-nav-link>
                <x-nav-link :href="route('user.item.create')" :active="request()->routeIs('user.item.create')"
                    class="inline-flex items-center justify-center bg-white text-black px-4 py-1.5 rounded-md"
                    style="line-height: 1.25rem;">
                    <i class="fas fa-camera mr-2"></i>
                    出品
                </x-nav-link>
            @else
                <x-nav-link :href="route('user.login')" class="text-white">
                    ログイン
                </x-nav-link>
                <x-nav-link :href="route('user.register')" class="text-white">
                    会員登録
                </x-nav-link>
                <x-nav-link :href="route('user.item.create')" :active="request()->routeIs('user.item.create')"
                    class="inline-flex items-center justify-center bg-white text-black px-4 py-1.5 rounded-md"
                    style="line-height: 1.25rem;">
                    出品
                </x-nav-link>
            @endauth
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
            @auth

                <x-responsive-nav-link :href="route('user.item.index')" :active="request()->routeIs('user.mypage.index')">
                    ホーム
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.mypage.index')" :active="request()->routeIs('user.mypage.index')">
                    マイページ
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.item.create')" :active="request()->routeIs('user.item.create')">
                    出品
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('user.logout')"
                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            @else
                <x-responsive-nav-link :href="route('user.item.index')" :active="request()->routeIs('user.mypage.index')">
                    ホーム
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.login')">
                    ログイン
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.register')">
                    会員登録
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.item.create')" :active="request()->routeIs('user.item.create')">
                    出品
                </x-responsive-nav-link>
            @endauth
        </div>
    </div>
</nav>
