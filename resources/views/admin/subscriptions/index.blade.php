<x-layouts.admin title="Subscription Management - Admin">
    <h1 class="text-2xl font-black text-gray-900">Food Basket Plans</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($subscriptions as $plan)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="font-black">{{ $plan['name'] }}</h2>
                <div class="text-2xl font-black text-primary mt-3">{{ \App\Support\PrototypeData::money($plan['price']) }}</div>
                <p class="text-xs text-gray-400 mt-2">{{ $plan['frequency'] }} / savings {{ \App\Support\PrototypeData::money($plan['saving']) }}</p>
            </div>
        @endforeach
    </div>
</x-layouts.admin>
