<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|min:3|max:100',
            'email' => 'required|email|max:100',
            'kategori' => 'required|in:Fasilitas,Kehilangan,Keamanan,Kebersihan,Lainnya',
            'deskripsi' => 'required|string|min:10',
            'bukti_pendukung.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120'
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.min' => 'Nama minimal 3 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'kategori.required' => 'Kategori wajib dipilih',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter',
            'bukti_pendukung.*.mimes' => 'File harus berformat: jpg, jpeg, png, pdf, doc, docx',
            'bukti_pendukung.*.max' => 'Ukuran file maksimal 5MB'
        ]);

        $buktiPendukung = [];
        if ($request->hasFile('bukti_pendukung')) {
            foreach ($request->file('bukti_pendukung') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('bukti-pendukung', $filename, 'public');
                $buktiPendukung[] = $path;
            }
        }

        $pengaduan = Pengaduan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'bukti_pendukung' => $buktiPendukung,
        ]);

        return redirect()->route('pengaduan.success', $pengaduan->kode_unik);
    }

    public function success($kodeUnik)
    {
        $pengaduan = Pengaduan::where('kode_unik', $kodeUnik)->firstOrFail();
        return view('pengaduan.success', compact('pengaduan'));
    }

    public function track()
    {
        return view('pengaduan.track');
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'kode_unik' => 'required|string'
        ], [
            'kode_unik.required' => 'Kode unik wajib diisi'
        ]);

        $pengaduan = Pengaduan::where('kode_unik', $request->kode_unik)->first();

        if (!$pengaduan) {
            return back()->withErrors(['kode_unik' => 'Kode unik tidak ditemukan']);
        }

        return view('pengaduan.status', compact('pengaduan'));
    }
}
