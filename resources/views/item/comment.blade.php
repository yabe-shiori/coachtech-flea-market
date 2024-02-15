<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-8">
                        <div class="max-w-sm">
                            <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" alt="{{ $item->name }}" class="w-full">
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-black mb-4">{{ $item->name }}</h2>
                            <p class="text-lg font-semibold text-gray-800 mb-4">¥{{ number_format($item->price) }}（値段）</p>
                            <div class="flex items-center mb-4">
                                <form action="{{ route('user.favorite.store', ['item_id' => $item->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit">
                                        <i class="far fa-star text-yellow-500"></i>
                                    </button>
                                </form>
                                <a href="{{ route('user.comment.show', ['item' => $item->id]) }}" class="ml-2"><i class="far fa-comment"></i></a>
                            </div>
                            <!-- コメントの入力欄 -->
                            <div class="mb-4">
                                <form action="{{ route('user.comment.store', ['item' => $item->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <textarea name="body" rows="4" class="w-full border rounded-md p-2 mb-2"></textarea>
                                    <x-primary-button type="submit">コメントを送信する</x-primary-button>
                                </form>
                            </div>
                            <!-- コメント表示エリア -->
                            <div>
                                <h3 class="text-lg font-bold mb-2">コメント</h3>
                                @foreach($item->comments as $comment)
                                    <div class="border rounded-md p-2 mb-2">
                                        <p><strong>{{ $comment->sender->name }}</strong>：{{ $comment->body }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
