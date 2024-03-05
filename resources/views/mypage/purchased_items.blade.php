<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    @if ($purchasedItems->isEmpty())
        <p class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4">まだ購入した商品はありません</p>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach ($purchasedItems as $item)
                @foreach ($item->item->images as $image)
                    <div class="relative mx-2">
                        <a href="{{ route('user.item.show', $item->item) }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $item->item->name }}">
                            <span
                                class="absolute bottom-0 left-0 px-2 py-1 bg-black bg-opacity-40 text-white rounded-tr-xl rounded-br-xl">¥{{ number_format($item->item->price) }}</span>
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>
    @endif
</div>
