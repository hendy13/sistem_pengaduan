@extends('layouts.app')

@section('title', 'Lacak Pengaduan')

@section('nav-links')
    <a href="{{ route('pengaduan.create') }}" class="text-primary-600 hover:text-primary-700 font-medium">
        <i class="fas fa-plus mr-1"></i>
        Buat Pengaduan
    </a>
    <a href="{{ route('admin.login') }}" class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 rounded-lg transition duration-200">
        <i class="fas fa-user-shield mr-1"></i>
        Login Admin
    </a>
@endsection

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-8">
            <h1 class="text-3xl font-bold text-white text-center">
                <i class="fas fa-search mr-3"></i>
                Lacak Status Pengaduan
            </h1>
            <p class="text-primary-100 text-center mt-2">
                Masukkan kode unik untuk melihat status pengaduan Anda
            </p>
        </div>

        <div class="p-6">
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

            <form method="POST" action="{{ route('pengaduan.check-status') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="kode_unik" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-key mr-1"></i>
                        Kode Unik Pengaduan
                    </label>
                    <input type="text" 
                           id="kode_unik" 
                           name="kode_unik" 
                           value="{{ old('kode_unik') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 font-mono text-center text-lg"
                           placeholder="PGD-XXXXXXXX"
                           required>
                    <p class="text-sm text-gray-500 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Contoh format: PGD-ABC12345
                    </p>
                </div>

                <div class="flex justify-center">
                    <button type="submit" 
                            class="bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-semibold px-8 py-3 rounded-lg shadow-lg transform hover:scale-105 transition duration-200">
                        <i class="fas fa-search mr-2"></i>
                        Cek Status
                    </button>
                </div>
            </form>

            <div class="mt-8 bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-question-circle mr-2"></i>
                    Bantuan
                </h3>
                <div class="space-y-3 text-sm text-gray-600">
                    <div class="flex items-start">
                        <i class="fas fa-dot-circle text-primary-500 mt-1 mr-3"></i>
                        <div>
                            <strong>Kode unik</strong> diberikan setelah Anda berhasil mengirim pengaduan
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-dot-circle text-primary-500 mt-1 mr-3"></i>
                        <div>
                            Pastikan Anda memasukkan kode dengan <strong>benar dan lengkap</strong>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-dot-circle text-primary-500 mt-1 mr-3"></i>
                        <div>
                            Jika mengalami kesulitan, silakan hubungi admin sekolah
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
