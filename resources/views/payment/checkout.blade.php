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
                            @if (auth()->user()->points)
                                <p>保有ポイント: {{ auth()->user()->points->balance }}</p>
                                <label for="points_to_use">利用ポイント数:</label>
                                <input type="number" id="points_to_use" name="points_to_use" min="0"
                                    max="{{ auth()->user()->points->balance }}">
                            @else
                                <input type="hidden" id="points_to_use" name="points_to_use" value="0">
                            @endif
                            <div class="flex justify-between mb-4">
                                <p>支払い金額</p>
                                <p id="payment-amount">¥{{ number_format($item->price) }}</p>
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
                            <x-primary-button type="submit" id="checkout-button" data-item-id="{{ $item->id }}"
                                class="w-full">購入する</x-primary-button>
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

        var stripe = Stripe('{{ env('STRIPE_PUBLIC') }}');
        var checkoutButtons = document.querySelectorAll('#checkout-button');

        checkoutButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var itemId = this.getAttribute('data-item-id');

                var selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
                var paymentMethod = selectedPaymentMethod ? selectedPaymentMethod.value : 'card';

                var selectedPoints = document.getElementById('points_to_use').value;

                fetch('{{ route('user.checkout', '') }}/' + itemId, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            payment_method: paymentMethod,
                            points_to_use: selectedPoints
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
        });
        document.getElementById('points_to_use').addEventListener('input', function() {
            var pointsToUse = parseInt(this.value);
            var itemPrice = parseInt({{ $item->price }});
            var priceAfterPoints = Math.max(0, itemPrice - pointsToUse);

            document.getElementById('payment-amount').textContent = '¥' + priceAfterPoints.toLocaleString();
        });
    </script>
</x-app-layout>
