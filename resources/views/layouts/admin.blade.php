<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Desa Mluweh')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            500: '#1e40af',
                            600: '#1d4ed8',
                            700: '#1e3a8a',
                        },
                        school: {
                            blue: '#1e40af',
                            yellow: '#fbbf24',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .bg-school-admin {
            background-image: linear-gradient(rgba(30, 64, 175, 0.95), rgba(30, 64, 175, 0.95)), url('/images/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-school-admin shadow-lg border-b border-school-blue">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <img src="/images/logo.png" alt="Logo Desa Mluweh" class="h-12 w-12 mr-3">
                        <div>
                            <h1 class="text-xl font-bold text-white">
                                <i class="fas fa-user-shield mr-2"></i>
                                Admin Dashboard
                            </h1>
                            <p class="text-blue-100 text-sm">Desa Mluweh</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center text-white">
                        <i class="fas fa-user mr-2"></i>
                        <span class="text-blue-100">{{ Auth::guard('admin')->user()->username }}</span>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
