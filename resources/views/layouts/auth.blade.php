<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Supermarket@Home - Login')</title>
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
<body class="bg-gradient-to-br from-primary to-secondary min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center space-x-2">
                <div class="bg-white p-3 rounded-lg">
                    <i class="fas fa-shopping-basket text-primary text-2xl"></i>
                </div>
                <span class="text-3xl font-bold text-white tracking-tight">Supermarket<span class="text-accent">@Home</span></span>
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            @yield('content')
        </div>

        <!-- Footer Link -->
        <div class="text-center mt-6 text-white text-sm">
            <p>Supermarket@Home &copy; 2026</p>
        </div>
    </div>
</body>
</html>
