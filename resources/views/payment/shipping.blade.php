<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl text-center font-bold mb-8">住所の変更</h2>
            <form action="{{ route('user.profile.updateShippingAddress') }}" method="POST" class="max-w-lg mx-auto">
                @method('PATCH')
                @csrf
                <!-- 郵便番号 -->
                <div class="mb-6">
                    <label for="postal_code" class="block text-base font-medium text-gray-700">郵便番号</label>
                    <input type="text" name="postal_code" id="postal_code"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        placeholder="123-4567" required value="{{ old('postal_code', optional($user->profile)->postal_code) }}">
                    @error('postal_code')
                        <p class="mt-2 text-base text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- 住所 -->
                <div class="mb-6">
                    <label for="address" class="block text-base font-medium text-gray-700">住所</label>
                    <textarea name="address" id="address" rows="3"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        placeholder="東京都渋谷区..." required>{{ old('address', optional($user->profile)->address) }}</textarea>
                    @error('address')
                        <p class="mt-2 text-base text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- 建物名 -->
                <div class="mb-10">
                    <label for="building_name" class="block text-base font-medium text-gray-700">建物名（任意）</label>
                    <input type="text" name="building_name" id="building_name"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        placeholder="マンション名、部屋番号など" value="{{ old('building_name', optional($user->profile)->building_name) }}">
                    @error('building_name')
                        <p class="mt-2 text-base text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <x-primary-button class="w-full">更新する</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
