<x-app-layout>
    <x-slot name="subheader">
        <div class="flex flex-col md:flex-row md:justify-around items-center">
            <div class="md:flex md:items-center mb-4">
                <img src="{{ asset('storage/avatar/' . Auth::user()->profile->avatar) }}" alt="User Avatar"
                    class="w-32 h-32 rounded-full mr-4">
                <div>
                    <h2 class="text-2xl font-bold">{{ Auth::user()->name ? Auth::user()->name : '未設定' }}</h2>
                </div>
            </div>
            <div class="text-center md:text-right">
                <a href="{{ route('user.mypage.edit') }}"
                    class="inline-block py-2 px-4 border-2 border-red-500 font-bold text-xl text-red-500 hover:bg-white hover:text-red-500 rounded-md">プロフィールを編集</a>
            </div>
        </div>
        <div class="md:flex md:items-center mb-4">
            <a href="" class="inline-block mr-4 text-gray-500 text-xl font-bold hover:underline">出品した商品</a>
            <a href="" class="inline-block text-gray-500 text-xl font-bold hover:underline">購入した商品</a>
        </div>

    </x-slot>

</x-app-layout>
