<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_unik')->unique();
            $table->string('nama', 100);
            $table->string('email', 100);
            $table->enum('kategori', ['Fasilitas', 'Kehilangan', 'Keamanan', 'Kebersihan', 'Lainnya']);
            $table->text('deskripsi');
            $table->enum('status', ['diterima', 'dalam_proses', 'selesai', 'ditolak'])->default('diterima');
            $table->json('bukti_pendukung')->nullable();
            $table->text('keterangan_admin')->nullable();
            $table->timestamp('tanggal_pengaduan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
