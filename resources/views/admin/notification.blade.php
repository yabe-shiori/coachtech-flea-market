<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-100">
                    <h3 class="text-2xl text-neutral-600 font-bold mb-6">お知らせメール作成</h3>
                    <form action="{{ route('admin.confirmNotificationForm') }}" method="GET">
                        @csrf
                        <div class="mb-6">
                            <label for="subject" class="block text-base font-medium text-gray-700">件名</label>
                            <input type="text" name="subject" id="subject"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                            <x-validation-errors field="subject" />
                        </div>
                        <div class="mb-10">
                            <label for="content" class="block text-base font-medium text-gray-700">本文</label>
                            <textarea name="content" id="content" rows="5" class="form-textarea mt-1 block w-full rounded-md shadow-sm"
                                required></textarea>
                            <x-validation-errors field="content" />
                        </div>
                        <div>
                            <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent w-full text-white rounded-md font-semibold text-base uppercase tracking-wide hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 disabled:opacity-25 transition">確認する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
