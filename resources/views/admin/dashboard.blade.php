<x-layouts.admin title="Admin Dashboard - Supermarket@Home">
<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Overview</h2>
            <p class="text-sm text-gray-600 mt-1">Real-time store statistics and metrics</p>
        </div>
        <span class="bg-white border border-gray-200 font-medium px-4 py-2 rounded-lg text-sm text-gray-600 self-start">
            <i class="far fa-calendar mr-2 text-primary"></i>{{ date('M d, Y') }}
        </span>
    </div>

    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        @foreach($metrics as $metric)
            <x-admin.metric-card 
                :label="$metric['label']"
                :value="$metric['value']"
                :icon="$metric['icon']"
                :tone="$metric['tone']"
            />
        @endforeach
    </div>
</div>

<!-- Recent Orders -->
<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-4 md:p-6 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-900">Recent Orders</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-4 md:px-6 py-3 text-left font-semibold text-gray-700 whitespace-nowrap">Order #</th>
                    <th class="px-4 md:px-6 py-3 text-left font-semibold text-gray-700 whitespace-nowrap">Customer</th>
                    <th class="px-4 md:px-6 py-3 text-left font-semibold text-gray-700 whitespace-nowrap">Items</th>
                    <th class="px-4 md:px-6 py-3 text-left font-semibold text-gray-700 whitespace-nowrap">Total</th>
                    <th class="px-4 md:px-6 py-3 text-left font-semibold text-gray-700 whitespace-nowrap">Status</th>
                    <th class="px-4 md:px-6 py-3 text-left font-semibold text-gray-700 whitespace-nowrap">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-4 md:px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $order->order_number }}</td>
                        <td class="px-4 md:px-6 py-4 text-gray-600 whitespace-nowrap">{{ $order->user->name ?? $order->guest_name ?? 'Guest' }}</td>
                        <td class="px-4 md:px-6 py-4 text-gray-600">{{ $order->items->count() }}</td>
                        <td class="px-4 md:px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">₦{{ number_format($order->total) }}</td>
                        <td class="px-4 md:px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium whitespace-nowrap {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-4 md:px-6 py-4 text-gray-600 whitespace-nowrap">{{ $order->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 md:px-6 py-8 text-center text-gray-500">No orders yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-layouts.admin>


