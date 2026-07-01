<x-layouts.app title="Orders - Supermarket@Home">
    <main class="container mx-auto px-4 py-10 flex flex-col lg:flex-row gap-8">
        <x-customer.sidebar />
        <section class="flex-1 bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
            <h1 class="text-2xl font-black text-gray-900 mb-6">Track Your Orders</h1>
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="border border-gray-100 rounded-2xl p-5 flex flex-col md:flex-row md:items-center justify-between gap-3">
                        <div><div class="font-black text-gray-900">{{ $order['number'] }}</div><div class="text-sm text-gray-400">{{ $order['date'] }} / {{ $order['items'] }} items</div></div>
                        <div class="flex items-center gap-4"><span class="font-black text-primary">{{ \App\Support\PrototypeData::money($order['total']) }}</span><span class="text-xs font-bold uppercase bg-gray-100 rounded-full px-3 py-1">{{ $order['status'] }}</span></div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
</x-layouts.app>
