<x-app-layout>
    <x-message :message="session('message')" />
    <x-error-message :message="session('error')" />

    <x-slot name="subheader">
        <h2 class="font-semibold text-xl leading-tight">
            <a href="{{ route('user.item.index') }}" id="recommendedLink" class="mr-4" style="color:#e57373;">おすすめ</a>
            <a href="javascript:void(0)" id="myListLink" onclick="loadMyList()">マイリスト</a>
        </h2>
    </x-slot>
    <div class="flex justify-center">
        @auth
            @if (!$alreadyReceivedToday)
                <button id="draw-fortune-btn"
                    class="bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-bold py-2 px-4 rounded-full shadow-md mt-4 transition duration-300 transform hover:scale-105">
                    <i class="fas fa-hand-holding-heart mr-2"></i> おみくじを引く
                </button>
            @endif
        @endauth
    </div>
    <div id="item-list" class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-5 gap-4">
                @foreach ($itemImages as $item)
                    @php $firstImage = $item->images->first(); @endphp
                    <div class="relative">
                        <a href="{{ route('user.item.show', $item) }}">
                            <img src="{{ asset('storage/' . $firstImage->image_path) }}" alt="{{ $item->name }}"
                                class="w-full">
                            @if ($item->isSold())
                                <div class="absolute top-0 left-0">
                                    <span
                                        class="inline-flex items-center justify-center bg-red-500 text-white font-bold px-2 py-1 rounded-full shadow">
                                        <i class="fas fa-ban mr-1"></i> SOLD OUT
                                    </span>
                                </div>
                            @endif
                            <span
                                class="absolute bottom-0 left-0 px-2 py-1 bg-black bg-opacity-40 text-white rounded-tr-xl rounded-br-xl">¥{{ number_format($item->price) }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="fortune-popup" class="fixed inset-x-0 top-0 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg border-4 border-purple-600">
            <p id="fortune-result" class="text-xl font-semibold mb-2 text-center"></p>
            <p id="fortune-category" class="text-3xl font-bold mb-4 text-center" style="color: red;"></p>
            <p id="points-awarded" class="text-lg mb-4 text-center"></p>
            <button id="close-popup-btn"
                class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full block mx-auto">閉じる</button>
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

        document.getElementById('draw-fortune-btn').addEventListener('click', function() {
            fetch('/login-bonus', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        setTimeout(function() {
                            document.getElementById('fortune-result').innerHTML =
                                `<span style="color: black;">おみくじ結果</span>`;
                            document.getElementById('fortune-category').textContent = `${data.result}`;
                            document.getElementById('points-awarded').textContent =
                                `付与されたポイント: ${data.points_awarded}ポイント`;
                            document.getElementById('fortune-popup').classList.remove('hidden');
                        }, 1000);
                    } else {
                        alert('本日は既におみくじを引いています。');
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        });

        document.getElementById('close-popup-btn').addEventListener('click', function() {
            document.getElementById('fortune-popup').classList.add('hidden');
        });
    </script>
</x-app-layout>
