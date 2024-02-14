<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl text-center font-bold text-gray-900">
                プロフィール設定
            </h2>

            <form method="post" action="{{ route('user.mypage.update') }}" class="mt-6 space-y-6 max-w-lg mx-auto"
                enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div>
                    <div class="mt-1 flex items-center">
                        <img id="avatar-preview" src="{{ asset('storage/avatar/' . $user->avatar) }}"
                            class="w-20 h-20 rounded-full mr-4" alt="保存された画像">

                        <input id="avatar" name="avatar" type="file" class="hidden" accept="image/*"
                            onchange="previewImage(this)">
                        <label for="avatar"
                            class="cursor-pointer px-4 py-2 bg-white text-red-500 font-bold border-2 border-red-500 rounded-md hover:bg-gray-300">
                            画像を選択する
                        </label>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                </div>

                <div>
                    <x-input-label for="name" :value="__('ユーザー名')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="postal_code" :value="__('郵便番号')" />
                    <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full"
                        :value="old('postal_code', $user->postal_code)" required autofocus autocomplete="postal_code" />
                    <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
                </div>

                <div>
                    <x-input-label for="address" :value="__('住所')" />
                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                        :value="old('address', $user->address)" required autofocus autocomplete="address" />
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                </div>

                <div>
                    <x-input-label for="building_name" :value="__('建物名')" />
                    <x-text-input id="building_name" name="building_name" type="text" class="mt-1 block w-full"
                        :value="old('building_name', $user->building_name)" required autofocus autocomplete="building_name" />
                    <x-input-error class="mt-2" :messages="$errors->get('building_name')" />
                </div>

                <div class="flex items-center justify-center gap-4">
                    <x-primary-button
                        class="w-full font-bold flex items-center justify-center mt-8">{{ __('更新する') }}</x-primary-button>

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
    </script>
</x-app-layout>
