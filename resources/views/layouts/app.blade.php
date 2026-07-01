<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Supermarket@Home - Fresh Groceries Delivered To Your Doorstep')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#10B981',
                        secondary: '#047857',
                        accent: '#F97316',
                    }
                }
            }
        }
    </script>
    @yield('extra_styles')
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Top Announcement Bar -->
    <div class="bg-secondary text-white py-2 text-center text-sm font-medium">
        <p>🎉 Free Delivery on orders above ₦20,000! Shop Now.</p>
    </div>

    <!-- Navigation Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <div class="bg-primary p-2 rounded-lg">
                    <i class="fas fa-shopping-basket text-white text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-900 tracking-tight">Supermarket<span class="text-primary">@Home</span></span>
            </a>

            <!-- Search Bar (Desktop) -->
            <div class="hidden md:flex flex-1 mx-8 relative">
                <form action="{{ route('products.index') }}" method="GET" class="w-full">
                    <input type="text" name="search" placeholder="Search groceries..." value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
                </form>
            </div>

            <!-- User Actions -->
            <div class="flex items-center space-x-6">
                @auth
                    <a href="{{ route('profile.edit') }}" class="hidden md:flex flex-col items-center text-gray-600 hover:text-primary transition">
                        <i class="far fa-user text-xl"></i>
                        <span class="text-xs mt-1">Account</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hidden md:flex flex-col items-center text-gray-600 hover:text-primary transition">
                        <i class="far fa-user text-xl"></i>
                        <span class="text-xs mt-1">Login</span>
                    </a>
                @endauth
                <a href="{{ route('wishlist.index') }}" class="hidden md:flex flex-col items-center text-gray-600 hover:text-primary transition relative">
                    <i class="far fa-heart text-xl"></i>
                    <span class="text-xs mt-1">Wishlist</span>
                </a>
                <a href="{{ route('cart.index') }}" class="flex flex-col items-center text-gray-600 hover:text-primary transition relative">
                    <i class="fas fa-shopping-cart text-xl text-primary"></i>
                    <span class="text-xs mt-1">Cart</span>
                    <span class="absolute -top-1 -right-1 bg-accent text-white text-[10px] rounded-full h-4 w-4 flex items-center justify-center font-bold">{{ session('cart_count', 0) }}</span>
                </a>
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Search Bar -->
        <div class="md:hidden px-4 pb-3">
            <form action="{{ route('products.index') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Search products..." class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 mt-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-white font-bold mb-4">About Us</h3>
                    <p class="text-sm">Delivering fresh groceries and essential items to your doorstep with quality assurance and fast delivery.</p>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4">Quick Links</h3>
                    <ul class="text-sm space-y-2">
                        <li><a href="{{ route('about') }}" class="hover:text-primary transition">About</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-primary transition">Products</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-primary transition">Contact</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-primary transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4">Customer Service</h3>
                    <ul class="text-sm space-y-2">
                        <li><a href="{{ route('subscriptions.index') }}" class="hover:text-primary transition">Subscriptions</a></li>
                        <li><a href="{{ route('dashboard') }}" class="hover:text-primary transition">Dashboard</a></li>
                        <li><a href="{{ route('orders.index') }}" class="hover:text-primary transition">My Orders</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4">Contact</h3>
                    <ul class="text-sm space-y-2">
                        <li><a href="tel:+2348000000000" class="hover:text-primary transition">+234 800 000 0000</a></li>
                        <li><a href="mailto:support@supermarket.test" class="hover:text-primary transition">support@supermarket.test</a></li>
                        <li>Lagos, Nigeria</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-sm">
                <p>&copy; 2026 Supermarket@Home. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @yield('extra_scripts')
</body>
</html>
