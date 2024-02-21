<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex items-center">
                    <!-- アバター -->
                    <img src="{{ asset('storage/avatar/' . $user->avatar) }}" alt="User Avatar"
                        class="w-10 h-10 rounded-full mr-4">

                    <!-- 自己紹介文 -->
                    <div>
                        <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                        <p class="text-gray-600">{{ $user->introduction }}</p>
                    </div>

                    <!-- フォローボタン -->
                    <div class="ml-auto">
                        <button class="bg-white border border-red-500 text-red-500 font-bold py-2 px-4 rounded flex items-center">
                            <i class="fa fa-plus-circle mr-2 px-2" aria-hidden="true"></i>
                            <span>フォロー</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div id="item-list" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if ($userItems->isEmpty())
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">まだ出品した商品はありません</div>
                @else
                    <div class="grid grid-cols-5 gap-4">
                        @foreach ($userItems as $item)
                            <div class="relative">
                                @if ($item->images->isNotEmpty())
                                    <a href="{{ route('user.item.show', $item) }}">
                                        <img src="{{ asset('storage/' . $item->images->first()->image_path) }}"
                                            alt="{{ $item->name }}">
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
</x-app-layout>
