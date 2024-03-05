<nav x-data="{ open: false }" class="bg-black border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">

        <div class="flex items-center">
            <a href="{{ route('user.item.index') }}" class="hidden lg:flex">
                <x-application-logo class="block h-9 w-auto fill-current text-white" />
            </a>
            <svg width="53" height="26" viewBox="0 0 63 36" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="lg:hidden">
                <path
                    d="M56.6898 0H22.2598C12.3298 0 2.54982 8.06 0.419822 18C-1.72018 27.94 4.59982 36 14.5198 36H25.4098C26.8798 36 28.3298 34.81 28.6498 33.33L30.1698 26.27C30.4898 24.8 29.5498 23.6 28.0798 23.6H15.9698C13.2098 23.6 11.2598 21.47 11.7698 18.71C12.2998 15.85 15.0898 13.51 17.9298 13.51H36.9698C38.4398 13.51 39.3798 14.7 39.0598 16.18L35.3698 33.34C35.0498 34.81 35.9898 36.01 37.4598 36.01H46.2898C47.7598 36.01 49.2098 34.82 49.5298 33.34L53.2198 16.18C53.5398 14.71 54.9898 13.51 56.4598 13.51C57.9298 13.51 59.3798 12.32 59.6998 10.84L62.0298 0H56.6998L56.6898 0Z"
                    fill="white" />
            </svg>
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
