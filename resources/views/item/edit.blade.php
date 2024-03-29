<x-app-layout>
    <x-message :message="session('message')" />
    <x-error-message :message="session('error')" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-black mb-4 text-center">商品編集</h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 max-w-xl mx-auto">
                    <form method="POST" action="{{ route('user.item.update', $item) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="mb-4 relative">
                            <label for="image" class="block text-gray-700 text-sm font-bold mb-2 cursor-pointer">
                                <span
                                    class="block bg-white text-red-600 border-2 border-red-600 rounded-md py-2 px-4 w-full text-center">画像を選択する</span>
                            </label>
                            <input type="file" name="image[]" id="image" accept="image/*"
                                class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" required multiple
                                onchange="previewImages(event)">
                        </div>
                        <div id="imagePreview" class="flex flex-wrap justify-start gap-4">
                        </div>

                        <h3 class="text-xl font-bold border-b border-neutral-700 text-neutral-500 my-4">商品の詳細</h3>

                        <div class="mb-4">
                            <label for="category" class="block text-gray-700 text-base font-bold mb-2">カテゴリー</label>
                            <select name="category_id" id="category"
                                class="border-2 border-gray-300 rounded-md p-2 w-full" required>
                                <option value="">カテゴリーを選択してください</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                    @if ($category->children)
                                        @foreach ($category->children as $child)
                                            <option value="{{ $child->id }}" class="ml-2"
                                                {{ $item->category_id == $child->id ? 'selected' : '' }}>
                                                - {{ $child->name }}</option>
                                            @if ($child->children)
                                                @foreach ($child->children as $subChild)
                                                    <option value="{{ $subChild->id }}" class="ml-4"
                                                        {{ $item->category_id == $subChild->id ? 'selected' : '' }}>
                                                        -- {{ $subChild->name }}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="brand" class="block text-gray-700 text-base font-bold mb-2">ブランド（任意）</label>
                            <select name="brand_id" id="brand"
                                class="border-2 border-gray-300 rounded-md p-2 w-full">
                                <option value="">選択してください</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ $item->brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="condition" class="block text-black text-base font-bold mb-2">商品の状態</label>
                            <select name="condition" id="condition"
                                class="border-2 border-gray-300 rounded-md p-2 w-full" required>
                                <option value="">状態を選択</option>
                                @foreach ($conditions as $condition)
                                    <option value="{{ $condition }}"
                                        {{ $item->condition == $condition ? 'selected' : '' }}>
                                        {{ $condition }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <h3 class="text-xl font-bold border-b border-neutral-700 text-neutral-500 my-4">商品名と説明</h3>

                        <div class="mb-4">
                            <label for="name" class="block text-base font-bold mb-2">商品名</label>
                            <input type="text" name="name" id="name"
                                class="border-2 border-gray-300 rounded-md p-2 w-full" value="{{ $item->name }}"
                                required>
                            <x-validation-errors field="name" />
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-base font-bold mb-2">商品の説明</label>
                            <textarea name="description" id="description" rows="5" class="border-2 border-gray-300 rounded-md p-2 w-full"
                                required>{{ $item->description }}</textarea>
                        </div>
                        <x-validation-errors field="description" />

                        <h3 class="text-xl font-bold border-b border-neutral-700 text-neutral-500 my-4">販売価格</h3>
                        <div class="mb-4">
                            <label for="price" class="block text-base font-bold mb-2">販売価格</label>
                            <div class="flex items-center border-2 border-gray-300 rounded-md">
                                <input type="number" name="price" id="price" class="flex-1 p-2 rounded-r-md"
                                    placeholder="￥" value="{{ number_format($item->price) }}" required>
                            </div>
                            <x-validation-errors field="price" />
                        </div>

                        <div class="mb-4">
                            <x-primary-button class="w-full">編集する</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImages(event) {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';
            const files = event.target.files;

            if (files) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();

                    reader.onload = () => {
                        const imageElement = document.createElement('img');
                        imageElement.src = reader.result;
                        imageElement.classList.add('w-32', 'h-32', 'object-cover', 'rounded-md');
                        previewContainer.appendChild(imageElement);
                    }

                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
</x-app-layout>
