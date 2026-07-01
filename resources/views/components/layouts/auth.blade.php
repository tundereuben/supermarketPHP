<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Account - Supermarket@Home' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-emerald-950 text-gray-900 antialiased">
    <main class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
        <section class="hidden lg:flex flex-col justify-between p-10 text-white relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=1600" class="absolute inset-0 h-full w-full object-cover opacity-30" alt="">
            <a href="{{ route('home') }}" class="relative z-10 inline-flex items-center gap-2 text-2xl font-black">
                <span class="bg-primary p-2 rounded-xl"><i class="fas fa-shopping-basket"></i></span>
                Supermarket<span class="text-primary">@Home</span>
            </a>
            <div class="relative z-10 max-w-lg">
                <h1 class="text-5xl font-black leading-tight">Fresh groceries without the market run.</h1>
                <p class="mt-5 text-emerald-100">Sign in to manage orders, food baskets, delivery details, and saved products.</p>
            </div>
            <p class="relative z-10 text-xs text-emerald-100/70">&copy; 2026 Supermarket@Home.</p>
        </section>
        <section class="flex items-center justify-center px-4 py-12 bg-gray-50">
            <div class="w-full max-w-md">{{ $slot }}</div>
        </section>
    </main>
</body>
</html>
