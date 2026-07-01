<x-layouts.app title="Products Marketplace - Supermarket@Home">
    <div class="bg-gray-100 py-3 border-b border-gray-200">
        <div class="container mx-auto px-4 text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
            <i class="fas fa-chevron-right text-xs mx-2 text-gray-400"></i>
            <span class="text-gray-900 font-medium">All Products</span>
        </div>
    </div>

    <main class="container mx-auto px-4 py-8 flex flex-col lg:flex-row gap-8">
        <aside class="w-full lg:w-1/4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-fit space-y-8">
            <div>
                <h3 class="font-bold text-lg text-gray-900 mb-4 border-b pb-2">Categories</h3>
                <div class="space-y-3">
                    <a href="{{ route('products.index') }}" class="block text-sm font-semibold {{ !request('category') ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">All Categories</a>
                    @foreach($categories as $category)
                        <a href="{{ route('products.index', array_merge(request()->query(), ['category' => $category['slug']])) }}" class="block text-sm font-semibold {{ request('category') === $category['slug'] ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">{{ $category['name'] }}</a>
                    @endforeach
                </div>
            </div>
            <div>
                <h3 class="font-bold text-lg text-gray-900 mb-4 border-b pb-2">Price Range</h3>
                <input type="range" min="500" max="50000" value="25000" class="w-full accent-primary">
                <div class="flex items-center justify-between text-xs text-gray-500 mt-2"><span>₦500</span><span>₦50,000</span></div>
            </div>
        </aside>

        <section class="flex-1">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 gap-3">
                <div>
                    <h1 class="text-2xl md:text-3xl font-black text-gray-900">Products Marketplace</h1>
                    @if(request('search'))
                        <p class="text-xs text-gray-400 mt-1">Search results for "{{ request('search') }}"</p>
                    @else
                        <p class="text-xs text-gray-400 mt-1">{{ count($products) }} prototype products available.</p>
                    @endif
                </div>
                <span class="text-xs font-bold bg-white border border-gray-200 rounded-full px-4 py-2">Sort: Popular first</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="sm:col-span-2 xl:col-span-3 bg-white rounded-2xl border border-gray-100 p-10 text-center">
                        <h2 class="font-black text-gray-900">No products found</h2>
                        <a href="{{ route('products.index') }}" class="text-primary font-bold text-sm mt-3 inline-block">Clear filters</a>
                    </div>
                @endforelse
            </div>
        </section>
    </main>
</x-layouts.app>
