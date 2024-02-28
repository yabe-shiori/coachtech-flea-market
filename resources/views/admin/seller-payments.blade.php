<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-xl font-bold mb-6">出品者への送金額確認</h1>

        <div class="overflow-x-auto">
            <div class="shadow-md rounded overflow-hidden">
                <div class="min-w-full overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-4 py-2 border border-black">No</th>
                                <th class="px-4 py-2 border border-black">商品ID</th>
                                <th class="px-4 py-2 border border-black">商品名</th>
                                <th class="px-4 py-2 border border-black">出品者</th>
                                <th class="px-4 py-2 border border-black">売却金額</th>
                                <th class="px-4 py-2 border border-black">売却日時</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soldItems as $key => $item)
                                <tr class="{{ $key % 2 == 0 ? 'bg-gray-100' : '' }}">
                                    <td class="px-4 py-2 border border-black">{{ $soldItems->firstItem() + $key }}</td>
                                    <td class="px-4 py-2 border border-black">{{ $item->item->id }}</td>
                                    <td class="px-4 py-2 border border-black">{{ $item->item->name }}</td>
                                    <td class="px-4 py-2 border border-black">{{ $item->item->user->name }}</td>
                                    <td class="px-4 py-2 border border-black">{{ number_format($item->item->price, 0) }}
                                    </td>
                                    <td class="px-4 py-2 border border-black">{{ $item->sold_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $soldItems->links() }}
        </div>
    </div>
</x-app-layout>
