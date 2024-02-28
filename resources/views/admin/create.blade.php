<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-2xl font-bold text-neutral-600 text-center">管理者作成</h2>
                <form method="POST" action="{{ route('admin.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">名前</label>
                        <input id="name"
                            class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2"
                            type="text" name="name" value="{{ old('name') }}" required autofocus />
                        <x-validation-errors field="name" />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
                        <input id="email"
                            class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2"
                            type="email" name="email" value="{{ old('email') }}" required />
                        <x-validation-errors field="email" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">パスワード</label>
                        <input id="password"
                            class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2"
                            type="password" name="password" required autocomplete="new-password" />
                        <x-validation-errors field="password" />
                    </div>

                    <div>
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-gray-700">確認用パスワード</label>
                        <input id="password_confirmation"
                            class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2"
                            type="password" name="password_confirmation" required />
                    </div>

                    <div class="flex justify-center sm:justify-end">
                        <button type="submit"
                            class="inline-flex justify-center w-full py-2 mt-6 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            作成する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
