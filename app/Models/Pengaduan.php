<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'kode_unik',
        'nama',
        'email',
        'kategori',
        'deskripsi',
        'status',
        'bukti_pendukung',
        'tanggal_pengaduan',
        'keterangan_admin'
    ];

    protected $casts = [
        'bukti_pendukung' => 'array',
        'tanggal_pengaduan' => 'datetime',
    ];

    const STATUS_DITERIMA = 'diterima';
    const STATUS_DALAM_PROSES = 'dalam_proses';
    const STATUS_SELESAI = 'selesai';
    const STATUS_DITOLAK = 'ditolak';

    public static function getStatusOptions()
    {
        return [
            self::STATUS_DITERIMA => 'Diterima',
            self::STATUS_DALAM_PROSES => 'Dalam Proses',
            self::STATUS_SELESAI => 'Selesai',
            self::STATUS_DITOLAK => 'Ditolak',
        ];
    }

    public function getStatusLabelAttribute()
    {
        return self::getStatusOptions()[$this->status] ?? $this->status;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pengaduan) {
            $pengaduan->kode_unik = self::generateKodeUnik();
            $pengaduan->tanggal_pengaduan = now();
            $pengaduan->status = self::STATUS_DITERIMA;
        });
    }

    public static function generateKodeUnik()
    {
        do {
            $kode = 'PGD-' . strtoupper(Str::random(8));
        } while (self::where('kode_unik', $kode)->exists());

        return $kode;
    }
}
