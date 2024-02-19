<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="grid grid-cols-5 gap-4">
        @foreach ($purchasedItems as $item)
            @foreach ($item->item->images as $image)
                <div class="relative">
                    <a href="{{ route('user.item.show', $item->item) }}">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $item->item->name }}">
                        <span class="absolute bottom-0 left-0 px-2 py-1 bg-black bg-opacity-40 text-white rounded-tr-xl rounded-br-xl">¥{{ number_format($item->item->price) }}</span>
                    </a>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
