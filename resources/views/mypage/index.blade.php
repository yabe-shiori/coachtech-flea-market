<x-app-layout>
    <x-message :message="session('message')" />
    <x-error-message :message="session('error')" />

    <div class="bg-white shadow border-b-2 border-gray-400">
        <div class="max-w-7xl mx-auto pt-4 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:justify-between items-center">
                <div class="md:flex md:items-center mb-8">
                    <img src="{{ asset('storage/avatar/' . Auth::user()->avatar) }}" alt="User Avatar"
                        class="w-32 h-32 rounded-full md:mr-4">
                    <div>
                        @if (optional(Auth::user()->profile)->display_name)
                            <h2 class="text-2xl font-bold">{{ Auth::user()->profile->display_name }}</h2>
                        @elseif (Auth::user()->name)
                            <h2 class="text-2xl font-bold">{{ Auth::user()->name }}</h2>
                        @endif
                    </div>
                </div>
                <div class="text-center md:text-right">
                    <a href="{{ route('user.mypage.edit') }}"
                        class="inline-block py-2 px-4 border-2 border-red-500 font-bold text-xl text-red-500 hover:bg-white hover:text-red-500 rounded-md">プロフィールを編集</a>

                    <a href="{{ route('user.following') }}"
                        class="inline-block mt-4 md:mt-0 md:ml-6 text-gray-500 hover:text-red-500 transition-colors duration-300 hover:bg-gray-100 rounded-lg py-2 px-4">
                        <i class="fas fa-user-friends text-gray-500 md:mr-1"></i>
                        <span class="text-gray-500">フォロー中のユーザー</span>
                    </a>
                    <a href="{{ route('user.showInvitationCode') }}"
                        class="inline-block mt-4 md:mt-0 md:ml-6 text-gray-500 hover:text-red-500 transition-colors duration-300 hover:bg-gray-100 rounded-lg py-2 px-4">
                        <i class="fas fa-gift text-gray-500 md:mr-1"></i>
                        <span class="text-gray-500">招待キャンペーン</span>
                    </a>

                </div>
            </div>
            <div class="md:flex md:items-center mt-6 mb-2">
                <a href="{{ route('user.mypage.index') }}" id="selling-link"
                    class="inline-block mr-10 text-gray-500 text-xl font-bold" style="color: #e57373;">出品した商品</a>
                <a href="javascript:void(0)" id="purchased-link" class="inline-block text-xl font-bold"
                    onclick="loadPurchasedItems()">購入した商品</a>
            </div>

        </div>
    </div>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div id="item-list" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if ($userItems->isEmpty())
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">まだ出品した商品はありません
                    </div>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        @foreach ($userItems as $item)
                            <div class="relative mx-2">
                                @if ($item->images->isNotEmpty())
                                    <a href="{{ route('user.item.edit', $item) }}" class="block">
                                        <img src="{{ asset('storage/' . $item->images->first()->image_path) }}"
                                            alt="{{ $item->name }}" class="cursor-pointer hover:opacity-80">
                                        @if ($item->isSold())
                                            <div class="absolute top-0 left-0">
                                                <span
                                                    class="inline-flex items-center justify-center bg-red-500 text-white font-bold px-2 py-1 rounded-full shadow">
                                                    <i class="fas fa-ban mr-1"></i> SOLD OUT
                                                </span>
                                            </div>
                                        @endif
                                        <span
                                            class="absolute bottom-0 left-0 px-2 py-1 bg-black bg-opacity-40 text-white rounded-tr-xl rounded-br-xl">¥{{ number_format($item->price) }}</span>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        function loadPurchasedItems() {
            fetch('{{ route('user.mypage.purchasedItems') }}')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('item-list').innerHTML = data;
                    document.getElementById('selling-link').style.color = 'black';
                    document.getElementById('purchased-link').style.color = '#e57373';
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</x-app-layout>
