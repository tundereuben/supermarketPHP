<x-layouts.app title="Customer Dashboard - Supermarket@Home">
    <main class="container mx-auto px-4 py-10 flex flex-col lg:flex-row gap-8">
        <x-customer.sidebar />
        <section class="flex-1 space-y-8">
            <div class="bg-primary text-white rounded-3xl p-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-black">Hello, {{ auth()->user()->name }}</h1>
                    <p class="text-emerald-100 text-sm mt-1">Manage grocery orders, subscriptions, tracking, and profile details.</p>
                </div>
                <a href="{{ route('products.index') }}" class="bg-white text-primary hover:bg-gray-50 px-6 py-3 rounded-xl font-bold text-sm text-center">Quick Shop</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm"><div class="text-xs font-bold text-gray-400 uppercase">Total Spend</div><div class="text-2xl font-black mt-2">₦45,800</div></div>
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm"><div class="text-xs font-bold text-gray-400 uppercase">Orders</div><div class="text-2xl font-black mt-2">{{ count($orders) }}</div></div>
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm"><div class="text-xs font-bold text-gray-400 uppercase">Active Basket</div><div class="text-2xl font-black mt-2">{{ $subscription['name'] }}</div></div>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-black text-gray-900">Recent Orders</h2>
                    <a href="{{ route('orders.index') }}" class="text-primary font-bold text-sm">View all</a>
                </div>
                @foreach($orders as $order)
                    <div class="flex items-center justify-between py-4 border-t first:border-t-0">
                        <div><div class="font-bold">{{ $order['number'] }}</div><div class="text-xs text-gray-400">{{ $order['date'] }} / {{ $order['items'] }} items</div></div>
                        <div class="font-black">{{ \App\Support\PrototypeData::money($order['total']) }}</div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
</x-layouts.app>
