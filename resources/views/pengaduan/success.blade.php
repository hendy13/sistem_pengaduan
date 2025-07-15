@extends('layouts.app')

@section('title', 'Pengaduan Berhasil Dikirim - SMK Negeri 1 Katapang')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white/95 backdrop-blur-sm rounded-xl shadow-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-8 text-center">
            <img src="/images/logo.png" alt="Logo SMK Negeri 1 Katapang" class="h-16 w-16 mx-auto mb-4">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check text-green-500 text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-white">Pengaduan Berhasil Dikirim!</h1>
            <p class="text-green-100 mt-2">Desa Mluweh</p>
            <p class="text-green-200 text-sm">Terima kasih atas laporan Anda</p>
        </div>

        <div class="p-6">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold text-blue-800 mb-4">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informasi Penting
                </h2>
                <div class="space-y-3">
                    <div class="flex items-center justify-between bg-white p-4 rounded-lg">
                        <span class="text-gray-600">Kode Unik Pengaduan:</span>
                        <div class="flex items-center">
                            <code class="bg-gray-100 px-3 py-1 rounded text-lg font-mono font-bold text-school-blue" id="kode-unik">
                                {{ $pengaduan->kode_unik }}
                            </code>
                            <button onclick="copyKode()" class="ml-2 text-school-blue hover:text-school-blue/80" title="Salin kode">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between bg-white p-4 rounded-lg">
                        <span class="text-gray-600">Status Saat Ini:</span>
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                            {{ $pengaduan->status_label }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between bg-white p-4 rounded-lg">
                        <span class="text-gray-600">Tanggal Pengaduan:</span>
                        <span class="font-medium">{{ $pengaduan->tanggal_pengaduan->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <i class="fas fa-exclamation-triangle text-yellow-400 mt-0.5 mr-3"></i>
                    <div>
                        <h3 class="text-sm font-medium text-yellow-800">Penting untuk diingat:</h3>
                        <ul class="mt-2 text-sm text-yellow-700 list-disc list-inside space-y-1">
                            <li>Simpan kode unik ini dengan baik</li>
                            <li>Gunakan kode ini untuk melacak status pengaduan Anda</li>
                            <li>Pengaduan akan diproses dalam 1-3 hari kerja</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('pengaduan.track') }}" 
                   class="bg-school-blue hover:bg-school-blue/90 text-white px-6 py-3 rounded-lg text-center transition duration-200">
                    <i class="fas fa-search mr-2"></i>
                    Lacak Status Pengaduan
                </a>
                <a href="{{ route('pengaduan.create') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg text-center transition duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Pengaduan Baru
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function copyKode() {
    const kodeElement = document.getElementById('kode-unik');
    const kode = kodeElement.textContent.trim();
    
    navigator.clipboard.writeText(kode).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalIcon = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check"></i>';
        button.classList.add('text-green-500');
        
        setTimeout(() => {
            button.innerHTML = originalIcon;
            button.classList.remove('text-green-500');
        }, 2000);
    });
}
</script>
@endpush
@endsection
