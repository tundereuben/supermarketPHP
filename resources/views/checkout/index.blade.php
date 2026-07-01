<x-layouts.app title="Checkout - Supermarket@Home">
    <main class="container mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <form action="{{ route('placeholder.action') }}" method="POST" class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
            @csrf
            <h1 class="text-2xl font-black text-gray-900">Secure Checkout</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input readonly value="{{ auth()->user()->name }}" class="w-full p-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
                <input readonly value="{{ auth()->user()->email }}" class="w-full p-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500">
            </div>
            <input name="phone" value="{{ auth()->user()->phone }}" placeholder="+234..." class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
            <textarea name="address" rows="4" placeholder="Delivery address" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">{{ auth()->user()->address }}</textarea>
            <select name="payment" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
                <option>Cash on Delivery</option>
                <option>Bank Transfer</option>
            </select>
            <button class="bg-primary hover:bg-secondary text-white font-bold px-6 py-4 rounded-xl">Place Order ({{ \App\Support\PrototypeData::money($total) }})</button>
        </form>
        <aside class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-fit">
            <h2 class="font-black text-gray-900 mb-5">Your Items</h2>
            <div class="space-y-4">
                @foreach($items as $item)
                    <div class="flex justify-between text-sm"><span>{{ $item['name'] }}</span><span class="font-bold">{{ \App\Support\PrototypeData::money($item['price']) }}</span></div>
                @endforeach
            </div>
            <div class="border-t mt-5 pt-5 flex justify-between font-black text-primary"><span>Total</span><span>{{ \App\Support\PrototypeData::money($total) }}</span></div>
        </aside>
    </main>
</x-layouts.app>
