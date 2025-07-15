<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::query();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_pengaduan', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal_pengaduan', '<=', $request->tanggal_selesai);
        }

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('kode_unik', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $pengaduan = $query->orderBy('tanggal_pengaduan', 'desc')->paginate(10);

        // Statistik
        $stats = [
            'total' => Pengaduan::count(),
            'diterima' => Pengaduan::where('status', Pengaduan::STATUS_DITERIMA)->count(),
            'dalam_proses' => Pengaduan::where('status', Pengaduan::STATUS_DALAM_PROSES)->count(),
            'selesai' => Pengaduan::where('status', Pengaduan::STATUS_SELESAI)->count(),
            'ditolak' => Pengaduan::where('status', Pengaduan::STATUS_DITOLAK)->count(),
        ];

        return view('admin.dashboard', compact('pengaduan', 'stats'));
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:diterima,dalam_proses,selesai,ditolak',
            'keterangan_admin' => 'nullable|string|max:500'
        ]);

        $pengaduan->update([
            'status' => $request->status,
            'keterangan_admin' => $request->keterangan_admin
        ]);

        return back()->with('success', 'Status pengaduan berhasil diperbarui');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        // Hapus file bukti pendukung
        if ($pengaduan->bukti_pendukung) {
            foreach ($pengaduan->bukti_pendukung as $file) {
                \Storage::disk('public')->delete($file);
            }
        }

        $pengaduan->delete();

        return back()->with('success', 'Pengaduan berhasil dihapus');
    }
}
