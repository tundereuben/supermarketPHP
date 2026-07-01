<x-layouts.admin title="Orders Management - Admin">
    <h1 class="text-2xl font-black text-gray-900">Orders Management</h1>
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        @foreach($orders as $order)
            <div class="p-5 border-b last:border-b-0 flex items-center justify-between">
                <div><div class="font-black">{{ $order['number'] }}</div><div class="text-xs text-gray-400">{{ $order['items'] }} Items / {{ $order['status'] }}</div></div>
                <div class="font-black">{{ \App\Support\PrototypeData::money($order['total']) }}</div>
            </div>
        @endforeach
    </div>
</x-layouts.admin>
