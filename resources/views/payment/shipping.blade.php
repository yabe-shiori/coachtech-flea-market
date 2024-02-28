<x-app-layout>
    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl text-center text-neutral-600 font-bold mb-6 sm:mb-8">住所の変更</h2>
            <form action="{{ route('user.profile.updateShippingAddress') }}" method="POST" class="max-w-xl mx-auto">
                @method('PATCH')
                @csrf

                <div class="mb-6 sm:mb-8">
                    <label for="postal_code" class="block text-base font-medium text-gray-700">郵便番号</label>
                    <input type="text" name="postal_code" id="postal_code"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        placeholder="123-4567" required
                        value="{{ old('postal_code', optional($user->profile)->postal_code) }}">
                    <x-validation-errors field="postal_code" />
                </div>

                <div class="mb-6 sm:mb-8">
                    <label for="address" class="block text-base font-medium text-gray-700">住所</label>
                    <textarea name="address" id="address" rows="3"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        placeholder="東京都渋谷区..." required>{{ old('address', optional($user->profile)->address) }}</textarea>
                    <x-validation-errors field="address" />
                </div>

                <div class="mb-8 sm:mb-10">
                    <label for="building_name" class="block text-base font-medium text-gray-700">建物名</label>
                    <input type="text" name="building_name" id="building_name"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        placeholder="マンション名、部屋番号など"
                        value="{{ old('building_name', optional($user->profile)->building_name) }}">
                    <x-validation-errors field="building_name" />
                </div>
                <x-primary-button class="w-full mt-8 py-2">更新する</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
