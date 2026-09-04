<x-layouts.app title="Profile - Supermarket@Home">
    <main class="container mx-auto px-4 py-10 flex flex-col lg:flex-row gap-8">
        <x-customer.sidebar />
        <section class="flex-1 bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
            <h1 class="text-2xl font-black text-gray-900 mb-6">Profile Settings</h1>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4">
                    <h3 class="font-bold text-red-900 mb-2">Please fix the following errors:</h3>
                    <ul class="space-y-1 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-2xl p-4">
                    <p class="text-emerald-800 font-semibold">{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Full Name -->
                <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('name')])>
                    <label class="text-sm font-bold text-gray-600">Full Name *</label>
                    <input 
                        name="name" 
                        value="{{ old('name', $user->name) }}" 
                        class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                        required
                    >
                    @error('name')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email (readonly) -->
                <div>
                    <label class="text-sm font-bold text-gray-600">Email</label>
                    <input 
                        value="{{ $user->email }}" 
                        readonly 
                        class="mt-2 w-full p-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500"
                    >
                </div>

                <!-- Phone -->
                <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('phone')])>
                    <label class="text-sm font-bold text-gray-600">Phone</label>
                    <input 
                        name="phone" 
                        value="{{ old('phone', $user->phone) }}" 
                        class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                    >
                    @error('phone')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('address')])>
                    <label class="text-sm font-bold text-gray-600">Address</label>
                    <textarea 
                        name="address" 
                        rows="3" 
                        class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                    >{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Change Section -->
                <div class="pt-4 border-t border-gray-200">
                    <h3 class="font-bold text-gray-900 mb-4">Change Password (Optional)</h3>

                    <!-- New Password -->
                    <div @class(['mb-4', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('password')])>
                        <label class="text-sm font-bold text-gray-600">New Password</label>
                        <input 
                            name="password" 
                            type="password" 
                            class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                        @error('password')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('password_confirmation')])>
                        <label class="text-sm font-bold text-gray-600">Confirm Password</label>
                        <input 
                            name="password_confirmation" 
                            type="password" 
                            class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                        @error('password_confirmation')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary hover:bg-secondary text-white font-bold px-6 py-3 rounded-xl transition">
                        Save Profile
                    </button>
                </div>
            </form>
        </section>
    </main>
</x-layouts.app>
