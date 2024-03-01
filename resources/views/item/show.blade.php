<x-app-layout>
    <x-message :message="session('message')" />
    <x-error-message :message="session('error')" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="max-w-sm relative">
                    <div class="overflow-hidden">
                        <div id="imageSlider" class="flex">
                            @foreach ($item->images as $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $item->name }}" class="w-full">
                            @endforeach
                        </div>
                    </div>
                    <button id="prevButton" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-100 bg-opacity-50 px-2 py-1">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="nextButton" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-100 bg-opacity-50 px-2 py-1">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    @if ($item->isSold())
                        <div class="absolute top-0 left-0">
                            <span class="inline-flex items-center justify-center bg-red-500 text-white font-bold px-4 py-2 rounded-full shadow">
                                <i class="fas fa-ban mr-2"></i> SOLD OUT
                            </span>
                        </div>
                    @endif
                </div>

                <div class="pl-6">
                    <h2 class="text-2xl font-bold text-black">{{ $item->name }}</h2>

                    @if ($item->brand)
                        <p class="text-sm text-gray-500 mb-2">{{ $item->brand->name }}</p>
                    @endif

                    <p class="text-xl font-semibold text-gray-800 my-4"> ¥{{ number_format($item->price) }}（値段）</p>

                    <div class="flex items-center mb-2">
                        @if (Auth::check() && Auth::user()->isFavorite($item->id))
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
                                <span class="text-xs text-gray-500 mt-3">{{ $item->comments->count() }}</span>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('user.payment.create', ['item' => $item]) }}"
                        class="inline-block bg-red-500 text-white text-base text-center w-2/3 md:w-2/3 px-4 py-2 rounded-lg font-semibold mb-4 hover:bg-red-600">購入する</a>

                    <h3 class="text-xl font-bold border-b-2 border-neutral-400 text-neutral-500 mb-4 p-2">商品説明</h3>
                    <p class="text-base">{{ $item->description }}</p>

                    <h3 class="text-xl font-bold border-b-2 border-neutral-400 text-neutral-500 my-4 p-2">商品の情報</h3>
                    <div class="flex items-center mb-4">
                        <p class="mr-4 font-bold">カテゴリー</p>
                        @foreach ($item->category as $category)
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>

                    <div class="flex items-center mb-10">
                        <p class="mr-4 font-bold">商品の状態</p>
                        <span
                            class="inline-block px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $item->condition }}</span>
                    </div>

                    <div class="mb-4">
                        <p class="text-xl font-bold border-b-2 border-neutral-400 text-neutral-500 mb-4 p-2">出品者</p>
                        <div class="flex items-center mt-2">
                            <a href="{{ route('user.profile.show', ['user' => $item->user]) }}"
                                class="flex items-center text-gray-600 hover:text-red-500 transition-colors duration-300">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 overflow-hidden rounded-full">
                                        <img src="{{ asset('storage/avatar/' . $item->user->avatar) }}"
                                            alt="User Avatar" class="object-cover w-full h-full">
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-semibold hover:underline">
                                            {{ optional($item->user->profile)->display_name ?? $item->user->name }}
                                        </p>
                                        <p class="text-xs text-gray-500">View profile</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const imageSlider = document.getElementById('imageSlider');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');

        let slideIndex = 0;

        showSlides(slideIndex);

        prevButton.addEventListener('click', () => {
            showSlides(slideIndex -= 1);
        });

        nextButton.addEventListener('click', () => {
            showSlides(slideIndex += 1);
        });

        function showSlides(n) {
            const slides = document.querySelectorAll('#imageSlider img');
            if (n >= slides.length) {
                slideIndex = 0;
            }
            if (n < 0) {
                slideIndex = slides.length - 1;
            }
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = 'none';
            }
            slides[slideIndex].style.display = 'block';
        }
    </script>
</x-app-layout>
