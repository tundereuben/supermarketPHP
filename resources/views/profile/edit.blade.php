<x-layouts.app title="Profile - Supermarket@Home">
    <main class="container mx-auto px-4 py-10 flex flex-col lg:flex-row gap-8">
        <x-customer.sidebar />
        <section class="flex-1 bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
            <h1 class="text-2xl font-black text-gray-900 mb-6">Profile Settings</h1>
            <form action="{{ route('profile.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <label class="text-sm font-bold text-gray-600">Full Name<input name="name" value="{{ old('name', $user->name) }}" class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"></label>
                <label class="text-sm font-bold text-gray-600">Email<input value="{{ $user->email }}" readonly class="mt-2 w-full p-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-500"></label>
                <label class="text-sm font-bold text-gray-600">Phone<input name="phone" value="{{ old('phone', $user->phone) }}" class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"></label>
                <label class="text-sm font-bold text-gray-600 md:col-span-2">Address<textarea name="address" rows="3" class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">{{ old('address', $user->address) }}</textarea></label>
                <label class="text-sm font-bold text-gray-600">New Password<input name="password" type="password" class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"></label>
                <label class="text-sm font-bold text-gray-600">Confirm Password<input name="password_confirmation" type="password" class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"></label>
                <button class="md:col-span-2 bg-primary hover:bg-secondary text-white font-bold px-6 py-3 rounded-xl w-fit">Save Profile</button>
            </form>
        </section>
    </main>
</x-layouts.app>
