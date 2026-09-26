<x-layouts.app title="Shopping Cart - Supermarket@Home">
    <main class="container mx-auto px-4 py-10">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black text-gray-900">Shopping Cart</h1>
            </div>
            <a href="{{ route('products.index') }}" class="text-primary font-bold text-sm hover:underline">Continue Shopping</a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <section class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                @forelse($items as $item)
                    <div class="p-5 flex gap-4 border-b border-gray-100 last:border-b-0">
                        <img src="{{ $item['product']->image_url }}" alt="{{ $item['product']->name }}" class="h-24 w-24 rounded-xl object-cover">
                        <div class="flex-1">
                            <h2 class="font-black text-gray-900">{{ $item['product']->name }}</h2>
                            <p class="text-xs text-gray-400 mt-1">{{ $item['product']->unit }}</p>
                            <div class="flex items-center justify-between mt-4">
                                <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" data-cart-quantity-form class="flex items-center gap-2">
                                    @csrf
                                    <label for="quantity-{{ $item['product']->id }}" class="sr-only">Quantity for {{ $item['product']->name }}</label>
                                    <button type="button" data-quantity-step="-1" aria-label="Decrease {{ $item['product']->name }} quantity" class="h-9 w-9 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 disabled:opacity-40" title="Decrease quantity">
                                        <i class="fas fa-minus text-xs" aria-hidden="true"></i>
                                    </button>
                                    <input id="quantity-{{ $item['product']->id }}" type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" required data-cart-quantity
                                           class="w-14 h-9 border border-gray-200 rounded-lg text-center text-sm">
                                    <button type="button" data-quantity-step="1" aria-label="Increase {{ $item['product']->name }} quantity" class="h-9 w-9 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50" title="Increase quantity">
                                        <i class="fas fa-plus text-xs" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <span class="font-bold">{{ \App\Support\PrototypeData::money($item['total']) }}</span>
                                <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" aria-label="Remove {{ $item['product']->name }} from cart" title="Remove from cart" class="p-2 text-red-500 hover:text-red-700 transition">
                                        <i class="fas fa-trash-can" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <p class="text-gray-500 font-bold">Your cart is empty.</p>
                        <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-primary hover:bg-secondary text-white font-bold py-3 px-6 rounded-2xl">Start Shopping</a>
                    </div>
                @endforelse
            </section>
            <aside class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-fit">
                <h2 class="font-black text-gray-900 text-lg mb-5">Order Summary</h2>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between"><span class="text-gray-500">Subtotal</span><span class="font-bold">{{ \App\Support\PrototypeData::money($subtotal) }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Shipping</span><span class="font-bold">{{ \App\Support\PrototypeData::money($shipping) }}</span></div>
                    <div class="border-t pt-4 flex justify-between text-lg"><span class="font-black">Total</span><span class="font-black text-primary">{{ \App\Support\PrototypeData::money($total) }}</span></div>
                </div>
                @if(count($items) > 0)
                    <a href="{{ route('checkout.index') }}" class="block bg-primary hover:bg-secondary text-white text-center font-bold py-4 rounded-2xl mt-6">Proceed to Checkout</a>
                @else
                    <span class="block bg-gray-200 text-gray-400 text-center font-bold py-4 rounded-2xl mt-6 cursor-not-allowed">Proceed to Checkout</span>
                @endif
            </aside>
        </div>
    </main>
</x-layouts.app>
