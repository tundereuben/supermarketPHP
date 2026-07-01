<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Supermarket@Home')</title>
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
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white shadow-lg overflow-y-auto">
            <div class="p-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <div class="bg-primary p-2 rounded-lg">
                        <i class="fas fa-shopping-basket text-white text-xl"></i>
                    </div>
                    <span class="text-xl font-bold">Admin Panel</span>
                </a>
            </div>

            <nav class="mt-8 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : 'text-gray-400 hover:bg-gray-800' }} transition">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-primary text-white' : 'text-gray-400 hover:bg-gray-800' }} transition">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-primary text-white' : 'text-gray-400 hover:bg-gray-800' }} transition">
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                </a>
                <a href="{{ route('admin.subscriptions.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.subscriptions.*') ? 'bg-primary text-white' : 'text-gray-400 hover:bg-gray-800' }} transition">
                    <i class="fas fa-basket-shopping"></i>
                    <span>Subscriptions</span>
                </a>
                <a href="{{ route('admin.customers.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.customers.*') ? 'bg-primary text-white' : 'text-gray-400 hover:bg-gray-800' }} transition">
                    <i class="fas fa-users"></i>
                    <span>Customers</span>
                </a>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gray-800">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 text-gray-400 hover:text-white transition w-full">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-200 shadow-sm">
                <div class="flex items-center justify-between px-8 py-4">
                    <h1 class="text-2xl font-bold text-gray-900">@yield('header', 'Dashboard')</h1>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                        <img src="https://via.placeholder.com/40" alt="Avatar" class="w-10 h-10 rounded-full">
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-8">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
