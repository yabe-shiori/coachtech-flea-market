<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold mb-4">商品一覧</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($items as $item)
                        <div class="border border-gray-300 rounded-lg p-4">
                            <div class="aspect-w-1 aspect-h-1">
                                <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" alt="{{ $item->name }}" class="object-cover w-full h-full">
                            </div>
                            <h3 class="text-lg font-semibold">{{ $item->name }}</h3>
                            <p class="text-gray-500 mb-2">価格: ¥{{ number_format($item->price) }}</p>
                            <p class="text-gray-500 mb-2">状態: {{ $item->condition }}</p>
                            <p class="text-gray-500">{{ $item->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

