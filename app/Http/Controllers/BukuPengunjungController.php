<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Bookmark;
use App\Models\Detail_buku;

class BukuPengunjungController extends Controller
{

    private function authorizePengunjung()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.')->send();
        }
        if (Auth::user()->role !== 'pengunjung') {
            abort(403, 'Anda tidak punya akses.');
        }
    }

    public function index()
    {
        $this->authorizePengunjung();

        $contents = Buku::with('genres')
            ->withCount('peminjaman')
            ->orderBy('date_created', 'DESC')
            ->take(3)
            ->get();

        $popularBooks = Buku::withCount('peminjaman')
            ->orderBy('peminjaman_count', 'DESC')
            ->take(4)
            ->get();

        $genreList = Genre::select('tag')
            ->distinct()
            ->pluck('tag')
            ->filter() // hilangkan null/empty
            ->take(10)
            ->values();

        return view('dashboard_pengunjung', [
            "title"        => "Buku",
            "contents"     => $contents,
            "popularBooks" => $popularBooks,
            "genreList"    => $genreList,
        ]);
    }

    public function koleksi()
    {
        $this->authorizePengunjung();

        $contents = Buku::with('genres') // <- ini relasi yg benar
            ->withCount('peminjaman')
            ->orderBy('date_created', 'DESC')
            ->paginate(6);
        $genreList = Genre::select('tag')
            ->distinct()
            ->pluck('tag')
            ->filter() // hilangkan null/empty
            ->take(10)
            ->values();

        return view('koleksi_pengunjung', [
            "title"    => "Buku",
            "contents" => $contents,
            "genreList"    => $genreList,
        ]);
    }

    public function detail_buku($id_buku)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $genreList = Genre::select('tag')
            ->distinct()
            ->pluck('tag')
            ->filter() // hilangkan null/empty
            ->take(10)
            ->values();

        try {
            $buku = Buku::with(['genres', 'rating', 'bookmark', 'peminjaman.user'])
                ->findOrFail($id_buku);

            return view('detail_buku_petugas', [
                "title"      => "Detail Buku",
                "book"       => $buku,
                "peminjaman" => $buku->peminjaman,
                "genreList"    => $genreList,
            ]);
        } catch (\Exception $e) {
            Log::error('Detail Buku gagal', [
                'id_buku' => $id_buku,
                'error'   => $e->getMessage()
            ]);
            return redirect()->route('koleksi.petugas')->with('error', 'Gagal membuka detail buku');
        }
    }

    public function cari_buku(Request $request)
    {
        $this->authorizePengunjung();

        $query = Buku::with('genres')
            ->withCount('peminjaman')
            ->orderBy('date_created', 'DESC');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('genre')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('tag', $request->genre); // pastikan kolomnya sesuai di tabel `genre`
            });
        }

        $genreList = Genre::select('tag')
            ->distinct()
            ->pluck('tag')
            ->filter() // hilangkan null/empty
            ->take(10)
            ->values();

        $contents = $query->get();

        return view('cari_buku_petugas', [
            "title"    => "Cari Buku",
            "contents" => $contents,
            "genreList"    => $genreList,
        ]);
    }

    public function show_genre()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $genres = Genre::orderBy('tag', 'asc')->paginate(10);

        $genreList = Genre::select('tag')
            ->distinct()
            ->pluck('tag')
            ->filter()
            ->take(10)
            ->values();

        return view('detail_genre_petugas', [
            'title'     => 'Daftar Genre',
            'genres'    => $genres,
            'genreList' => $genreList,
        ]);
    }

}
