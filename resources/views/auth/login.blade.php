<x-layouts.auth title="Login - Supermarket@Home">
    <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
        <h1 class="text-3xl font-black text-gray-900">Welcome back</h1>
        <p class="text-sm text-gray-500 mt-2">Sign in to your grocery account.</p>
        @include('partials.flash')
        <form action="{{ route('login') }}" method="POST" class="space-y-4 mt-6">
            @csrf
            <input name="email" type="email" value="{{ old('email') }}" required placeholder="Email address" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
            <input name="password" type="password" required placeholder="Password" class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
            <label class="flex items-center gap-2 text-sm text-gray-500"><input type="checkbox" name="remember" class="rounded text-primary"> Remember me</label>
            <button class="w-full bg-primary hover:bg-secondary text-white font-bold py-3 rounded-xl">Login</button>
        </form>
        <div class="mt-5 text-xs text-gray-500 space-y-1">
            <p>Customer: user@supermarket.com / password</p>
            <p>Admin: admin@supermarket.com / password</p>
        </div>
        <p class="text-sm text-gray-500 mt-6">No account? <a href="{{ route('register') }}" class="text-primary font-bold">Create one</a></p>
    </div>
</x-layouts.auth>
