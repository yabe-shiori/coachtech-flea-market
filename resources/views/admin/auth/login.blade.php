<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <h2 class="text-2xl text-center font-bold mt-8 mb-10">管理者用ログイン</h2>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-14 w-full">
            <x-primary-button class="w-full bg-indigo-500 hover:bg-indigo-600 font-bold flex items-center justify-center">
                ログインする
            </x-primary-button>
        </div>

        {{-- </div> --}}
        {{-- <div class="text-center mt-4">
            <a class="text-blue-500 hover:underline text-sm hover:text-blue-700" href="{{ route('admin.register') }}">
                会員登録はこちら
            </a>
        </div> --}}
    </form>
</x-guest-layout>
