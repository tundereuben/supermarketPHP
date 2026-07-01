<x-layouts.app title="Food Baskets - Supermarket@Home">
    <main class="container mx-auto px-4 py-14">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-primary font-black uppercase text-xs">Recurring groceries</span>
            <h1 class="text-4xl font-black text-gray-900 mt-3">Subscription Food Baskets</h1>
            <p class="text-gray-500 mt-3">Static plans from the prototype, ready to become database-backed later.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($subscriptions as $plan)
                <article class="bg-white border border-gray-100 rounded-3xl p-7 shadow-sm {{ $loop->iteration === 2 ? 'ring-2 ring-primary' : '' }}">
                    <h2 class="font-black text-xl text-gray-900">{{ $plan['name'] }}</h2>
                    <div class="mt-4"><span class="text-4xl font-black text-gray-900">{{ \App\Support\PrototypeData::money($plan['price']) }}</span><span class="text-gray-400"> / {{ $plan['frequency'] }}</span></div>
                    <p class="text-sm text-primary font-bold mt-2">Monthly savings: ~{{ \App\Support\PrototypeData::money($plan['saving']) }}</p>
                    <ul class="mt-6 space-y-3 text-sm text-gray-600">
                        @foreach($plan['features'] as $feature)
                            <li><i class="fas fa-check text-primary mr-2"></i>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    <form action="{{ route('placeholder.action') }}" method="POST" class="mt-7">@csrf<button class="w-full bg-primary hover:bg-secondary text-white font-bold py-3 rounded-xl">Choose Plan</button></form>
                </article>
            @endforeach
        </div>
    </main>
</x-layouts.app>
