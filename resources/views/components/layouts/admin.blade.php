<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin - Supermarket@Home' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 antialiased">
    <div class="min-h-screen flex">
        <x-admin.sidebar />
        <button type="button" data-admin-sidebar-backdrop class="fixed inset-0 z-40 hidden bg-black/50 md:hidden" aria-label="Close navigation"></button>
        <div class="flex-1 flex flex-col min-w-0 overflow-x-hidden">
            <header class="bg-white border-b border-gray-200 h-14 md:h-16 flex items-center justify-between px-4 md:px-6 sticky top-0 z-30">
                <button type="button" data-admin-sidebar-toggle aria-controls="admin-sidebar" aria-expanded="false" aria-label="Open navigation" class="p-2 -ml-2 mr-2 text-gray-600 hover:text-primary transition rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    <i class="fas fa-bars text-lg" aria-hidden="true"></i>
                </button>
                <form action="{{ route('admin.products.index') }}" class="relative w-64 hidden sm:block">
                    <input type="text" name="search" placeholder="Search SKUs, orders, customers..." class="w-full bg-gray-50 pl-9 pr-4 py-1.5 rounded-xl border border-gray-200 text-xs focus:outline-none focus:ring-2 focus:ring-primary">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                </form>
                <div class="flex items-center space-x-4 ml-auto">
                    <button class="relative p-2 text-gray-400 hover:text-primary transition"><i class="far fa-bell text-lg"></i><span class="absolute top-1 right-1 bg-accent h-2 w-2 rounded-full"></span></button>
                    <span class="hidden sm:inline text-xs font-bold text-gray-500 border-l pl-4 py-1">Lagos Sorting HQ</span>
                </div>
            </header>
            @include('partials.flash')
            <main class="p-4 md:p-6 space-y-6 md:space-y-8 flex-1">{{ $slot }}</main>
        </div>
    </div>
</body>
</html>
