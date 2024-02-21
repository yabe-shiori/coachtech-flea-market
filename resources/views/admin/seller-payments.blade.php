<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6">出品者への送金額確認</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden border">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">商品ID</th>
                        <th class="px-4 py-2 border">商品名</th>
                        <th class="px-4 py-2 border">出品者</th>
                        <th class="px-4 py-2 border">売却金額</th>
                        <th class="px-4 py-2 border">売却日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($soldItems as $key => $item)
                        <tr class="{{ $key % 2 == 0 ? 'bg-gray-100' : '' }}">
                            <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $item->item->id }}</td>
                            <td class="px-4 py-2 border">{{ $item->item->name }}</td>
                            <td class="px-4 py-2 border">{{ $item->item->user->name }}</td>
                            <td class="px-4 py-2 border">{{ number_format($item->item->price, 0) }}</td>
                            <td class="px-4 py-2 border">{{ $item->sold_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
