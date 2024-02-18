<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-8">
                <div class="max-w-sm">
                    <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" alt="{{ $item->name }}"
                        class="w-full">
                </div>
                <div class="w-3/4">
                    <h2 class="text-2xl font-bold text-black mb-4">{{ $item->name }}</h2>
                    <p class="text-lg font-semibold text-gray-800 mb-4">¥{{ number_format($item->price) }}（値段）</p>
                    <div class="flex items-center mb-2">
                        @if (Auth::check() && Auth::user()->isFavorite($item->id))
                            <!-- お気に入り削除フォーム -->
                            <form action="{{ route('user.removeFavorite', ['item_id' => $item->id]) }}" method="POST"
                                class="flex items-center mr-6">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex flex-col items-center justify-center text-center">
                                    <i class="fas fa-star fa-lg text-yellow-500"></i>
                                    <span class="text-xs text-gray-500 mt-3">{{ $item->favorites()->count() }}</span>
                                </button>
                            </form>
                        @else
                            <!-- お気に入り追加フォーム -->
                            <form action="{{ route('user.favorite', ['item_id' => $item->id]) }}" method="POST"
                                class="flex items-center mr-6">
                                @csrf
                                <button type="submit" class="flex flex-col items-center justify-center text-center">
                                    <i class="far fa-star fa-lg text-gray-500"></i>
                                    <span class="text-xs text-gray-500 mt-3">{{ $item->favorites()->count() }}</span>
                                </button>
                            </form>
                        @endif

                        <div class="flex items-center mr-2">
                            <a href="{{ route('user.comment.show', ['item' => $item->id]) }}"
                                class="flex flex-col items-center justify-center text-center">
                                <i class="far fa-comment fa-lg"></i>
                                <!-- コメント数 -->
                                <span class="text-xs text-gray-500 mt-3">{{ $item->comments->count() }}</span>
                            </a>
                        </div>
                    </div>

                    <!-- コメント表示部分 -->
                    <div class="mt-10">
                        @foreach ($comments as $comment)
                            <div class="mb-4">
                                <div
                                    class="flex items-center mb-2 {{ $comment->sender_id == $item->user_id ? 'flex-row-reverse' : '' }}">
                                    <img src="{{ asset('storage/avatar/' . $comment->sender->avatar) }}"
                                        alt="User Avatar"
                                        class="w-8 h-8 rounded-full {{ $comment->sender_id == $item->user_id ? 'ml-2' : 'mr-2' }}">
                                    <p>
                                        <span class="text-sm">{{ $comment->sender->name ?? '名無しさん' }}</span>
                                    </p>
                                </div>

                                <div
                                    class="border rounded-md bg-gray-200 p-2 {{ $comment->sender_id == $item->user_id ? 'text-right' : '' }}">
                                    <p>
                                        {{ $comment->body }}
                                    </p>
                                    <p class="text-xs text-gray-600">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </p>
                                    <!-- コメント削除ボタン -->
                                    @if (Auth::check() && ($comment->sender_id == Auth::id() || $item->user_id == Auth::id()))
                                        <form
                                            action="{{ route('user.comment.destroy', ['item' => $item->id, 'comment' => $comment->id]) }}"
                                            method="POST" class="inline" id="delete-comment-form-{{ $comment->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $comment->id }})"
                                                class="text-gray-400 hover:text-gray-600 p-1 rounded-full focus:outline-none focus:shadow-outline"
                                                title="コメントを削除">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- ページネーション -->
                    <div class="mt-4">
                        {{ $comments->links() }}
                    </div>
                    <!-- コメントの入力欄 -->
                    <div class="mb-4">
                        <form action="{{ route('user.comment.store', ['item' => $item->id]) }}" method="POST">
                            @csrf
                            <label for="comment" class="block text-sm font-bold">商品へのコメント</label>
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <textarea name="body" rows="4" class="w-full border rounded-md p-2 mb-2"></textarea>
                            <x-primary-button type="submit" class="w-full">コメントを送信する</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(commentId) {
            if (confirm("本当に削除しますか？")) {
                document.getElementById('delete-comment-form-' + commentId).submit();
            }
        }
    </script>
</x-app-layout>
