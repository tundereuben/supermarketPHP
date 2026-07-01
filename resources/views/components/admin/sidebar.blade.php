<aside class="w-full md:w-64 bg-dark text-gray-400 flex flex-col justify-between p-5 border-r border-gray-800 md:sticky md:top-0 md:h-screen z-40">
    <div class="space-y-8">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 px-2">
            <span class="bg-primary p-2 rounded-lg text-white"><i class="fas fa-sliders text-lg"></i></span>
            <span class="text-xl font-bold text-white tracking-tight">Admin<span class="text-primary">@Home</span></span>
        </a>
        <nav class="space-y-1.5 flex flex-col">
            <a href="{{ route('admin.dashboard') }}" class="admin-nav {{ request()->routeIs('admin.dashboard') ? 'admin-nav-active' : '' }}"><i class="fas fa-chart-pie w-5 text-center"></i><span>Dashboard</span></a>
            <a href="{{ route('admin.orders.index') }}" class="admin-nav {{ request()->routeIs('admin.orders.*') ? 'admin-nav-active' : '' }}"><i class="fas fa-cart-shopping w-5 text-center"></i><span>Orders Control</span></a>
            <a href="{{ route('admin.products.index') }}" class="admin-nav {{ request()->routeIs('admin.products.*') ? 'admin-nav-active' : '' }}"><i class="fas fa-boxes-stacked w-5 text-center"></i><span>Inventory Catalog</span></a>
            <a href="{{ route('admin.subscriptions.index') }}" class="admin-nav {{ request()->routeIs('admin.subscriptions.*') ? 'admin-nav-active' : '' }}"><i class="fas fa-basket-shopping w-5 text-center"></i><span>Food Baskets</span></a>
            <a href="{{ route('admin.customers.index') }}" class="admin-nav {{ request()->routeIs('admin.customers.*') ? 'admin-nav-active' : '' }}"><i class="fas fa-users w-5 text-center"></i><span>Customers DB</span></a>
        </nav>
    </div>
    <div class="border-t border-gray-800 pt-4 px-2 mt-6 flex items-center justify-between text-xs font-semibold">
        <div class="flex items-center space-x-2">
            <div class="h-7 w-7 rounded-full bg-primary/20 text-primary flex items-center justify-center font-bold">A</div>
            <span class="text-gray-300">Manager Terminal</span>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="text-red-400 hover:text-red-500 transition" title="Exit Panel"><i class="fas fa-power-off text-sm"></i></button>
        </form>
    </div>
</aside>
