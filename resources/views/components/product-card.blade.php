@props(['product'])

<div class="bg-white rounded-lg shadow-sm hover:shadow-lg transition overflow-hidden">
    <!-- Image -->
    <div class="relative overflow-hidden bg-gray-100 aspect-square">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover hover:scale-105 transition">
        @if($product->is_featured)
            <div class="absolute top-3 right-3 bg-accent text-white px-3 py-1 rounded-full text-xs font-bold">
                Featured
            </div>
        @endif
    </div>

    <!-- Details -->
    <div class="p-4">
        <p class="text-xs text-gray-500 mb-1">{{ $product->category->name }}</p>
        <h3 class="font-semibold text-gray-900 line-clamp-2 mb-2 h-14">{{ $product->name }}</h3>
        
        <!-- Price -->
        <div class="flex items-baseline space-x-2 mb-3">
            <span class="text-lg font-bold text-primary">₦{{ number_format($product->price) }}</span>
            <span class="text-xs text-gray-500">{{ $product->unit }}</span>
        </div>

        <!-- Stock Status -->
        <div class="mb-3">
            @if($product->stock > 0)
                <span class="text-xs text-green-600 font-medium">{{ $product->stock }} in stock</span>
            @else
                <span class="text-xs text-red-600 font-medium">Out of stock</span>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-2">
            <a href="{{ route('products.show', $product->slug) }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-900 py-2 rounded-lg text-sm font-medium transition text-center">
                View
            </a>
            <form action="{{ route('cart.add', $product->slug) }}" method="POST" class="flex-1">
                @csrf
                <button type="submit" class="w-full bg-primary hover:bg-secondary text-white py-2 rounded-lg text-sm font-medium transition" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                    <i class="fas fa-plus mr-1"></i> Cart
                </button>
            </form>
        </div>
    </div>
</div>
