<x-layouts.app title="Order Confirmation - Supermarket@Home">
    <main class="container mx-auto px-4 py-10">
        <!-- Success Message -->
        <div class="max-w-2xl mx-auto mb-8 bg-emerald-50 border-2 border-emerald-200 rounded-2xl p-8 text-center">
            <div class="text-5xl mb-4">✓</div>
            <h1 class="text-3xl font-black text-emerald-900 mb-2">Order Confirmed!</h1>
            <p class="text-emerald-700">Thank you for your order. We'll process it shortly.</p>
        </div>

        <!-- Order Details -->
        <div class="max-w-2xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Order Summary -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="text-xl font-black text-gray-900 mb-4">Order Details</h2>
                
                <div class="space-y-4 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Order Number:</span>
                        <span class="font-bold text-primary">{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Order Date:</span>
                        <span class="font-semibold">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold" @class([
                            'bg-yellow-100 text-yellow-800' => $order->status === 'pending',
                            'bg-blue-100 text-blue-800' => $order->status === 'processing',
                            'bg-purple-100 text-purple-800' => $order->status === 'shipped',
                            'bg-emerald-100 text-emerald-800' => $order->status === 'delivered',
                            'bg-red-100 text-red-800' => $order->status === 'cancelled',
                        ])>
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="border-t pt-4 flex justify-between font-bold text-lg text-primary">
                        <span>Total:</span>
                        <span>₦{{ number_format($order->total, 0, '.', ',') }}</span>
                    </div>
                </div>
            </div>

            <!-- Delivery Information -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="text-xl font-black text-gray-900 mb-4">Delivery Information</h2>
                
                <div class="space-y-4 text-sm">
                    <div>
                        <p class="text-gray-600 text-xs uppercase tracking-wide">Phone</p>
                        <p class="font-semibold text-gray-900">{{ $order->phone }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs uppercase tracking-wide">Delivery Address</p>
                        <p class="font-semibold text-gray-900">{{ $order->shipping_address }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs uppercase tracking-wide">Payment Method</p>
                        <p class="font-semibold text-gray-900">{{ $order->payment_method === 'cash' ? 'Cash on Delivery' : 'Bank Transfer' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs uppercase tracking-wide">Payment Status</p>
                        <p class="font-semibold text-gray-900">{{ ucfirst($order->payment_status) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="max-w-2xl mx-auto mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-xl font-black text-gray-900 mb-4">Order Items</h2>
            
            <div class="space-y-4">
                @foreach ($items as $item)
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100 last:border-b-0 last:pb-0">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $item->product_name }}</p>
                            <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                        </div>
                        <span class="font-bold text-primary">₦{{ number_format($item->price * $item->quantity, 0, '.', ',') }}</span>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 pt-6 border-t-2 border-gray-200 flex justify-between font-black text-lg text-primary">
                <span>Total Amount:</span>
                <span>₦{{ number_format($order->total, 0, '.', ',') }}</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="max-w-2xl mx-auto mt-8 grid grid-cols-2 gap-4">
            <a href="{{ route('orders.index') }}" class="block text-center bg-gray-200 hover:bg-gray-300 text-gray-900 font-bold px-6 py-3 rounded-xl transition">
                View All Orders
            </a>
            <a href="{{ route('home') }}" class="block text-center bg-primary hover:bg-secondary text-white font-bold px-6 py-3 rounded-xl transition">
                Continue Shopping
            </a>
        </div>
    </main>
</x-layouts.app>
