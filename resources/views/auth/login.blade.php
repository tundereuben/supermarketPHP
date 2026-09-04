<x-layouts.auth title="Login - Supermarket@Home">
    <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
        <h1 class="text-3xl font-black text-gray-900">Welcome back</h1>
        <p class="text-sm text-gray-500 mt-2">Sign in to your grocery account.</p>
        
        @include('partials.flash')

        @if ($errors->any())
            <div class="mt-4 mb-4 bg-red-50 border border-red-200 rounded-2xl p-4">
                <h3 class="font-bold text-red-900 mb-2 text-sm">Login failed</h3>
                <ul class="space-y-1 text-xs text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4 mt-6">
            @csrf

            <!-- Email -->
            <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('email')])>
                <input 
                    name="email" 
                    type="email" 
                    value="{{ old('email') }}" 
                    required 
                    placeholder="Email address" 
                    class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                >
                @error('email')
                    <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('password')])>
                <input 
                    name="password" 
                    type="password" 
                    required 
                    placeholder="Password" 
                    class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                >
                @error('password')
                    <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <label class="flex items-center gap-2 text-sm text-gray-500">
                <input type="checkbox" name="remember" class="rounded text-primary"> Remember me
            </label>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-primary hover:bg-secondary text-white font-bold py-3 rounded-xl transition">Login</button>
        </form>

        <!-- Test Credentials -->
        <div class="mt-5 text-xs text-gray-500 space-y-1 bg-gray-50 p-3 rounded-xl">
            <p class="font-semibold text-gray-700 mb-2">Demo Credentials:</p>
            <p><strong>Customer:</strong> user@supermarket.test / password</p>
            <p><strong>Admin:</strong> admin@supermarket.test / password</p>
        </div>

        <!-- Register Link -->
        <p class="text-sm text-gray-500 mt-6">No account? <a href="{{ route('register') }}" class="text-primary font-bold hover:text-secondary">Create one</a></p>
    </div>
</x-layouts.auth>
