<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            @if ($items->isEmpty())
                <p class="text-center">検索結果はありません。</p>
            @else
                <div class="grid grid-cols-5 gap-4">
                    @foreach ($items as $item)
                        @foreach ($item->images as $image)
                            <div class="relative">
                                <a href="{{ route('user.item.show', $item) }}">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $item->name }}">
                                    <span
                                        class="absolute bottom-0 left-0 px-2 py-1 bg-black bg-opacity-40 text-white rounded-tr-xl rounded-br-xl">¥{{ number_format($item->price) }}
                                    </span>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
