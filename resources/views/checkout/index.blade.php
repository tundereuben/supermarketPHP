<x-layouts.app title="Checkout - Supermarket@Home">
    <main class="container mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-3 gap-8">
        @if ($errors->any())
            <div class="lg:col-span-2 bg-red-50 border border-red-200 rounded-2xl p-4">
                <h3 class="font-bold text-red-900 mb-2">Please fix the following errors:</h3>
                <ul class="space-y-1 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST" class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
            @csrf
            <h1 class="text-2xl font-black text-gray-900">Secure Checkout</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-semibold text-gray-700">Name</label>
                    <input readonly value="{{ auth()->user()->name }}" class="w-full p-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500 mt-1">
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700">Email</label>
                    <input readonly value="{{ auth()->user()->email }}" class="w-full p-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500 mt-1">
                </div>
            </div>

            <div @class(['', 'border-2 border-red-300 rounded-xl' => $errors->has('phone')])>
                <label class="text-sm font-semibold text-gray-700">Phone Number</label>
                <input name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="+234..." class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary mt-1" required>
                @error('phone')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div @class(['', 'border-2 border-red-300 rounded-xl' => $errors->has('address')])>
                <label class="text-sm font-semibold text-gray-700">Delivery Address</label>
                <textarea name="address" rows="4" placeholder="Enter your delivery address" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary mt-1" required>{{ old('address', auth()->user()->address) }}</textarea>
                @error('address')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div @class(['', 'border-2 border-red-300 rounded-xl' => $errors->has('payment_method')])>
                <label class="text-sm font-semibold text-gray-700">Payment Method</label>
                <select name="payment_method" id="paymentMethod" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary mt-1" required onchange="toggleCardFields()">
                    <option value="">Select payment method</option>
                    <option value="cash" @selected(old('payment_method') === 'cash')>Cash on Delivery</option>
                    <option value="card" @selected(old('payment_method') === 'card')>Debit/Credit Card</option>
                </select>
                @error('payment_method')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Card Payment Fields (Hidden by default) -->
            <div id="cardFields" class="space-y-4 hidden">
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <p class="text-sm text-blue-800"><i class="fas fa-info-circle mr-2"></i>Test cards: 4111111111111111 (Visa), 5555555555554444 (Mastercard)</p>
                </div>

                <div @class(['', 'border-2 border-red-300 rounded-xl' => $errors->has('card_number')])>
                    <label class="text-sm font-semibold text-gray-700">Card Number</label>
                    <input 
                        type="text" 
                        name="card_number" 
                        id="cardNumber"
                        placeholder="1234 5678 9012 3456" 
                        maxlength="16"
                        class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary mt-1"
                        inputmode="numeric"
                    >
                    @error('card_number')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div @class(['', 'border-2 border-red-300 rounded-xl' => $errors->has('card_expiry')])>
                        <label class="text-sm font-semibold text-gray-700">Expiry Date</label>
                        <input 
                            type="text" 
                            name="card_expiry" 
                            id="cardExpiry"
                            placeholder="MM/YY" 
                            maxlength="5"
                            class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary mt-1"
                            inputmode="numeric"
                        >
                        @error('card_expiry')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div @class(['', 'border-2 border-red-300 rounded-xl' => $errors->has('card_cvv')])>
                        <label class="text-sm font-semibold text-gray-700">CVV</label>
                        <input 
                            type="text" 
                            name="card_cvv" 
                            id="cardCVV"
                            placeholder="123" 
                            maxlength="4"
                            class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary mt-1"
                            inputmode="numeric"
                        >
                        @error('card_cvv')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-secondary text-white font-bold px-6 py-4 rounded-xl transition">Place Order (₦{{ number_format($total, 0, '.', ',') }})</button>
        </form>

        <aside class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-fit">
            <h2 class="font-black text-gray-900 mb-5">Your Items</h2>
            <div class="space-y-4">
                @foreach($items as $item)
                    <div class="flex justify-between items-center text-sm">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $item['product']->name }}</p>
                            <p class="text-gray-500 text-xs">Qty: {{ $item['quantity'] }}</p>
                        </div>
                        <span class="font-bold text-primary">₦{{ number_format($item['price'], 0, '.', ',') }}</span>
                    </div>
                @endforeach
            </div>
            <div class="border-t mt-5 pt-5 flex justify-between font-black text-primary text-lg">
                <span>Total</span>
                <span>₦{{ number_format($total, 0, '.', ',') }}</span>
            </div>
        </aside>
    </main>

    <script>
        function toggleCardFields() {
            const method = document.getElementById('paymentMethod').value;
            const cardFields = document.getElementById('cardFields');
            
            if (method === 'card') {
                cardFields.classList.remove('hidden');
            } else {
                cardFields.classList.add('hidden');
            }
        }

        // Format card number input (add spaces)
        document.getElementById('cardNumber')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            let formatted = value.replace(/(\d{4})/g, '$1 ').trim();
            e.target.value = formatted;
        });

        // Format expiry input
        document.getElementById('cardExpiry')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });

        // CVV input (numbers only)
        document.getElementById('cardCVV')?.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });

        // Initialize card fields visibility on page load
        window.addEventListener('load', function() {
            toggleCardFields();
        });
    </script>
</x-layouts.app>
