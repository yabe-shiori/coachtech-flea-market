<x-app-layout>
    <x-message :message="session('message')" />
    <div class="bg-white shadow border-b-2 border-gray-400">
        <div class="max-w-7xl mx-auto pt-4 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:justify-around items-center">
                <div class="md:flex md:items-center mb-8">
                    <img src="{{ asset('storage/avatar/' . Auth::user()->avatar) }}" alt="User Avatar"
                        class="w-32 h-32 rounded-full mr-4">
                    <div>
                        <h2 class="text-2xl font-bold">{{ Auth::user()->name ? Auth::user()->name : '未設定' }}</h2>
                    </div>
                </div>
                <div class="text-center md:text-right">
                    <a href="{{ route('user.mypage.edit') }}"
                        class="inline-block py-2 px-4 border-2 border-red-500 font-bold text-xl text-red-500 hover:bg-white hover:text-red-500 rounded-md">プロフィールを編集</a>
                </div>
            </div>
            <div class="md:flex md:items-center mb-4">
                <a href="{{ route('user.mypage.index') }}" id="selling-link"
                    class="inline-block mr-10 text-gray-500 text-xl font-bold" style="color: #e57373;">出品した商品</a>
                <a href="javascript:void(0)" id="purchased-link" class="inline-block text-xl font-bold"
                    onclick="loadPurchasedItems()">購入した商品</a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div id="item-list" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-5 gap-4">
                    @foreach ($userItems as $item)
                        <div class="relative">
                            @if ($item->images->isNotEmpty())
                                <a href="{{ route('user.item.show', $item) }}">
                                    <img src="{{ asset('storage/' . $item->images->first()->image_path) }}"
                                        alt="{{ $item->name }}">
                                    <span
                                        class="absolute bottom-0 left-0 px-2 py-1 bg-black bg-opacity-40 text-white rounded-tr-xl rounded-br-xl">¥{{ number_format($item->price) }}</span>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function loadPurchasedItems() {
        fetch('{{ route('user.mypage.purchasedItems') }}')
            .then(response => response.text())
            .then(data => {
                document.getElementById('item-list').innerHTML = data;
                document.getElementById('selling-link').style.color = 'black';
                document.getElementById('purchased-link').style.color = '#e57373';
            })
            .catch(error => console.error('Error:', error));
    }
</script>
