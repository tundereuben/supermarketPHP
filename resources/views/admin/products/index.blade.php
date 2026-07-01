<x-layouts.admin title="Inventory Management - Admin">
    <h1 class="text-2xl font-black text-gray-900">Inventory Catalog</h1>
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs text-gray-400 uppercase"><tr><th class="p-4">Product</th><th class="p-4">Category</th><th class="p-4">Price</th><th class="p-4">Status</th></tr></thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="border-t"><td class="p-4 font-bold">{{ $product['name'] }}</td><td class="p-4">{{ $product['category'] }}</td><td class="p-4 font-bold">{{ \App\Support\PrototypeData::money($product['price']) }}</td><td class="p-4"><span class="text-xs bg-emerald-50 text-primary font-bold rounded-full px-3 py-1">Active</span></td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.admin>
