<x-guest-layout>
    <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
        @csrf

        <h2 class="text-2xl text-center font-bold mt-8 mb-10">会員登録</h2>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-14">
            <x-primary-button class="w-full bg-red-400 font-bold flex items-center justify-center">
                登録する
            </x-primary-button>
        </div>

        <div class="text-center mt-4">
            <a class="text-blue-500 hover:underline text-base hover:text-blue-700" href="{{ route('user.login') }}">
                ログインはこちら
            </a>
        </div>
    </form>
</x-guest-layout>
