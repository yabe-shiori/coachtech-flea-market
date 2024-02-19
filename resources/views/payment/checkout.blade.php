<x-app-layout>
    <x-message :message="session('message')" />
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="grid grid-cols-2 gap-4">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex items-center mb-8">
                        <div class="w-1/4 max-w-xs mr-4">
                            <img src="{{ asset('storage/' . $item->images->first()->image_path) }}"
                                alt="{{ $item->name }}" class="max-w-full">
                        </div>
                        <div class="w-3/4">
                            <h2 class="text-2xl font-bold">{{ $item->name }}</h2>
                            <p class="mt-2 text-2xl text-gray-600">¥{{ number_format($item->price) }}</p>
                        </div>
                    </div>
                    <!-- 支払い方法 -->
                    <div class="flex items-center mb-8">
                        <div class="w-1/2">
                            <h3 class="text-xl font-bold">支払い方法</h3>
                        </div>
                        <div class="w-1/2 text-right">
                            <a href="#" class="text-blue-500">変更する</a>
                        </div>
                    </div>
                    <!-- 配送先 -->
                    <div class="flex items-center mb-8">
                        <div class="w-1/2">
                            <h3 class="text-xl font-bold">配送先</h3>
                        </div>
                        <div class="w-1/2 text-right">
                            <a href="{{ route('user.profile.showShippingAddressForm', ['item' => $item->id]) }}"
                                class="text-blue-500">変更する</a>
                        </div>
                    </div>
                </div>
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mb-8">
                        <h2 class="text-xl font-bold mb-4 text-center">ご注文内容の確認</h2>
                        <div class="flex flex-col">
                            <div class="flex justify-between mb-2">
                                <p>商品合計</p>
                                <p>¥{{ number_format($item->price) }}</p>
                            </div>
                            <div class="flex justify-between">
                                <p>支払い方法</p>
                                <p>コンビニ払い</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center mt-auto">
                        <form id="checkout-form" action="{{ route('user.checkout', $item->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <x-primary-button type="submit" id="checkout-button">購入する</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var stripe = Stripe('{{ env('STRIPE_PUBLIC') }}');
        var checkoutButton = document.getElementById('checkout-button');

        checkoutButton.addEventListener('click', function() {
            fetch('{{ route('user.checkout', ['itemId' => $item->id]) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(session) {
                    return stripe.redirectToCheckout({
                        sessionId: session.id
                    });
                })
                .then(function(result) {
                    if (result.error) {
                        console.error(result.error.message);
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        });
    </script>
</x-app-layout>
