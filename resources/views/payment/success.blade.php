<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-center">
                        <svg class="h-16 w-16 text-green-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <h2 class="text-xl font-semibold mb-4">支払い完了</h2>
                        <p class="text-gray-600 mb-8">支払いが正常に処理されました。</p>
                        <a href="{{ route('user.item.index') }}"
                            class="inline-block px-4 py-2 bg-gradient-to-r from-blue-400 to-blue-600 text-white rounded-lg shadow-md hover:from-blue-600 hover:to-blue-700 transition duration-300 ease-in-out">戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
