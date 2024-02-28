<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-100">
                    <h3 class="text-2xl text-neutral-600 font-bold mb-6">お知らせメール内容確認</h3>
                    <div class="mb-8">
                        <label for="subject" class="block text-base font-medium text-gray-700">件名</label>
                        <p class="block text-base text-gray-700">{{ $subject }}</p>
                    </div>
                    <div class="mb-10">
                        <label for="content" class="block text-base font-medium text-gray-700">メッセージ</label>
                        <p class="block text-base text-gray-700">{{ $content }}</p>
                    </div>
                    <form action="{{ route('admin.sendNotification') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subject" value="{{ $subject }}">
                        <input type="hidden" name="content" value="{{ $content }}">
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            送信する
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
