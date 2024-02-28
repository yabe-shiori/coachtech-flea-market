<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-2xl text-neutral-600 font-bold mb-8 ml-4">フォロー中のユーザー</h2>
                @if ($following->isEmpty())
                    <p class="text-gray-500">フォロー中のユーザーはいません。</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        @foreach ($following as $followedUser)
                            <div
                                class="bg-gray-100 p-4 rounded-lg hover:bg-gray-200 transition duration-300 ease-in-out">
                                <a href="{{ route('user.following.items', ['user' => $followedUser->id]) }}"
                                    class="text-blue-500 hover:underline block">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('storage/avatar/' . $followedUser->avatar) }}"
                                                alt="{{ $followedUser->name }}" class="w-10 h-10 rounded-full">
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-lg font-semibold truncate">
                                                {{ $followedUser->profile && $followedUser->profile->display_name ? $followedUser->profile->display_name : $followedUser->name }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
