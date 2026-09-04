<x-layouts.app title="Food Baskets - Supermarket@Home">
    <main class="container mx-auto px-4 py-14">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-primary font-black uppercase text-xs">Recurring groceries</span>
            <h1 class="text-4xl font-black text-gray-900 mt-3">Subscription Food Baskets</h1>
            <p class="text-gray-500 mt-3">Choose your delivery frequency and save on regular grocery needs.</p>
        </div>

        @if (session('success'))
            <div class="max-w-4xl mx-auto mb-6 bg-emerald-50 border border-emerald-200 rounded-2xl p-4">
                <p class="text-emerald-800 font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-4xl mx-auto mb-6 bg-red-50 border border-red-200 rounded-2xl p-4">
                <p class="text-red-800 font-semibold">{{ session('error') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
            @foreach($subscriptions as $subscription)
                <article class="bg-white border border-gray-100 rounded-3xl p-7 shadow-sm flex flex-col" @class(['ring-2 ring-primary' => $loop->iteration === 2])>
                    <h2 class="font-black text-xl text-gray-900">{{ $subscription->name }}</h2>
                    
                    <!-- Price -->
                    <div class="mt-4">
                        <span class="text-4xl font-black text-gray-900">₦{{ number_format($subscription->price) }}</span>
                        <span class="text-gray-400 ml-2">/month</span>
                    </div>

                    <!-- Savings Badge -->
                    @if ($subscription->savings_amount > 0)
                        <p class="text-sm text-primary font-bold mt-2">
                            <i class="fas fa-leaf mr-1"></i>Save ~₦{{ number_format($subscription->savings_amount) }}/month
                        </p>
                    @endif

                    <!-- Description -->
                    <p class="text-sm text-gray-600 mt-4 flex-grow">{{ $subscription->description }}</p>

                    <!-- Features -->
                    <ul class="mt-6 space-y-3 text-sm text-gray-600 flex-grow">
                        @if (is_array($subscription->features))
                            @foreach($subscription->features as $feature)
                                <li><i class="fas fa-check text-primary mr-2"></i>{{ $feature }}</li>
                            @endforeach
                        @else
                            @php
                                $features = json_decode($subscription->features, true) ?? [];
                            @endphp
                            @foreach($features as $feature)
                                <li><i class="fas fa-check text-primary mr-2"></i>{{ $feature }}</li>
                            @endforeach
                        @endif
                    </ul>

                    <!-- Subscribe Button -->
                    @auth
                        <button 
                            type="button" 
                            onclick="openSubscribeModal({{ $subscription->id }}, '{{ $subscription->name }}')"
                            class="mt-7 w-full bg-primary hover:bg-secondary text-white font-bold py-3 rounded-xl transition"
                        >
                            Subscribe Now
                        </button>
                    @else
                        <a 
                            href="{{ route('login') }}" 
                            class="mt-7 block text-center w-full bg-primary hover:bg-secondary text-white font-bold py-3 rounded-xl transition"
                        >
                            Login to Subscribe
                        </a>
                    @endauth
                </article>
            @endforeach
        </div>
    </main>

    <!-- Subscribe Modal -->
    <div id="subscribeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4">
            <h3 class="text-2xl font-black text-gray-900 mb-2">Choose Delivery Frequency</h3>
            <p class="text-gray-500 mb-6" id="subscriptionName"></p>

            <form id="subscribeForm" method="POST" class="space-y-4">
                @csrf
                
                <!-- Frequency Options -->
                <div class="space-y-3">
                    <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-primary transition" onclick="selectFrequency('monthly')">
                        <input type="radio" name="frequency" value="monthly" class="w-4 h-4 text-primary" checked>
                        <div class="ml-4">
                            <p class="font-semibold text-gray-900">Monthly</p>
                            <p class="text-sm text-gray-500">Every month</p>
                        </div>
                    </label>

                    <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-primary transition" onclick="selectFrequency('quarterly')">
                        <input type="radio" name="frequency" value="quarterly" class="w-4 h-4 text-primary">
                        <div class="ml-4">
                            <p class="font-semibold text-gray-900">Quarterly</p>
                            <p class="text-sm text-gray-500">Every 3 months</p>
                        </div>
                    </label>

                    <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-primary transition" onclick="selectFrequency('yearly')">
                        <input type="radio" name="frequency" value="yearly" class="w-4 h-4 text-primary">
                        <div class="ml-4">
                            <p class="font-semibold text-gray-900">Yearly</p>
                            <p class="text-sm text-gray-500">Every 12 months</p>
                        </div>
                    </label>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-4">
                    <button 
                        type="button" 
                        onclick="closeSubscribeModal()"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-900 font-bold px-4 py-3 rounded-xl transition"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit"
                        class="flex-1 bg-primary hover:bg-secondary text-white font-bold px-4 py-3 rounded-xl transition"
                    >
                        Subscribe
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentSubscriptionId = null;

        function openSubscribeModal(subscriptionId, subscriptionName) {
            currentSubscriptionId = subscriptionId;
            document.getElementById('subscriptionName').textContent = 'Subscribe to ' + subscriptionName;
            document.getElementById('subscribeForm').action = '/subscribe/' + subscriptionId;
            document.getElementById('subscribeModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeSubscribeModal() {
            document.getElementById('subscribeModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function selectFrequency(frequency) {
            document.querySelector('input[value="' + frequency + '"]').checked = true;
        }

        // Close modal when clicking outside
        document.getElementById('subscribeModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSubscribeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSubscribeModal();
            }
        });
    </script>
</x-layouts.app>
