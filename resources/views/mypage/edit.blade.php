<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl text-center font-bold text-neutral-600">
                プロフィール設定
            </h2>
            <form method="post" action="{{ route('user.mypage.update') }}" class="mt-6 space-y-6 max-w-xl mx-auto"
                enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div>
                    <div class="mt-1 flex items-center">
                        <img id="avatar-preview"
                            src="{{ asset('storage/avatar/' . $user->avatar ?? 'user-default.jpg') }}"
                            class="w-20 h-20 rounded-full mr-4" alt="アバター画像">

                        <input id="avatar" name="avatar" type="file" class="hidden" accept="image/*"
                            onchange="previewImage(this)">
                        <label for="avatar"
                            class="cursor-pointer px-4 py-2 bg-white text-red-500 font-bold border-2 border-red-500 rounded-md hover:bg-gray-300">
                            画像を選択する
                        </label>
                        <x-validation-errors field="avatar" />
                    </div>
                </div>

                <div class="mb-4 mx-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">ユーザー名</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <x-validation-errors field="name" />
                </div>

                <div class="mb-4 mx-2">
                    <label for="display_name" class="block text-sm font-medium text-gray-700">ニックネーム (表示名)</label>
                    <input type="text" id="display_name" name="display_name"
                        value="{{ old('display_name', optional($user->profile)->display_name) }}"
                        placeholder="coachtechフリマ内のユーザー名"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <x-validation-errors field="display_name" />
                </div>

                <div class="mb-4 mx-2">
                    <label for="introduction" class="block text-sm font-medium text-gray-700">自己紹介</label>
                    <textarea id="introduction" name="introduction" rows="5" placeholder="例) ご覧いただきありがとうございます。どうぞよろしくお願いします！"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('introduction', optional($user->profile)->introduction) }}</textarea>
                    <x-validation-errors field="introduction" />
                </div>

                <div class="mb-4 mx-2">
                    <label for="postal_code" class="block text-sm font-medium text-gray-700">郵便番号</label>
                    <input type="text" id="postal_code" name="postal_code"
                        value="{{ old('postal_code', optional($user->profile)->postal_code) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <x-validation-errors field="postal_code" />
                </div>

                <div class="mb-4 mx-2">
                    <label for="address" class="block text-sm font-medium text-gray-700">住所</label>
                    <input type="text" id="address" name="address"
                        value="{{ old('address', optional($user->profile)->address) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <x-validation-errors field="address" />
                </div>

                <div class="mb-4 mx-2">
                    <label for="building_name" class="block text-sm font-medium text-gray-700">建物名</label>
                    <input type="text" id="building_name" name="building_name"
                        value="{{ old('building_name', optional($user->profile)->building_name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <x-validation-errors field="building_name" />
                </div>

                <div class="flex items-center justify-center gap-4">
                    <x-primary-button
                        class="w-full font-bold flex items-center justify-center mt-8 mx-2">{{ __('更新する') }}</x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const postalCodeInput = document.getElementById('postal_code');

            postalCodeInput.addEventListener('input', function() {
                const formattedPostalCode = toHalfWidth(this.value).replace(/[^\d-]/g, '');
                const postalCodeWithoutHyphen = formattedPostalCode.replace(/-/g, '');
                const formattedWithHyphen = postalCodeWithoutHyphen.replace(/(\d{3})(\d{4})/, '$1-$2');
                this.value = formattedWithHyphen;
            });

            postalCodeInput.value = toHalfWidth(postalCodeInput.value);
        });

        function toHalfWidth(str) {
            return str.replace(/[！-～]/g, function(tmpStr) {
                return String.fromCharCode(tmpStr.charCodeAt(0) - 0xFEE0);
            });
        }
    </script>
</x-app-layout>
