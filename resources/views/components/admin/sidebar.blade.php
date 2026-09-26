<aside id="admin-sidebar" data-admin-sidebar aria-label="Admin navigation" class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full bg-dark text-gray-400 flex flex-col justify-between p-3 md:sticky md:top-0 md:z-auto md:h-screen md:w-64 md:translate-x-0 md:flex-shrink-0 md:border-r md:border-gray-800 md:p-5 md:transition-[width] md:duration-200">
    <div class="space-y-6 md:space-y-8">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 px-1 md:px-2">
            <span class="bg-primary p-2 rounded-lg text-white"><i class="fas fa-sliders text-lg"></i></span>
            <span data-admin-sidebar-label class="text-lg md:text-xl font-bold text-white tracking-tight">Admin<span class="text-primary">@Home</span></span>
        </a>
        <nav class="flex flex-col space-y-1.5">
            <a href="{{ route('admin.dashboard') }}" aria-label="Dashboard" title="Dashboard" class="admin-nav {{ request()->routeIs('admin.dashboard') ? 'admin-nav-active' : '' }}"><i class="fas fa-chart-pie w-5 text-center"></i><span data-admin-sidebar-label>Dashboard</span></a>
            <a href="{{ route('admin.orders.index') }}" aria-label="Orders Control" title="Orders Control" class="admin-nav {{ request()->routeIs('admin.orders.*') ? 'admin-nav-active' : '' }}"><i class="fas fa-cart-shopping w-5 text-center"></i><span data-admin-sidebar-label>Orders Control</span></a>
            <a href="{{ route('admin.products.index') }}" aria-label="Inventory Catalog" title="Inventory Catalog" class="admin-nav {{ request()->routeIs('admin.products.*') ? 'admin-nav-active' : '' }}"><i class="fas fa-boxes-stacked w-5 text-center"></i><span data-admin-sidebar-label>Inventory Catalog</span></a>
            <a href="{{ route('admin.subscriptions.index') }}" aria-label="Food Baskets" title="Food Baskets" class="admin-nav {{ request()->routeIs('admin.subscriptions.*') ? 'admin-nav-active' : '' }}"><i class="fas fa-basket-shopping w-5 text-center"></i><span data-admin-sidebar-label>Food Baskets</span></a>
            <a href="{{ route('admin.customers.index') }}" aria-label="Customers DB" title="Customers DB" class="admin-nav {{ request()->routeIs('admin.customers.*') ? 'admin-nav-active' : '' }}"><i class="fas fa-users w-5 text-center"></i><span data-admin-sidebar-label>Customers DB</span></a>
        </nav>
    </div>
    <div class="border-t border-gray-800 pt-4 px-2 mt-6 flex items-center justify-between text-xs font-semibold">
        <div class="flex items-center space-x-2">
            <div class="h-7 w-7 rounded-full bg-primary/20 text-primary flex items-center justify-center font-bold">A</div>
            <span data-admin-sidebar-label class="text-gray-300">Manager Terminal</span>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="text-red-400 hover:text-red-500 transition" title="Exit Panel"><i class="fas fa-power-off text-sm"></i></button>
        </form>
    </div>
</aside>
