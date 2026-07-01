<x-layouts.app title="About - Supermarket@Home">
    <main class="container mx-auto px-4 py-14">
        <section class="max-w-3xl">
            <span class="text-primary font-black uppercase text-xs">Our Story</span>
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 mt-3">Nigeria's digital grocery experience, shaped from the prototype.</h1>
            <p class="text-gray-600 mt-5 leading-relaxed">Supermarket@Home bridges local markets and urban households with a polished shopping interface. This Laravel version keeps the prototype visuals while preparing the app for real backend features later.</p>
        </section>
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
            @foreach(['Freshness' => 'Curated produce and grocery categories.', 'Reliability' => 'Predictable cart, checkout, and account flows.', 'Operations' => 'Admin screens for orders, products, subscriptions, and customers.'] as $title => $copy)
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <h2 class="font-black text-gray-900">{{ $title }}</h2>
                    <p class="text-sm text-gray-500 mt-2">{{ $copy }}</p>
                </div>
            @endforeach
        </section>
    </main>
</x-layouts.app>
