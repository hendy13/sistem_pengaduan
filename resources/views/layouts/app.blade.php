<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pengaduan Desa Mluweh')</title>
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
                    },
                    backgroundImage: {
                        'school': "linear-gradient(rgba(30, 64, 175, 0.8), rgba(30, 64, 175, 0.8)), url('/images/background.jpg')",
                        'school-light': "linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)), url('/images/background.jpg')",
                    }
                }
            }
        }
    </script>
    <style>
        .bg-school {
            background-image: linear-gradient(rgba(30, 64, 175, 0.8), rgba(30, 64, 175, 0.8)), url('/images/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .bg-school-light {
            background-image: linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)), url('/images/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-school-light min-h-screen">
    <nav class="bg-white/90 backdrop-blur-sm shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <img src="/images/logo.png" alt="Logo Desa Mluweh" class="h-12 w-12 mr-3">
                        <div>
                            <h1 class="text-xl font-bold text-school-blue">
                                Sistem Pengaduan
                            </h1>
                            <p class="text-sm text-gray-600">Desa Mluweh - Kecamatan Ungaran Timur</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @yield('nav-links')
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        @yield('content')
    </main>

    <footer class="bg-white/90 backdrop-blur-sm border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="flex items-center justify-center mb-2">
                    <img src="/images/logo.png" alt="Logo Desa Mluweh" class="h-8 w-8 mr-2">
                    <span class="text-school-blue font-semibold">Desa Mluweh - Kecamatan Ungaran Timur</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
