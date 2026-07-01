<x-layouts.app title="Contact - Supermarket@Home">
    <main class="container mx-auto px-4 py-14 grid grid-cols-1 lg:grid-cols-2 gap-10">
        <section>
            <span class="text-primary font-black uppercase text-xs">Support</span>
            <h1 class="text-4xl font-black text-gray-900 mt-3">Contact Corporate Support</h1>
            <p class="text-gray-500 mt-4">This form is wired as a UI-shell placeholder and will show a flash message on submit.</p>
            <div class="mt-8 space-y-4 text-sm">
                <p><i class="fas fa-phone text-primary mr-3"></i>+234 800 123 4567</p>
                <p><i class="fas fa-envelope text-primary mr-3"></i>support@supermarket.test</p>
                <p><i class="fas fa-location-dot text-primary mr-3"></i>Lagos Sorting HQ</p>
            </div>
        </section>
        <form action="{{ route('placeholder.action') }}" method="POST" class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm space-y-4">
            @csrf
            <input name="name" placeholder="Full name" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
            <input name="email" type="email" placeholder="Email address" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
            <textarea name="message" rows="5" placeholder="How can we help?" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
            <button class="bg-primary hover:bg-secondary text-white font-bold px-6 py-3 rounded-xl">Send Message</button>
        </form>
    </main>
</x-layouts.app>
