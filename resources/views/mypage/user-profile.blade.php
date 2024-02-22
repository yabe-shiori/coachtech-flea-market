<x-app-layout>
    <x-message :message="session('message')" />
    <x-error-message :message="session('error')" />

    <div class="py-12 flex justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col items-center p-6">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('storage/avatar/' . $user->avatar) }}" alt="User Avatar"
                            class="w-10 h-10 rounded-full mr-4">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $user->profile->display_name }}</h2>
                    </div>

                    <div class="mb-4">
                        @if (Auth::check() && Auth::user()->isFollowing($user))
                            <form action="{{ route('user.unfollow', ['userId' => $user->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit"
                                    class="bg-white border border-gray-700 text-gray-700 font-bold py-1 px-8 rounded flex items-center justify-center">
                                   <i class="fa-solid fa-check mr-2"></i>
                                    <span>フォロー中</span>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('user.follow', ['user' => $user->id]) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-white border border-red-500 text-red-500 font-bold py-1 px-8 rounded flex items-center justify-center">
                                    <i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>
                                    <span>フォロー</span>
                                </button>
                            </form>
                        @endif
                    </div>

                    <p class="text-gray-600 whitespace-pre-line mt-8">{{ $user->profile->introduction }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div id="item-list" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if ($userItems->isEmpty())
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">まだ出品した商品はありません
                    </div>
                @else
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
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
