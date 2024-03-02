<x-app-layout>
    <x-message :message="session('message')" />
    <x-error-message :message="session('error')" />

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <div class="max-w-sm mx-auto md:relative">
                    <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" alt="{{ $item->name }}"
                        class="w-full">
                    @if ($item->isSold())
                        <div class="absolute top-0 left-0">
                            <span
                                class="inline-flex items-center justify-center bg-red-500 text-white font-bold px-3 py-1 rounded-full shadow">
                                <i class="fas fa-ban mr-1"></i> SOLD OUT
                            </span>
                        </div>
                    @endif
                </div>
                <div class="mt-6 md:mt-0 md:w-3/4 mx-auto">
                    <h2 class="text-xl md:text-2xl font-bold text-black mb-2 md:mb-4">{{ $item->name }}</h2>
                    <p class="text-base md:text-lg font-semibold text-gray-800 mb-4">¥{{ number_format($item->price) }}
                    </p>
                    <div class="flex flex-wrap items-center mb-4">
                        @if (Auth::check() && Auth::user()->isFavorite($item->id))
                            <form action="{{ route('user.removeFavorite', ['item_id' => $item->id]) }}" method="POST"
                                class="flex items-center mr-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-center text-center">
                                    <i class="fas fa-star text-yellow-500"></i>
                                    <span class="text-xs text-gray-500 ml-1">{{ $item->favorites()->count() }}</span>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('user.favorite', ['item_id' => $item->id]) }}" method="POST"
                                class="flex items-center mr-3">
                                @csrf
                                <button type="submit" class="flex items-center justify-center text-center">
                                    <i class="far fa-star text-gray-500"></i>
                                    <span class="text-xs text-gray-500 ml-1">{{ $item->favorites()->count() }}</span>
                                </button>
                            </form>
                        @endif
                        <div class="flex items-center">
                            <a href="{{ route('user.comment.show', ['item' => $item->id]) }}"
                                class="flex items-center justify-center text-center">
                                <i class="far fa-comment fa-lg"></i>
                                <span class="text-xs text-gray-500 ml-1">{{ $item->comments->count() }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="mb-6">
                        @foreach ($comments as $comment)
                            <div class="mb-4">
                                <div
                                    class="flex items-center mb-2 {{ $comment->sender_id == $item->user_id ? 'justify-end' : 'justify-start' }}">
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
                                        @if ($comment->read_at && $comment->sender_id == Auth::id())
                                            <span class="text-gray-700 ml-2">既読</span>
                                        @endif
                                    </p>
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
                    <div class="mb-6">
                        {{ $comments->links() }}
                    </div>
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
