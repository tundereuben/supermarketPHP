<x-layouts.admin title="Customer Database - Admin">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-black text-gray-900">Customer Database</h1>
        <span class="text-xs font-bold bg-white border border-gray-200 rounded-full px-4 py-2">{{ $customers->total() }} registered users</span>
    </div>
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs text-gray-400 uppercase"><tr><th class="p-4">Customer</th><th class="p-4">Phone</th><th class="p-4">Orders</th><th class="p-4">Spend</th></tr></thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr class="border-t"><td class="p-4"><div class="font-bold">{{ $customer->name }}</div><div class="text-xs text-gray-400">{{ $customer->email }}</div></td><td class="p-4">{{ $customer->phone }}</td><td class="p-4">{{ $customer->orders->count() }}</td><td class="p-4 font-bold">{{ \App\Support\PrototypeData::money($customer->orders->sum('total')) }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($customers->hasPages())
        <div class="mt-6">
            {{ $customers->links() }}
        </div>
    @endif
</x-layouts.admin>
