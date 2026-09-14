<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Supermarket@Home' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    <div class="bg-secondary text-white py-2 text-center text-sm font-semibold">Free Delivery on orders above ₦50,000! Shop Now.</div>

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 shrink-0">
                <span class="bg-primary p-2 rounded-lg text-white"><i class="fas fa-shopping-basket text-xl"></i></span>
                <span class="text-xl md:text-2xl font-bold text-gray-900 tracking-tight">Supermarket<span class="text-primary">@Home</span></span>
            </a>

            <form action="{{ route('products.index') }}" method="GET" class="hidden md:flex flex-1 max-w-xl relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for groceries, beverages, household items..." class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary">
                <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
            </form>

            <nav class="flex items-center space-x-5 text-gray-600">
                @auth
                    <a href="{{ route('dashboard') }}" class="hidden md:flex flex-col items-center hover:text-primary transition">
                        <i class="far fa-user text-xl"></i><span class="text-xs mt-1">{{ Str::before(auth()->user()->name, ' ') }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hidden md:flex flex-col items-center hover:text-primary transition">
                        <i class="far fa-user text-xl"></i><span class="text-xs mt-1">Account</span>
                    </a>
                @endauth
                <a href="{{ route('wishlist.index') }}" class="hidden md:flex flex-col items-center hover:text-primary transition relative">
                    <i class="far fa-heart text-xl"></i><span class="text-xs mt-1">Wishlist</span>
                    @if($wishlistCount > 0)
                        <span class="absolute -top-1 -right-1 bg-accent text-white text-[10px] rounded-full h-4 w-4 flex items-center justify-center font-bold">{{ $wishlistCount }}</span>
                    @endif
                </a>
                <a href="{{ route('cart.index') }}" class="flex flex-col items-center hover:text-primary transition relative">
                    <i class="fas fa-shopping-cart text-xl text-primary"></i><span class="text-xs mt-1">Cart</span>
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-accent text-white text-[10px] rounded-full h-4 w-4 flex items-center justify-center font-bold">{{ $cartCount }}</span>
                    @endif
                </a>
            </nav>
        </div>

        <form action="{{ route('products.index') }}" method="GET" class="md:hidden px-4 pb-3 relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary">
            <i class="fas fa-search absolute left-8 top-3 text-gray-400"></i>
        </form>

        <nav class="bg-gray-100 border-t border-gray-200 hidden md:block">
            <div class="container mx-auto px-4 flex items-center justify-between py-2">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-primary font-medium py-2">Products</a>
                    <a href="{{ route('subscriptions.index') }}" class="text-gray-600 hover:text-primary font-medium py-2">Food Baskets</a>
                    <a href="{{ route('about') }}" class="text-gray-600 hover:text-primary font-medium py-2">About Us</a>
                    <a href="{{ route('faq') }}" class="text-gray-600 hover:text-primary font-medium py-2">FAQ</a>
                    <a href="{{ route('contact') }}" class="text-gray-600 hover:text-primary font-medium py-2">Contact</a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-red-600 hover:text-red-700 font-bold py-2">Admin</a>
                        @endif
                    @endauth
                </div>
                <div class="flex items-center text-primary font-semibold"><i class="fas fa-phone-alt mr-2"></i><span>+234 800 123 4567</span></div>
            </div>
        </nav>
    </header>

    @include('partials.flash')
    {{ $slot }}

    <footer class="bg-gray-900 text-gray-300 mt-16">
        <div class="container mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="md:col-span-2">
                <div class="text-2xl font-bold text-white">Supermarket<span class="text-primary">@Home</span></div>
                <p class="text-sm mt-3 max-w-md">A Laravel UI shell adapted from the prototype for fresh groceries, food baskets, customer accounts, and admin workflows.</p>
            </div>
            <div>
                <h3 class="font-bold text-white mb-3">Shop</h3>
                <a href="{{ route('products.index') }}" class="block text-sm hover:text-primary">Products</a>
                <a href="{{ route('subscriptions.index') }}" class="block text-sm mt-2 hover:text-primary">Food Baskets</a>
                <a href="{{ route('cart.index') }}" class="block text-sm mt-2 hover:text-primary">Cart</a>
            </div>
            <div>
                <h3 class="font-bold text-white mb-3">Support</h3>
                <a href="{{ route('about') }}" class="block text-sm hover:text-primary">About</a>
                <a href="{{ route('faq') }}" class="block text-sm mt-2 hover:text-primary">FAQ</a>
                <a href="{{ route('contact') }}" class="block text-sm mt-2 hover:text-primary">Contact</a>
            </div>
        </div>
        <div class="border-t border-gray-800 py-4 text-center text-xs">&copy; 2026 Supermarket@Home. Prototype UI shell.</div>
    </footer>
</body>
</html>
