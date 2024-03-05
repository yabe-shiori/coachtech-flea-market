<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl text-center text-gray-500 font-bold mb-6">評価画面</h2>
                    <p class="text-lg text-center text-gray-800">出品者に対する評価を投稿してください。</p>
                    <form action="{{ route('user.rating.store') }}" method="POST"
                        class="space-y-4 md:w-2/3 lg:w-1/2 mx-auto">
                        @csrf
                        <input type="hidden" name="to_user_id" value="{{ $to_user_id }}">
                        <input type="hidden" name="item_id" value="{{ $item_id }}">

                        <div>
                            <label for="rating" class="block text-lg font-medium text-gray-700">評価:</label>
                            <select name="rating" id="rating"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-base focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5" selected>5</option>
                            </select>
                            <x-validation-errors field="rating" />
                        </div>

                        <div>
                            <label for="comment" class="block text-lg font-medium text-gray-700">コメント:</label>
                            <textarea name="comment" id="comment" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-base focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-10"></textarea>
                            <x-validation-errors field="comment" />
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-500 hover:bg-blue-700 text-white text-base font-bold py-2 px-4 rounded-md">評価する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
