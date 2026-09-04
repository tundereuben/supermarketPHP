<x-layouts.admin title="Inventory Management - Admin">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-black text-gray-900">Inventory Catalog</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-primary hover:bg-secondary text-white font-bold px-6 py-3 rounded-xl transition">
            + Add Product
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-2xl p-4">
            <p class="text-emerald-800 font-semibold">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs text-gray-400 uppercase">
                <tr>
                    <th class="p-4">Product</th>
                    <th class="p-4">Category</th>
                    <th class="p-4">Price</th>
                    <th class="p-4">Stock</th>
                    <th class="p-4">Featured</th>
                    <th class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-4 font-bold">{{ $product->name }}</td>
                        <td class="p-4 text-gray-600">{{ $product->category?->name ?? 'N/A' }}</td>
                        <td class="p-4 font-bold text-primary">₦{{ number_format($product->price, 0, '.', ',') }}</td>
                        <td class="p-4">
                            <span @class([
                                'text-xs font-bold px-3 py-1 rounded-full',
                                'bg-emerald-100 text-emerald-800' => $product->stock > 20,
                                'bg-yellow-100 text-yellow-800' => $product->stock >= 10 && $product->stock <= 20,
                                'bg-red-100 text-red-800' => $product->stock < 10,
                            ])>
                                {{ $product->stock }} units
                            </span>
                        </td>
                        <td class="p-4">
                            @if ($product->is_featured)
                                <span class="text-xs font-bold bg-purple-100 text-purple-800 px-3 py-1 rounded-full">Featured</span>
                            @else
                                <span class="text-xs text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="p-4 space-x-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-primary hover:text-secondary font-semibold text-sm">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-500">
                            No products found. <a href="{{ route('admin.products.create') }}" class="text-primary hover:text-secondary font-semibold">Create one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if ($products->hasPages())
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @endif
</x-layouts.admin>
