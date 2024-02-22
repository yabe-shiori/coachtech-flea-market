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
                    <div class="flex items-center mb-8">
                        <div class="w-1/2">
                            <h3 class="text-xl font-bold">支払い方法</h3>
                        </div>
                        <div class="w-1/2 text-right">
                            <div id="payment-method-section" style="display: none;">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="payment_method" value="konbini"
                                        onclick="selectPaymentMethod('konbini')">
                                    <span class="ml-2">コンビニ払い</span>
                                </label>
                                <label class="inline-flex items-center ml-6">
                                    <input type="radio" class="form-radio" name="payment_method" value="card"
                                        onclick="selectPaymentMethod('card')">
                                    <span class="ml-2">クレジット決済</span>
                                </label>
                            </div>
                            <a href="javascript:void(0);" id="change-payment-method-link" class="text-blue-500">変更する</a>
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
                    <div class="mb-8 border border-gray-800 rounded-md p-4">
                        <h2 class="text-xl font-bold mb-6 text-center">ご注文内容の確認</h2>
                        <div class="flex flex-col">
                            <div class="flex justify-between mb-10">
                                <p>商品合計</p>
                                <p>¥{{ number_format($item->price) }}</p>
                            </div>
                            <div class="flex justify-between mb-4">
                                <p>支払い金額</p>
                                <p>¥{{ number_format($item->price) }}</p>
                            </div>
                            <div class="flex justify-between">
                                <p>支払い方法</p>
                                <p id="selected-payment-method">
                                    {{ isset($selectedPaymentMethod) ? ($selectedPaymentMethod === 'konbini' ? 'コンビニ払い' : 'クレジット決済') : 'クレジット決済' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center items-center mt-4">
                        <form id="checkout-form" action="{{ route('user.checkout', $item->id) }}" method="POST"
                            class="w-full">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <x-primary-button type="submit" id="checkout-button" class="w-full">購入する</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('change-payment-method-link').addEventListener('click', function() {
            document.getElementById('payment-method-section').style.display = 'block';
            this.style.display = 'none';
        });

        function selectPaymentMethod(method) {
            document.getElementById('selected-payment-method').innerText = method === 'konbini' ? 'コンビニ払い' : 'クレジット決済';
            document.getElementById('payment-method-section').style.display = 'none';
            document.getElementById('change-payment-method-link').style.display = 'block';
        }

        var stripe = Stripe('{{ env('STRIPE_PUBLIC') }}');
        var checkoutButton = document.getElementById('checkout-button');

        checkoutButton.addEventListener('click', function(event) {
            event.preventDefault();

            var selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');

            var paymentMethod = selectedPaymentMethod ? selectedPaymentMethod.value : 'card';

            fetch('{{ route('user.checkout', ['itemId' => $item->id]) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        payment_method: paymentMethod
                    })
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
