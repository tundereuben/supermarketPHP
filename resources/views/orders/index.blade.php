<x-layouts.app title="Orders - Supermarket@Home">
    <main class="container mx-auto px-4 py-10 flex flex-col lg:flex-row gap-8">
        <x-customer.sidebar />
        <section class="flex-1 bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-black text-gray-900">Track Your Orders</h1>
                <span class="text-sm text-gray-500">{{ $orders->total() }} orders</span>
            </div>

            @if ($orders->count() > 0)
                <div class="space-y-4">
                    @foreach($orders as $order)
                        <div class="border border-gray-100 rounded-2xl p-5 flex flex-col md:flex-row md:items-center justify-between gap-3 hover:shadow-sm transition">
                            <div>
                                <div class="font-black text-gray-900">{{ $order->order_number }}</div>
                                <div class="text-sm text-gray-400">{{ $order->created_at->format('F j, Y') }} / {{ $order->items->count() }} items</div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="font-black text-primary">{{ \App\Support\PrototypeData::money($order->total) }}</span>
                                <span @class([
                                    'text-xs font-bold uppercase rounded-full px-3 py-1',
                                    'bg-emerald-100 text-emerald-700' => $order->status === 'completed',
                                    'bg-blue-100 text-blue-700' => $order->status === 'processing',
                                    'bg-gray-100 text-gray-600' => $order->status === 'pending',
                                    'bg-red-100 text-red-700' => $order->status === 'cancelled',
                                ])>{{ $order->status }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($orders->hasPages())
                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                @endif
            @else
                <div class="p-12 text-center">
                    <p class="text-gray-500 font-bold">You haven't placed any orders yet.</p>
                    <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-primary hover:bg-secondary text-white font-bold py-3 px-6 rounded-2xl">Start Shopping</a>
                </div>
            @endif
        </section>
    </main>
</x-layouts.app>
