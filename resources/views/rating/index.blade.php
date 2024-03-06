<x-app-layout>

    <div class="py-6 lg:py-12 flex justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full lg:w-4/5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl text-neutral-600 font-bold mb-4">
                        @if ($user->profile && $user->profile->display_name)
                            {{ $user->profile->display_name }} さんの評価一覧
                        @elseif ($user->name)
                            {{ $user->name }} さんの評価一覧
                        @else
                            名無しさん さんの評価一覧
                        @endif
                    </h2>
                    @if ($ratings->isEmpty())
                        <div class="text-gray-600">評価はまだありません</div>
                    @else
                        <div class="divide-y divide-gray-200">
                            @foreach ($ratings as $rating)
                                <div class="py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <img class="h-12 w-12 rounded-full"
                                                src="{{ asset('storage/avatar/' . $rating->fromUser->avatar) }}"
                                                alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-base font-medium text-gray-900">
                                                {{ $rating->fromUser->name }}</div>
                                            <div class="mt-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $rating->rating)
                                                        <i class="fa fa-star text-yellow-500"></i>
                                                    @else
                                                        <i class="fa fa-star text-gray-400"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <p class="text-base text-gray-500 mt-2">{{ $rating->comment }}</p>
                                            <div class="text-sm text-gray-500">
                                                {{ $rating->created_at->format('Y/m/d H:i') }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $ratings->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
