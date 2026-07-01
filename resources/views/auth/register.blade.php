<x-layouts.auth title="Register - Supermarket@Home">
    <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
        <h1 class="text-3xl font-black text-gray-900">Create account</h1>
        <p class="text-sm text-gray-500 mt-2">Join the Supermarket@Home UI shell.</p>
        @include('partials.flash')
        <form action="{{ route('register') }}" method="POST" class="space-y-4 mt-6">
            @csrf
            <input name="name" value="{{ old('name') }}" required placeholder="Full name" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
            <input name="email" type="email" value="{{ old('email') }}" required placeholder="Email address" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
            <input name="phone" value="{{ old('phone') }}" placeholder="Phone number" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
            <textarea name="address" rows="3" placeholder="Delivery address" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">{{ old('address') }}</textarea>
            <input name="password" type="password" required placeholder="Password" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
            <input name="password_confirmation" type="password" required placeholder="Confirm password" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
            <button class="w-full bg-primary hover:bg-secondary text-white font-bold py-3 rounded-xl">Register</button>
        </form>
        <p class="text-sm text-gray-500 mt-6">Already have an account? <a href="{{ route('login') }}" class="text-primary font-bold">Login</a></p>
    </div>
</x-layouts.auth>
