<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Desa Mluweh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
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
        .bg-school-login {
            background-image: linear-gradient(rgba(30, 64, 175, 0.9), rgba(30, 64, 175, 0.9)), url('/images/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-school-login min-h-screen flex items-center justify-center">
    <div class="bg-white/95 backdrop-blur-sm rounded-xl shadow-2xl w-full max-w-md mx-4">
        <div class="p-8">
            <div class="text-center mb-8">
                <img src="/images/logo.png" alt="Logo SMK Negeri 1 Katapang" class="h-20 w-20 mx-auto mb-4">
                <h1 class="text-2xl font-bold text-school-blue">Login Admin</h1>
                <p class="text-gray-600 mt-2">Desa Mluweh - Ungaran Timur</p>
                <p class="text-gray-500 text-sm">Masuk ke panel administrasi</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <i class="fas fa-exclamation-circle text-red-400 mt-0.5 mr-3"></i>
                        <div>
                            <h3 class="text-sm font-medium text-red-800">Error:</h3>
                            <ul class="mt-2 text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-1 text-school-blue"></i>
                        Username
                    </label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           value="{{ old('username') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-school-blue focus:border-school-blue transition duration-200"
                           placeholder="Masukkan username"
                           required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-1 text-school-blue"></i>
                        Password
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-school-blue focus:border-school-blue transition duration-200"
                           placeholder="Masukkan password"
                           required>
                </div>

                <button type="submit" 
                        class="w-full bg-gradient-to-r from-school-blue to-school-blue/90 hover:from-school-blue/90 hover:to-school-blue text-white font-semibold py-3 rounded-lg shadow-lg transform hover:scale-105 transition duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Login
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('pengaduan.create') }}" 
                   class="text-school-blue hover:text-school-blue/80 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Kembali ke Halaman Pengaduan
                </a>
            </div>
        </div>
    </div>
</body>
</html>
