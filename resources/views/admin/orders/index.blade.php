<x-layouts.admin title="Orders Management - Admin">
    <h1 class="text-2xl font-black text-gray-900">Orders Management</h1>
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-xs font-bold uppercase text-gray-500">
                <tr>
                    <th class="px-5 py-3">Order #</th>
                    <th class="px-5 py-3">Customer</th>
                    <th class="px-5 py-3">Items</th>
                    <th class="px-5 py-3">Total</th>
                    <th class="px-5 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="border-t border-gray-100">
                        <td class="px-5 py-4 font-black">{{ $order->order_number }}</td>
                        <td class="px-5 py-4">
                            <div class="font-bold text-gray-900">{{ $order->user->name ?? $order->guest_name ?? 'Guest' }}</div>
                            <div class="text-xs text-gray-400">{{ $order->user->email ?? $order->guest_email ?? '' }}</div>
                        </td>
                        <td class="px-5 py-4 text-gray-500">{{ $order->items->count() }} Items</td>
                        <td class="px-5 py-4 font-black">{{ \App\Support\PrototypeData::money($order->total) }}</td>
                        <td class="px-5 py-4">
                            <span @class([
                                'text-xs font-bold uppercase rounded-full px-3 py-1',
                                'bg-emerald-100 text-emerald-700' => $order->status === 'completed',
                                'bg-blue-100 text-blue-700' => $order->status === 'processing',
                                'bg-gray-100 text-gray-600' => $order->status === 'pending',
                                'bg-red-100 text-red-700' => $order->status === 'cancelled',
                            ])>{{ $order->status }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-500 font-bold">No orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($orders->hasPages())
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</x-layouts.admin>
