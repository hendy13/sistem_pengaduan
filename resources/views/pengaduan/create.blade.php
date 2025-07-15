@extends('layouts.app')

@section('title', 'Buat Pengaduan - Desa Mluweh')

@section('nav-links')
    <a href="{{ route('pengaduan.track') }}" class="text-school-blue hover:text-school-blue/80 font-medium flex items-center">
        <i class="fas fa-search mr-1"></i>
        Lacak Pengaduan
    </a>
    <a href="{{ route('admin.login') }}" class="bg-school-blue hover:bg-school-blue/90 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
        <i class="fas fa-user-shield mr-1"></i>
        Login Admin
    </a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white/95 backdrop-blur-sm rounded-xl shadow-2xl overflow-hidden">
        <div class="bg-school px-6 py-8">
            <div class="text-center">
                <img src="/images/logo.png" alt="Logo Desa Mluweh" class="h-16 w-16 mx-auto mb-4">
                <h1 class="text-3xl font-bold text-white">
                    <i class="fas fa-edit mr-3"></i>
                    Form Pengaduan
                </h1>
                <p class="text-blue-100 mt-2">
                    Desa Mluweh - Kecamatan Ungaran Timur
                </p>
                <p class="text-blue-200 text-sm mt-1">
                    Sampaikan Keluhan atau Saran Anda untuk Perbaikan Desa yang Lebih Baik
                </p>
            </div>
        </div>

        <div class="p-6">
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <i class="fas fa-exclamation-circle text-red-400 mt-0.5 mr-3"></i>
                        <div>
                            <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-1 text-school-blue"></i>
                            Nama Lengkap
                        </label>
                        <input type="text" 
                               id="nama" 
                               name="nama" 
                               value="{{ old('nama') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-school-blue focus:border-school-blue transition duration-200"
                               placeholder="Masukkan nama lengkap Anda"
                               required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-1 text-school-blue"></i>
                            Email
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-school-blue focus:border-school-blue transition duration-200"
                               placeholder="contoh@email.com"
                               required>
                    </div>
                </div>

                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-tags mr-1 text-school-blue"></i>
                        Kategori Pengaduan
                    </label>
                    <select id="kategori" 
                            name="kategori" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-school-blue focus:border-school-blue transition duration-200"
                            required>
                        <option value="">Pilih Kategori</option>
                        <option value="Fasilitas" {{ old('kategori') == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                        <option value="Kehilangan" {{ old('kategori') == 'Kehilangan' ? 'selected' : '' }}>Kehilangan</option>
                        <option value="Keamanan" {{ old('kategori') == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                        <option value="Kebersihan" {{ old('kategori') == 'Kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                        <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-comment-alt mr-1 text-school-blue"></i>
                        Deskripsi Pengaduan
                    </label>
                    <textarea id="deskripsi" 
                              name="deskripsi" 
                              rows="5"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-school-blue focus:border-school-blue transition duration-200"
                              placeholder="Jelaskan detail pengaduan Anda..."
                              required>{{ old('deskripsi') }}</textarea>
                </div>

                <div>
                    <label for="bukti_pendukung" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-paperclip mr-1 text-school-blue"></i>
                        Bukti Pendukung (Opsional)
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-school-blue transition duration-200">
                        <input type="file" 
                               id="bukti_pendukung" 
                               name="bukti_pendukung[]" 
                               multiple
                               accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                               class="hidden"
                               onchange="updateFileList(this)">
                        <label for="bukti_pendukung" class="cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-4xl text-school-blue mb-4"></i>
                            <p class="text-gray-600">Klik untuk memilih file atau drag & drop</p>
                            <p class="text-sm text-gray-500 mt-2">Format: JPG, PNG, PDF, DOC, DOCX (Max: 5MB per file)</p>
                        </label>
                        <div id="file-list" class="mt-4 text-left"></div>
                    </div>
                </div>

                <div class="flex justify-center pt-6">
                    <button type="submit" 
                            class="bg-gradient-to-r from-school-blue to-school-blue/90 hover:from-school-blue/90 hover:to-school-blue text-white font-semibold px-8 py-3 rounded-lg shadow-lg transform hover:scale-105 transition duration-200">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function updateFileList(input) {
    const fileList = document.getElementById('file-list');
    fileList.innerHTML = '';
    
    if (input.files.length > 0) {
        const ul = document.createElement('ul');
        ul.className = 'space-y-2';
        
        Array.from(input.files).forEach(file => {
            const li = document.createElement('li');
            li.className = 'flex items-center text-sm text-gray-600 bg-gray-50 p-2 rounded';
            li.innerHTML = `
                <i class="fas fa-file mr-2 text-school-blue"></i>
                <span>${file.name}</span>
                <span class="ml-auto text-xs text-gray-500">(${(file.size / 1024 / 1024).toFixed(2)} MB)</span>
            `;
            ul.appendChild(li);
        });
        
        fileList.appendChild(ul);
    }
}
</script>
@endpush
@endsection
