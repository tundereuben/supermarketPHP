<x-layouts.app title="FAQ - Supermarket@Home">
    <main class="container mx-auto px-4 py-14 max-w-4xl">
        <h1 class="text-4xl font-black text-gray-900">Frequently Asked Questions</h1>
        <div class="mt-8 space-y-4">
            @foreach(['How does delivery work?' => 'The UI shell displays delivery messaging from the prototype. Real delivery slots can be added in the backend phase.', 'Can I subscribe to monthly baskets?' => 'Yes, the pages and forms are present as placeholders for the next implementation phase.', 'Are prices real?' => 'Prices are static prototype data for now and can be moved into database-backed products later.'] as $question => $answer)
                <details class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm" open>
                    <summary class="font-bold text-gray-900 cursor-pointer">{{ $question }}</summary>
                    <p class="text-sm text-gray-500 mt-3">{{ $answer }}</p>
                </details>
            @endforeach
        </div>
    </main>
</x-layouts.app>
