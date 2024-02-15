<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex items-center justify-center">
            <div class="grid grid-cols-2 gap-8">
                <div class="max-w-sm">
                    <img src="{{ asset('storage/' .$item->images->first()->image_path) }}" alt="{{ $item->name }}" class="w-full">
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-black mb-4">{{ $item->name }}</h2>
                    <p class="text-lg font-semibold text-gray-800 mb-4"> ¥{{ number_format($item->price) }}（値段）</p>
                    <div class="flex items-center mb-2">
                        <form action="{{ route('user.favorite.store', ['item_id' => $item->id]) }}" method="POST">
                            @csrf
                            <button type="submit">
                                <i class="far fa-star text-yellow-500"></i>
                            </button>
                        </form>
                        <a href="{{ route('user.message.show', ['item' => $item->id]) }}" class="ml-2"><i class="far fa-comment"></i></a>
                    </div>
                    <a href="{{ route('user.payment.create', ['item' => $item]) }}" class="inline-block bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-600">購入する</a>

                    <h3 class="text-lg text-gray-700 font-bold mb-2">商品説明</h3>
                    <p>{{ $item->description }}</p>
                    <h3 class="text-lg text-gray-700 font-bold my-4">商品の情報</h3>
                    <div class="flex items-center mb-4">
                        <p class="mr-4 font-bold">カテゴリー</p>
                        @foreach ($item->category as $category)
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                            {{ $category->name }}
                        </span>
                        @endforeach
                    </div>
                    <div class="flex items-center mb-2">
                        <p class="mr-4 font-bold">商品の状態</p>
                        <span class="inline-block  px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $item->condition }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
