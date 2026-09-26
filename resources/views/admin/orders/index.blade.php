<x-layouts.admin title="Orders Management - Admin">
    <h1 class="text-2xl font-black text-gray-900">Orders Management</h1>
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-xs font-bold uppercase text-gray-500">
                <tr>
                    <th class="px-5 py-3 whitespace-nowrap">Order #</th>
                    <th class="px-5 py-3 whitespace-nowrap">Customer</th>
                    <th class="px-5 py-3 whitespace-nowrap">Items</th>
                    <th class="px-5 py-3 whitespace-nowrap">Total</th>
                    <th class="px-5 py-3 whitespace-nowrap">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="border-t border-gray-100">
                        <td class="px-5 py-4 font-black whitespace-nowrap">{{ $order->order_number }}</td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="font-bold text-gray-900">{{ $order->user->name ?? $order->guest_name ?? 'Guest' }}</div>
                            <div class="text-xs text-gray-400">{{ $order->user->email ?? $order->guest_email ?? '' }}</div>
                        </td>
                        <td class="px-5 py-4 text-gray-500 whitespace-nowrap">{{ $order->items->count() }} Items</td>
                        <td class="px-5 py-4 font-black whitespace-nowrap">{{ \App\Support\PrototypeData::money($order->total) }}</td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" onchange="this.submit()">
                                @csrf
                                @method('PATCH')
                                <label for="status-{{ $order->id }}" class="sr-only">Order status</label>
                                <select id="status-{{ $order->id }}" name="status" @class([
                                    'text-xs font-bold uppercase rounded-full px-3 py-1 border-0 focus:outline-none focus:ring-2 focus:ring-primary',
                                    'bg-emerald-100 text-emerald-700' => $order->status === 'completed',
                                    'bg-blue-100 text-blue-700' => $order->status === 'processing',
                                    'bg-gray-100 text-gray-600' => $order->status === 'pending',
                                    'bg-red-100 text-red-700' => $order->status === 'cancelled',
                                ])>
                                    @foreach(['pending', 'processing', 'completed', 'cancelled'] as $status)
                                        <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </form>
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
