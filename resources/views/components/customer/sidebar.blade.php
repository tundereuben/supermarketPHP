<aside class="w-full lg:w-64 bg-white rounded-2xl border border-gray-100 p-4 shadow-sm h-fit">
    <nav class="space-y-1.5">
        <a href="{{ route('dashboard') }}" class="customer-nav {{ request()->routeIs('dashboard') ? 'customer-nav-active' : '' }}"><i class="fas fa-chart-line w-5"></i><span>Dashboard</span></a>
        <a href="{{ route('orders.index') }}" class="customer-nav {{ request()->routeIs('orders.*') ? 'customer-nav-active' : '' }}"><i class="fas fa-box w-5"></i><span>Orders</span></a>
        <a href="{{ route('subscriptions.index') }}" class="customer-nav"><i class="fas fa-basket-shopping w-5"></i><span>Subscriptions</span></a>
        <a href="{{ route('wishlist.index') }}" class="customer-nav {{ request()->routeIs('wishlist.*') ? 'customer-nav-active' : '' }}"><i class="fas fa-heart w-5"></i><span>Wishlist</span></a>
        <a href="{{ route('profile.edit') }}" class="customer-nav {{ request()->routeIs('profile.*') ? 'customer-nav-active' : '' }}"><i class="fas fa-user-gear w-5"></i><span>Profile</span></a>
        <form action="{{ route('logout') }}" method="POST" class="border-t pt-3 mt-3">
            @csrf
            <button class="customer-nav text-red-500 w-full"><i class="fas fa-power-off w-5"></i><span>Logout</span></button>
        </form>
    </nav>
</aside>
