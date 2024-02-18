<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    @if ($message)
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($favoriteItems->isEmpty())
        <p class="text-xl">お気に入りに登録されている商品はまだありません。</p>
    @else
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
    @endif
</div>
