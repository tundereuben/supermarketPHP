<x-layouts.app title="{{ $product->name }} - Supermarket@Home">
    <main class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Product Image -->
            <div class="bg-white rounded-3xl border border-gray-100 p-4 shadow-sm relative">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full aspect-square object-cover rounded-2xl">
                
                <!-- Wishlist Button -->
                @auth
                    <div class="absolute top-8 right-8">
                        @php
                            $isWishlisted = \App\Models\Wishlist::where('user_id', auth()->id())
                                ->where('product_id', $product->id)
                                ->exists();
                        @endphp
                        @if($isWishlisted)
                            <form action="{{ route('wishlist.remove', \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->first()->id) }}" method="POST" class="inline">
                                @csrf
                                @method('POST')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-3 rounded-full transition shadow-lg" title="Remove from wishlist">
                                    <i class="fas fa-heart text-xl"></i>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-white hover:bg-gray-100 text-gray-400 hover:text-red-500 p-3 rounded-full transition shadow-lg border-2 border-white" title="Add to wishlist">
                                    <i class="fas fa-heart text-xl"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                @endauth

                @if($product->is_featured)
                    <div class="absolute top-4 left-4 bg-accent text-white px-4 py-2 rounded-full font-bold">
                        Featured
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <section class="space-y-6">
                <!-- Category & Title -->
                <div>
                    <span class="text-xs font-black uppercase text-primary">{{ $product->category->name }}</span>
                    <h1 class="text-4xl font-black text-gray-900 mt-2">{{ $product->name }}</h1>
                    <p class="text-gray-500 mt-3">{{ $product->description }}</p>
                </div>

                <!-- Price & Stock -->
                <div class="flex items-end gap-3">
                    <span class="text-4xl font-black text-gray-900">₦{{ number_format($product->price) }}</span>
                    <span class="text-sm text-gray-400">/ {{ $product->unit }}</span>
                </div>

                <!-- Stock Status -->
                <div class="p-4 rounded-xl" @class(['bg-green-50' => $product->stock > 0, 'bg-red-50' => $product->stock <= 0])>
                    @if ($product->stock > 0)
                        <p class="text-green-700 font-semibold"><i class="fas fa-check mr-2"></i>{{ $product->stock }} in stock</p>
                    @else
                        <p class="text-red-700 font-semibold"><i class="fas fa-times mr-2"></i>Out of stock</p>
                    @endif
                </div>

                <!-- Add to Cart -->
                <form action="{{ route('cart.add', $product->slug) }}" method="POST" class="flex gap-3">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="flex-1 bg-primary hover:bg-secondary text-white font-bold px-8 py-4 rounded-xl transition disabled:opacity-50 disabled:cursor-not-allowed" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        <i class="fas fa-plus mr-2"></i>Add to Cart
                    </button>
                </form>

                <!-- Features -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                    <div class="bg-white border border-gray-100 rounded-2xl p-4">
                        <i class="fas fa-truck text-primary text-lg mb-2 block"></i>
                        <div class="font-bold">Fast Delivery</div>
                        <p class="text-gray-500 text-xs mt-1">Within 24 hours</p>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-2xl p-4">
                        <i class="fas fa-shield-heart text-primary text-lg mb-2 block"></i>
                        <div class="font-bold">Fresh Guarantee</div>
                        <p class="text-gray-500 text-xs mt-1">Quality assured</p>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-2xl p-4">
                        <i class="fas fa-rotate text-primary text-lg mb-2 block"></i>
                        <div class="font-bold">Easy Replacement</div>
                        <p class="text-gray-500 text-xs mt-1">7-day return</p>
                    </div>
                </div>
            </section>
        </div>

        <!-- Related Products -->
        @if ($relatedProducts->count() > 0)
            <section class="mt-14">
                <h2 class="text-2xl font-black text-gray-900 mb-6">Related Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $item)
                        <x-product-card :product="$item" />
                    @endforeach
                </div>
            </section>
        @endif
    </main>
</x-layouts.app>
