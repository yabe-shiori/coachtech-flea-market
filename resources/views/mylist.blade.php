<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h1 class="text-black">マイリスト</h1>
    <div class="grid grid-cols-5 gap-4">
        @foreach($favoriteItems as $favorite)
            <div class="relative">
                <a href="{{ route('user.item.show', $favorite->item) }}">
                    <img src="{{ asset('storage/' . $favorite->item->images->first()->image_path) }}" alt="{{ $favorite->item->name }}">
                    <span class="absolute bottom-0 left-0 px-2 py-1 bg-black bg-opacity-40 text-white rounded-tr-xl rounded-br-xl">¥{{ number_format($favorite->item->price) }}</span>
                </a>
            </div>
        @endforeach
    </div>
</div>
