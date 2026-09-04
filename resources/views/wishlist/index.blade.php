<x-layouts.app title="Wishlist - Supermarket@Home">
    <main class="container mx-auto px-4 py-10 flex flex-col lg:flex-row gap-8">
        <x-customer.sidebar />
        <section class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-black text-gray-900">Saved Wishlist Items</h1>
                <span class="text-sm text-gray-500">{{ $products->total() }} items</span>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-2xl p-4">
                    <p class="text-emerald-800 font-semibold">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('info'))
                <div class="mb-6 bg-blue-50 border border-blue-200 rounded-2xl p-4">
                    <p class="text-blue-800 font-semibold">{{ session('info') }}</p>
                </div>
            @endif

            @if ($wishlists->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($wishlists as $wishlist)
                        <div class="bg-white rounded-lg shadow-sm hover:shadow-lg transition overflow-hidden relative">
                            <!-- Image -->
                            <div class="relative overflow-hidden bg-gray-100 aspect-square">
                                <img src="{{ $wishlist->product->image_url }}" alt="{{ $wishlist->product->name }}" class="w-full h-full object-cover hover:scale-105 transition">
                                
                                <!-- Remove Button -->
                                <div class="absolute top-3 right-3">
                                    <form action="{{ route('wishlist.remove', $wishlist->id) }}" method="POST" class="inline" onsubmit="return confirm('Remove from wishlist?');">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition" title="Remove from wishlist">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="p-4">
                                <p class="text-xs text-gray-500 mb-1">{{ $wishlist->product->category->name }}</p>
                                <h3 class="font-semibold text-gray-900 line-clamp-2 mb-2 h-14">{{ $wishlist->product->name }}</h3>
                                
                                <!-- Price -->
                                <div class="flex items-baseline space-x-2 mb-3">
                                    <span class="text-lg font-bold text-primary">₦{{ number_format($wishlist->product->price) }}</span>
                                    <span class="text-xs text-gray-500">{{ $wishlist->product->unit }}</span>
                                </div>

                                <!-- Stock Status -->
                                <div class="mb-3">
                                    @if($wishlist->product->stock > 0)
                                        <span class="text-xs text-green-600 font-medium">{{ $wishlist->product->stock }} in stock</span>
                                    @else
                                        <span class="text-xs text-red-600 font-medium">Out of stock</span>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-2">
                                    <a href="{{ route('products.show', $wishlist->product->slug) }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-900 py-2 rounded-lg text-sm font-medium transition text-center">
                                        View
                                    </a>
                                    <form action="{{ route('cart.add', $wishlist->product->slug) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full bg-primary hover:bg-secondary text-white py-2 rounded-lg text-sm font-medium transition" {{ $wishlist->product->stock <= 0 ? 'disabled' : '' }}>
                                            <i class="fas fa-plus mr-1"></i> Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($wishlists->hasPages())
                    <div class="mt-8">
                        {{ $wishlists->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-16 bg-gray-50 rounded-2xl">
                    <i class="fas fa-heart text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No items saved yet</h3>
                    <p class="text-gray-500 mb-6">Add products to your wishlist to save them for later.</p>
                    <a href="{{ route('products.index') }}" class="inline-block bg-primary hover:bg-secondary text-white font-bold px-6 py-3 rounded-xl transition">
                        Browse Products
                    </a>
                </div>
            @endif
        </section>
    </main>
</x-layouts.app>
