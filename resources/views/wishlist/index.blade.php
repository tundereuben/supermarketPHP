<x-layouts.app title="Wishlist - Supermarket@Home">
    <main class="container mx-auto px-4 py-10 flex flex-col lg:flex-row gap-8">
        <x-customer.sidebar />
        <section class="flex-1">
            <h1 class="text-2xl font-black text-gray-900 mb-6">Saved Wishlist Items</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    </main>
</x-layouts.app>
