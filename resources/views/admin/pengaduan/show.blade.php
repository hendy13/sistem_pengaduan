@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}" 
           class="inline-flex items-center text-primary-600 hover:text-primary-700">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Dashboard
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-clipboard-check mr-2"></i>
                Detail Pengaduan: {{ $pengaduan->kode_unik }}
            </h1>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 m-6">
                <div class="flex">
                    <i class="fas fa-check-circle text-green-400 mt-0.5 mr-3"></i>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="p-6">
            <!-- Informasi Pengadu -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Informasi Pengadu</h2>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $pengaduan->nama }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $pengaduan->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $pengaduan->kategori }}
                        </span>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Informasi Pengaduan</h2>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Unik</label>
                        <code class="text-gray-900 bg-gray-50 p-3 rounded-lg block font-mono">{{ $pengaduan->kode_unik }}</code>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengaduan</label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $pengaduan->tanggal_pengaduan->format('d/m/Y H:i') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Saat Ini</label>
                        @php
                            $statusColors = [
                                'diterima' => 'bg-blue-100 text-blue-800',
                                'dalam_proses' => 'bg-yellow-100 text-yellow-800',
                                'selesai' => 'bg-green-100 text-green-800',
                                'ditolak' => 'bg-red-100 text-red-800'
                            ];
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$pengaduan->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $pengaduan->status_label }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Deskripsi Pengaduan</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-900 whitespace-pre-wrap">{{ $pengaduan->deskripsi }}</p>
                </div>
            </div>

            <!-- Bukti Pendukung -->
            @if($pengaduan->bukti_pendukung && count($pengaduan->bukti_pendukung) > 0)
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Bukti Pendukung</h2>
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
                                            <i class="fas fa-external-link-alt mr-1"></i>
                                            Lihat file
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Update Status -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-edit mr-2"></i>
                    Update Status Pengaduan
                </h2>
                
                <form method="POST" action="{{ route('admin.pengaduan.update-status', $pengaduan) }}" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="status" 
                                    name="status" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    required>
                                @foreach(\App\Models\Pengaduan::getStatusOptions() as $key => $label)
                                    <option value="{{ $key }}" {{ $pengaduan->status == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="keterangan_admin" class="block text-sm font-medium text-gray-700 mb-2">Keterangan Admin (Opsional)</label>
                            <textarea id="keterangan_admin" 
                                      name="keterangan_admin" 
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                      placeholder="Tambahkan keterangan jika diperlukan...">{{ $pengaduan->keterangan_admin }}</textarea>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-lg transition duration-200">
                            <i class="fas fa-save mr-2"></i>
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
