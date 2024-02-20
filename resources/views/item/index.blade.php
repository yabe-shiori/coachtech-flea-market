<x-app-layout>
    <x-message :message="session('message')" />
    <x-slot name="subheader">
        <h2 class="font-semibold text-xl leading-tight">
            <a href="{{ route('user.item.index') }}" id="recommendedLink" class="mr-4" style="color:#e57373;">おすすめ</a>
            <a href="javascript:void(0)" id="myListLink" onclick="loadMyList()">マイリスト</a>
        </h2>
    </x-slot>

    <div id="item-list" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-5 gap-4">
                @foreach ($itemImages as $item)
                    @foreach ($item->images as $image)
                        <div class="relative">
                            <a href="{{ route('user.item.show', $item) }}">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $item->name }}">
                                @if ($item->isSold())
                                    <div class="absolute top-0 left-0 bg-red-500 text-base text-white font-bold px-5 py-1">SOLD</div>
                                @endif
                                <span
                                    class="absolute bottom-0 left-0 px-2 py-1 bg-black bg-opacity-40 text-white rounded-tr-xl rounded-br-xl">¥{{ number_format($item->price) }}</span>
                            </a>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <script>
        function loadMyList() {
            fetch('{{ route('user.mylist') }}')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('item-list').innerHTML = data;
                    document.getElementById('myListLink').style.color = '#e57373';
                    document.getElementById('recommendedLink').style.color = 'black';
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</x-app-layout>
