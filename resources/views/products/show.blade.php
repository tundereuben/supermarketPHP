<x-layouts.app title="{{ $product['name'] }} - Supermarket@Home">
    <main class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div class="bg-white rounded-3xl border border-gray-100 p-4 shadow-sm">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full aspect-square object-cover rounded-2xl">
            </div>
            <section class="space-y-6">
                <div>
                    <span class="text-xs font-black uppercase text-primary">{{ $product['category'] }}</span>
                    <h1 class="text-4xl font-black text-gray-900 mt-2">{{ $product['name'] }}</h1>
                    <p class="text-gray-500 mt-3">Prototype detail page converted into a dynamic Blade route by slug.</p>
                </div>
                <div class="flex items-end gap-3">
                    <span class="text-4xl font-black text-gray-900">{{ \App\Support\PrototypeData::money($product['price']) }}</span>
                    @if($product['old_price'])
                        <span class="text-xl text-gray-400 line-through">{{ \App\Support\PrototypeData::money($product['old_price']) }}</span>
                    @endif
                    <span class="text-sm text-gray-400">/ {{ $product['unit'] }}</span>
                </div>
                <form action="{{ route('placeholder.action') }}" method="POST" class="flex gap-3">
                    @csrf
                    <input type="number" min="1" value="1" class="w-24 border border-gray-200 rounded-xl px-4 py-3">
                    <button class="bg-primary hover:bg-secondary text-white font-bold px-8 py-3 rounded-xl">Add to Cart</button>
                </form>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                    <div class="bg-white border border-gray-100 rounded-2xl p-4"><i class="fas fa-truck text-primary mb-2"></i><div class="font-bold">Fast Delivery</div></div>
                    <div class="bg-white border border-gray-100 rounded-2xl p-4"><i class="fas fa-shield-heart text-primary mb-2"></i><div class="font-bold">Fresh Guarantee</div></div>
                    <div class="bg-white border border-gray-100 rounded-2xl p-4"><i class="fas fa-rotate text-primary mb-2"></i><div class="font-bold">Easy Replacement</div></div>
                </div>
            </section>
        </div>

        <section class="mt-14">
            <h2 class="text-2xl font-black text-gray-900 mb-6">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $item)
                    <x-product-card :product="$item" />
                @endforeach
            </div>
        </section>
    </main>
</x-layouts.app>
