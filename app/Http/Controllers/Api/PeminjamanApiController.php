<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class PeminjamanApiController extends Controller
{
    public function riwayatPinjam()
    {
        $userId = Auth::id();

        // Ambil riwayat pinjaman yang sudah dikembalikan
        $riwayat = Peminjaman::with(['buku.genres'])
            ->where('id_pengunjung', $userId)
            ->where('status', 'dikembalikan')
            ->orderBy('tgl_kembali', 'desc')
            ->paginate(6);

        // Ubah data jadi hanya buku (seperti di blade aslinya)
        $books = $riwayat->getCollection()->pluck('buku');
        $riwayat->setCollection($books);

        return response()->json([
            'message' => 'Riwayat peminjaman berhasil diambil',
            'data'    => $riwayat,
        ]);
    }
}
