<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-message :message="session('message')" />

    <form method="POST" action="{{ route('user.login') }}">
        @csrf

        <h2 class="text-2xl text-center font-bold mt-8 mb-10">ログイン</h2>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-14 w-full">
            <x-primary-button class="w-full bg-red-400 font-bold flex items-center justify-center">
                ログインする
            </x-primary-button>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('user.login.google') }}" class="ml-3 inline-flex items-center">
                <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png"
                    style="margin-left: 3em;">
            </a>
        </div>

        <div class="text-center mt-4">
            <a class="text-blue-500 hover:underline text-sm hover:text-blue-700" href="{{ route('user.register') }}">
                会員登録はこちら
            </a>
        </div>
    </form>
</x-guest-layout>
