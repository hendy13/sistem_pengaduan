@extends('layouts.app')

@section('title', 'Status Pengaduan')

@section('nav-links')
    <a href="{{ route('pengaduan.track') }}" class="text-primary-600 hover:text-primary-700 font-medium">
        <i class="fas fa-arrow-left mr-1"></i>
        Kembali
    </a>
    <a href="{{ route('pengaduan.create') }}" class="text-primary-600 hover:text-primary-700 font-medium">
        <i class="fas fa-plus mr-1"></i>
        Buat Pengaduan Baru
    </a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-8">
            <h1 class="text-3xl font-bold text-white text-center">
                <i class="fas fa-clipboard-check mr-3"></i>
                Detail Pengaduan
            </h1>
            <p class="text-primary-100 text-center mt-2">
                Kode: {{ $pengaduan->kode_unik }}
            </p>
        </div>

        <div class="p-6">
            <!-- Status Timeline -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">
                    <i class="fas fa-timeline mr-2"></i>
                    Status Pengaduan
                </h2>
                <div class="flex items-center justify-between mb-4">
                    @php
                        $statuses = [
                            'diterima' => ['label' => 'Diterima', 'icon' => 'fas fa-check-circle', 'color' => 'blue'],
                            'dalam_proses' => ['label' => 'Dalam Proses', 'icon' => 'fas fa-cog', 'color' => 'yellow'],
                            'selesai' => ['label' => 'Selesai', 'icon' => 'fas fa-flag-checkered', 'color' => 'green'],
                            'ditolak' => ['label' => 'Ditolak', 'icon' => 'fas fa-times-circle', 'color' => 'red']
                        ];
                        
                        $currentStatusIndex = array_search($pengaduan->status, array_keys($statuses));
                    @endphp
                    
                    @foreach($statuses as $key => $status)
                        @php
                            $statusIndex = array_search($key, array_keys($statuses));
                            $isActive = $key === $pengaduan->status;
                            $isPassed = $statusIndex <= $currentStatusIndex && $pengaduan->status !== 'ditolak';
                            $isRejected = $pengaduan->status === 'ditolak' && $key === 'ditolak';
                        @endphp
                        
                        <div class="flex flex-col items-center {{ $loop->last ? '' : 'flex-1' }}">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center mb-2 
                                {{ $isActive || $isPassed || $isRejected ? 'bg-' . $status['color'] . '-500 text-white' : 'bg-gray-200 text-gray-400' }}">
                                <i class="{{ $status['icon'] }}"></i>
                            </div>
                            <span class="text-sm font-medium {{ $isActive || $isPassed || $isRejected ? 'text-' . $status['color'] . '-600' : 'text-gray-400' }}">
                                {{ $status['label'] }}
                            </span>
                        </div>
                        
                        @if(!$loop->last && $pengaduan->status !== 'ditolak')
                            <div class="flex-1 h-1 mx-4 mt-6 mb-8 
                                {{ $isPassed ? 'bg-blue-500' : 'bg-gray-200' }}">
                            </div>
                        @endif
                    @endforeach
                </div>
                
                <div class="bg-{{ $pengaduan->status === 'selesai' ? 'green' : ($pengaduan->status === 'ditolak' ? 'red' : ($pengaduan->status === 'dalam_proses' ? 'yellow' : 'blue')) }}-50 
                           border border-{{ $pengaduan->status === 'selesai' ? 'green' : ($pengaduan->status === 'ditolak' ? 'red' : ($pengaduan->status === 'dalam_proses' ? 'yellow' : 'blue')) }}-200 
                           rounded-lg p-4">
                    <p class="text-{{ $pengaduan->status === 'selesai' ? 'green' : ($pengaduan->status === 'ditolak' ? 'red' : ($pengaduan->status === 'dalam_proses' ? 'yellow' : 'blue')) }}-800 font-medium">
                        Status saat ini: {{ $pengaduan->status_label }}
                    </p>
                    @if($pengaduan->keterangan_admin)
                        <p class="text-{{ $pengaduan->status === 'selesai' ? 'green' : ($pengaduan->status === 'ditolak' ? 'red' : ($pengaduan->status === 'dalam_proses' ? 'yellow' : 'blue')) }}-700 mt-2">
                            <strong>Keterangan Admin:</strong> {{ $pengaduan->keterangan_admin }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Detail Pengaduan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pengadu</label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $pengaduan->nama }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $pengaduan->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $pengaduan->kategori }}</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengaduan</label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $pengaduan->tanggal_pengaduan->format('d/m/Y H:i') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Unik</label>
                        <div class="flex items-center bg-gray-50 p-3 rounded-lg">
                            <code class="text-gray-900 font-mono flex-1">{{ $pengaduan->kode_unik }}</code>
                            <button onclick="copyKode('{{ $pengaduan->kode_unik }}')" class="ml-2 text-primary-500 hover:text-primary-700" title="Salin kode">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Pengaduan</label>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-900 whitespace-pre-wrap">{{ $pengaduan->deskripsi }}</p>
                </div>
            </div>

            <!-- Bukti Pendukung -->
            @if($pengaduan->bukti_pendukung && count($pengaduan->bukti_pendukung) > 0)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bukti Pendukung</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($pengaduan->bukti_pendukung as $file)
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex items-center">
                                    @php
                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                                    @endphp
                                    
                                    @if($isImage)
                                        <i class="fas fa-image text-blue-500 mr-2"></i>
                                    @else
                                        <i class="fas fa-file text-gray-500 mr-2"></i>
                                    @endif
                                    
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-900 truncate">{{ basename($file) }}</p>
                                        <a href="{{ Storage::url($file) }}" 
                                           target="_blank" 
                                           class="text-xs text-primary-600 hover:text-primary-700">
                                            Lihat file
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center pt-6 border-t border-gray-200">
                <a href="{{ route('pengaduan.track') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg text-center transition duration-200">
                    <i class="fas fa-search mr-2"></i>
                    Lacak Pengaduan Lain
                </a>
                <a href="{{ route('pengaduan.create') }}" 
                   class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-3 rounded-lg text-center transition duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Pengaduan Baru
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function copyKode(kode) {
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
