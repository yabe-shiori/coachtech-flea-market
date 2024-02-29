<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('admin.login') }}" class="w-2/3 mx-auto lg:w-2/5">
        @csrf

        <h2 class="text-2xl text-center font-bold mt-8 mb-12">管理者用ログイン</h2>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-10">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-14 w-full">
            <x-primary-button
                class="w-full bg-indigo-500 hover:bg-indigo-600 focus:bg-indigo-500 active:bg-indigo-500 font-bold flex items-center justify-center">
                ログインする
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
