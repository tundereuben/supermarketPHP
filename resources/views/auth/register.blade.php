<x-layouts.auth title="Register - Supermarket@Home">
    <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
        <h1 class="text-3xl font-black text-gray-900">Create account</h1>
        <p class="text-sm text-gray-500 mt-2">Join Supermarket@Home and start shopping.</p>
        
        @include('partials.flash')

        @if ($errors->any())
            <div class="mt-4 mb-4 bg-red-50 border border-red-200 rounded-2xl p-4">
                <h3 class="font-bold text-red-900 mb-2 text-sm">Registration failed</h3>
                <ul class="space-y-1 text-xs text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4 mt-6">
            @csrf

            <!-- Full Name -->
            <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('name')])>
                <input 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    placeholder="Full name" 
                    class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                >
                @error('name')
                    <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

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

            <!-- Phone -->
            <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('phone')])>
                <input 
                    name="phone" 
                    value="{{ old('phone') }}" 
                    placeholder="Phone number (optional)" 
                    class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                >
                @error('phone')
                    <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('address')])>
                <textarea 
                    name="address" 
                    rows="3" 
                    placeholder="Delivery address (optional)" 
                    class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                >{{ old('address') }}</textarea>
                @error('address')
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

            <!-- Password Confirmation -->
            <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('password_confirmation')])>
                <input 
                    name="password_confirmation" 
                    type="password" 
                    required 
                    placeholder="Confirm password" 
                    class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                >
                @error('password_confirmation')
                    <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-primary hover:bg-secondary text-white font-bold py-3 rounded-xl transition">Register</button>
        </form>

        <!-- Login Link -->
        <p class="text-sm text-gray-500 mt-6">Already have an account? <a href="{{ route('login') }}" class="text-primary font-bold hover:text-secondary">Login</a></p>
    </div>
</x-layouts.auth>
