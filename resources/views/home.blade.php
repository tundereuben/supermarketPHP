<x-layouts.app title="Supermarket@Home - Fresh Groceries Delivered">
    <section class="container mx-auto px-4 mt-6">
        <div class="relative bg-emerald-900 rounded-3xl overflow-hidden min-h-[420px] flex items-center">
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=1974" class="absolute inset-0 w-full h-full object-cover opacity-40" alt="">
            <div class="relative z-10 p-8 md:p-14 max-w-2xl text-white">
                <span class="bg-white/15 border border-white/20 px-4 py-2 rounded-full text-sm font-bold">Fresh Lagos groceries</span>
                <h1 class="text-4xl md:text-6xl font-black leading-tight mt-6">Market freshness delivered to your doorstep.</h1>
                <p class="text-emerald-50 mt-5 text-lg">Shop pantry staples, produce, household goods, and monthly food baskets from a polished Laravel UI shell.</p>
                <div class="flex flex-col sm:flex-row gap-3 mt-8">
                    <a href="{{ route('products.index') }}" class="bg-primary hover:bg-secondary text-white font-bold px-7 py-4 rounded-xl text-center">Start Shopping</a>
                    <a href="{{ route('subscriptions.index') }}" class="bg-white text-gray-900 hover:bg-gray-100 font-bold px-7 py-4 rounded-xl text-center">View Food Baskets</a>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 py-12">
        <div class="flex items-end justify-between mb-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-black text-gray-900">Shop by Category</h2>
                <p class="text-sm text-gray-500 mt-1">Static prototype categories routed through Laravel.</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-primary font-bold text-sm hover:underline">View all</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category['slug']]) }}" class="bg-white border border-gray-100 rounded-2xl p-5 text-center shadow-sm hover:shadow-md hover:text-primary transition">
                    <i class="fas {{ $category['icon'] }} text-2xl text-primary mb-3"></i>
                    <div class="font-bold text-sm">{{ $category['name'] }}</div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="container mx-auto px-4 pb-12">
        <div class="flex items-end justify-between mb-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-black text-gray-900">Featured Products</h2>
                <p class="text-sm text-gray-500 mt-1">Adapted from the prototype product cards.</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-primary font-bold text-sm hover:underline">Browse catalog</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

    <section class="bg-white py-14">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach(['Same-day Lagos delivery' => 'Rapid delivery windows for fresh groceries.', 'Curated food baskets' => 'Monthly staples mapped from the prototype.', 'Account dashboards' => 'Customer and admin screens are Laravel routes.'] as $title => $copy)
                <div class="border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <i class="fas fa-check-circle text-primary text-2xl mb-4"></i>
                    <h3 class="font-black text-gray-900">{{ $title }}</h3>
                    <p class="text-sm text-gray-500 mt-2">{{ $copy }}</p>
                </div>
            @endforeach
        </div>
    </section>
</x-layouts.app>
