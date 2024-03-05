<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    @if ($purchasedItems->isEmpty())
        <p class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4">まだ購入した商品はありません</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach ($purchasedItems as $item)
                <div class="relative flex flex-col mx-2">
                    <a href="{{ route('user.item.show', $item->item) }}">
                        <img src="{{ asset('storage/' . $item->item->images->first()->image_path) }}" alt="{{ $item->item->name }}">
                    </a>
                    <div class="flex justify-between items-center mt-6">
                        <span class="text-base text-gray-700">¥{{ number_format($item->item->price) }}</span>
                        <a href="{{ route('user.rating.create', ['item_id' => $item->item->id]) }}" class="px-2 py-1 bg-blue-500 text-white rounded-full">評価を入力する</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
