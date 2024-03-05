<x-app-layout>
    <x-message :message="session('message')" />
    <x-error-message :message="session('error')" />

    <div class="py-6 lg:py-12 flex justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full lg:w-4/5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col lg:flex-row items-center p-6">
                    <div class="flex items-center mb-2 lg:mb-0">
                        <img src="{{ asset('storage/avatar/' . $user->avatar) }}" alt="User Avatar"
                            class="w-10 h-10 rounded-full mr-4">
                        <h2 class="text-2xl text-neutral-600 font-bold">
                            @if ($user->profile && $user->profile->display_name)
                                {{ $user->profile->display_name }}
                            @else
                                {{ $user->name ?? '名無しさん' }}
                            @endif
                        </h2>
                    </div>
                    <div class="ml-2 md:mb-2 flex items-center">
                        <!-- ☆の表示位置を調整 -->
                        @if ($user->ratings->isNotEmpty())
                            @php
                                $averageRating = $user->averageRating();
                                $roundedRating = round($averageRating);
                            @endphp
                            <a href="{{ route('user.rating.index', ['userId' => $user->id]) }}" class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $roundedRating)
                                        <i class="fa fa-star text-yellow-500"></i>
                                    @else
                                        <i class="fa fa-star text-gray-400"></i>
                                    @endif
                                @endfor
                            </a>
                        @endif
                    </div>

                    <div class="mb-4 lg:ml-auto lg:mb-0">
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
                </div>

                <p class="text-gray-600 whitespace-pre-line p-6 text-base">
                    @if ($user->profile && $user->profile->introduction)
                        {{ $user->profile->introduction }}
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div id="item-list">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if ($userItems->isEmpty())
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">まだ出品した商品はありません
                    </div>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        @foreach ($userItems as $item)
                            <div class="relative mx-3">
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
