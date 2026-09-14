<x-layouts.admin title="Subscription Management - Admin">
    <h1 class="text-2xl font-black text-gray-900 mb-6">Food Basket Plans</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($subscriptions as $plan)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="font-black">{{ $plan->name }}</h2>
                <div class="text-2xl font-black text-primary mt-3">{{ \App\Support\PrototypeData::money($plan->price) }}</div>
                <p class="text-xs text-gray-400 mt-2">{{ $plan->delivery_frequency }} / savings {{ \App\Support\PrototypeData::money($plan->savings_amount) }}</p>
            </div>
        @empty
            <p class="text-gray-500 font-bold col-span-3 text-center py-10">No subscription plans found.</p>
        @endforelse
    </div>

    @if ($subscriptions->hasPages())
        <div class="mt-6">
            {{ $subscriptions->links() }}
        </div>
    @endif
</x-layouts.admin>
