<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ここにおすすめ、マイリストなどを表示
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <h1 class="text-black">商品一覧</h1>
            <div class="grid grid-cols-5 gap-4">
                @foreach($itemImages as $item)
                    @foreach($item->images as $image)
                        <div>
                            <a href="#">
                                <img src="{{ $image->image_path }}" alt="{{ $item->name }}" class="w-full">
                            </a>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
