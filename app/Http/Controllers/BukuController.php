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

class BukuController extends Controller
{

    private function authorizePetugas()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.')->send();
        }
        if (Auth::user()->role !== 'petugas') {
            abort(403, 'Anda tidak punya akses.');
        }
    }


    public function index()
    {
        $this->authorizePetugas();

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

        return view('dashboard_petugas', [
            "title"        => "Buku",
            "contents"     => $contents,
            "popularBooks" => $popularBooks,
            "genreList"    => $genreList,
        ]);
    }


    public function koleksi()
    {
        $this->authorizePetugas();

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

        return view('koleksi_petugas', [
            "title"    => "Buku",
            "contents" => $contents,
            "genreList"    => $genreList,
        ]);
    }



    public function show_tambah_buku()
    {
        $this->authorizePetugas();

        $genreList = Genre::select('tag')
            ->distinct()
            ->pluck('tag')
            ->filter() // hilangkan null/empty
            ->take(10)
            ->values();
        $genreLists = Genre::pluck('tag', 'id_genre');


        return view('tambah_buku', [
            "title"  => "Tambah Buku",
            "genres" => Genre::all(),
            "genreList"    => $genreList,
            "genreLists"    => $genreLists,
        ]);
    }


    public function upload_buku(Request $request)
    {
        $this->authorizePetugas();

        try {
            Log::info('Mulai upload buku', ['request' => $request->all()]);

            $request->validate([
                'judul'     => 'required|string|max:255',
                'penulis'   => 'required|string|max:255',
                'deskripsi' => 'nullable|string|max:1000',
                'kategori'  => 'required|string|max:100',
                'thumb'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
                'genres'    => 'required|array|min:1',
                'genres.*'  => 'exists:genre,id_genre',
            ]);

            Log::info('Validasi berhasil');

            $id         = uniqid("buku_");
            $id_petugas = Auth::id();
            $date       = now()->format('Y-m-d');

            // Upload cover
            $thumbName = null;
            if ($request->hasFile('thumb')) {
                $thumb     = $request->file('thumb');
                $thumbName = time() . '_' . uniqid() . '.' . $thumb->getClientOriginalExtension();
                $thumb->move(public_path('uploaded_files'), $thumbName);

                Log::info('File cover berhasil diupload', ['filename' => $thumbName]);
            } else {
                Log::warning('Tidak ada file cover yang diupload');
            }

            // Simpan buku
            $buku = Buku::create([
                'id_buku'      => $id,
                'id_petugas'   => $id_petugas,
                'judul'        => $request->judul,
                'penulis'      => $request->penulis,
                'deskripsi'    => $request->deskripsi,
                'kategori'     => $request->kategori,
                'thumb'        => $thumbName,
                'date_created' => $date,
            ]);

            Log::info('Data buku berhasil disimpan', ['buku' => $buku]);

            // Simpan pivot genres
            $buku->genres()->attach($request->genres);
            Log::info('Relasi genre berhasil ditambahkan', ['genres' => $request->genres]);

            return redirect()->route('koleksi.petugas')->with('success', 'Buku baru berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Upload Buku gagal', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Gagal menambahkan buku: ' . $e->getMessage());
        }
    }


    public function show_edit_buku($id_buku)
    {
        $this->authorizePetugas();

        $genreList = Genre::select('tag')
            ->distinct()
            ->pluck('tag')
            ->filter() // hilangkan null/empty
            ->take(10)
            ->values();

        $book   = Buku::with('genres')->findOrFail($id_buku);
        $genres = Genre::all();

        return view('edit_buku', [
            "title"  => "Edit Buku",
            "book"   => $book,
            "genres" => $genres,
            "genreList"    => $genreList,
        ]);
    }


    public function update_buku(Request $request, $id_buku)
    {
        $this->authorizePetugas();

        $request->validate([
            'judul'     => 'required|string|max:255',
            'penulis'   => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'kategori'  => 'required|string|max:100',
            'thumb'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
            'genres'    => 'required|array|min:1',
            'genres.*'  => 'exists:genre,id_genre',
        ]);

        try {
            $buku = Buku::findOrFail($id_buku);

            Log::info('Update Buku dimulai', [
                'id_buku' => $id_buku,
                'request' => $request->all()
            ]);

            // Update cover
            if ($request->hasFile('thumb')) {
                if ($buku->thumb && file_exists(public_path('uploaded_files/' . $buku->thumb))) {
                    unlink(public_path('uploaded_files/' . $buku->thumb));
                }
                $thumb     = $request->file('thumb');
                $thumbName = time() . '_' . uniqid() . '.' . $thumb->getClientOriginalExtension();
                $thumb->move(public_path('uploaded_files'), $thumbName);
                $buku->thumb = $thumbName;
            }

            $buku->update([
                'judul'     => $request->judul,
                'penulis'   => $request->penulis,
                'deskripsi' => $request->deskripsi,
                'kategori'  => $request->kategori,
                'thumb'     => $buku->thumb,
            ]);

            // Update pivot
            $buku->genres()->sync($request->genres);

            Log::info('Update Buku berhasil', [
                'id_buku' => $id_buku,
                'genres'  => $request->genres
            ]);

            return redirect()->route('koleksi.petugas')->with('success', 'Buku berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Update Buku gagal', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Gagal memperbarui buku: ' . $e->getMessage());
        }
    }



    public function delete_buku($id_buku)
    {
        $this->authorizePetugas();

        try {
            $buku = Buku::findOrFail($id_buku);

            if ($buku->thumb && file_exists(public_path('uploaded_files/' . $buku->thumb))) {
                unlink(public_path('uploaded_files/' . $buku->thumb));
            }

            $buku->genres()->detach();
            Peminjaman::where('id_buku', $id_buku)->delete();
            Bookmark::where('id_buku', $id_buku)->delete();
            Rating::where('id_buku', $id_buku)->delete();

            $buku->delete();

            return redirect()->route('koleksi.petugas')->with('success', 'Buku berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Delete Buku gagal', ['error' => $e->getMessage()]);
            return back()->with('error', 'Gagal menghapus buku: ' . $e->getMessage());
        }
    }


    public function detail_buku($id_buku)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $genreList = Genre::select('tag')
            ->distinct()
            ->pluck('tag')
            ->filter()
            ->take(10)
            ->values();

        try {
            $buku = Buku::with(['genres', 'rating', 'bookmark', 'peminjaman.user'])
                ->findOrFail($id_buku);

            // hanya ambil peminjaman yang masih aktif (status = dipinjam)
            $peminjamanAktif = $buku->peminjaman->where('status', 'dipinjam');

            return view('detail_buku_petugas', [
                "title"      => "Detail Buku",
                "book"       => $buku,
                "peminjaman" => $peminjamanAktif,
                "genreList"  => $genreList,
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
        $this->authorizePetugas();

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

    public function show_tambah_genre()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $genreList = Genre::select('tag')
            ->distinct()
            ->pluck('tag')
            ->filter()
            ->take(10)
            ->values();

        return view('tambah_genre', [
            'title'     => 'Tambah Genre',
            'genreList' => $genreList,
        ]);
    }

    public function genre_store(Request $request)
    {
        $request->validate([
            'tag' => 'required|string|max:100|unique:genre,tag',
        ]);

        $lastGenre = Genre::orderBy('id_genre', 'desc')->first();
        if ($lastGenre) {
            $lastNumber = (int) str_replace('genre_', '', $lastGenre->id_genre);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newId = 'genre_' . $newNumber;

        Genre::create([
            'id_genre' => $newId,
            'tag' => $request->tag,
        ]);

        return redirect()->route('genre.detail')->with('success', 'Genre berhasil ditambahkan!');
    }

    public function show_edit_genre($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $genreList = Genre::select('tag')
            ->distinct()
            ->pluck('tag')
            ->filter()
            ->take(10)
            ->values();

        $genre = Genre::findOrFail($id);
        return view('edit_genre', [
            'title'     => 'Tambah Genre',
            'genreList' => $genreList,
            'genre'     => $genre
        ]);
    }

    public function genre_update(Request $request, $id)
    {
        $request->validate([
            'tag' => 'required|string|max:100|unique:genre,tag,' . $id . ',id_genre',
        ]);

        $genre = Genre::findOrFail($id);
        $genre->update([
            'tag' => $request->tag,
        ]);

        return redirect()->route('genre.detail')->with('success', 'Genre berhasil diperbarui!');
    }

    public function hapus_genre($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('genre.detail')->with('success', 'Genre berhasil dihapus!');
    }
    public function show_detail_peminjaman()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $genreList = Genre::select('tag')
            ->distinct()
            ->pluck('tag')
            ->filter()
            ->take(10)
            ->values();

        try {
            // 🔹 Ambil semua data peminjaman dengan relasi user & buku
            $peminjaman = Peminjaman::with(['user', 'buku'])
                ->orderBy('tgl_pinjam', 'DESC')
                ->paginate(20);

            // 🔹 Hitung jumlah buku yang tersedia (tidak dipinjam / sudah dikembalikan)
            $tersedia = Peminjaman::where(function ($q) {
                $q->where('status', '!=', 'dipinjam')
                    ->orWhereNull('status');
            })
                ->distinct('id_buku')
                ->count();

            return view('daftar_peminjam_buku', [
                "title"      => "Daftar Semua Peminjam",
                "peminjaman" => $peminjaman,
                "tersedia"   => $tersedia,
                "genreList"  => $genreList,
            ]);
        } catch (\Exception $e) {
            Log::error('Daftar Peminjam gagal', [
                'error' => $e->getMessage()
            ]);
            return redirect()->route('koleksi.petugas')->with('error', 'Gagal membuka daftar peminjam');
        }
    }

    public function destroyPeminjaman($id)
    {
        try {
            $peminjaman = Peminjaman::findOrFail($id);
            $peminjaman->delete();

            return back()->with('success', 'Data peminjaman berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus peminjaman', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Gagal menghapus data peminjaman.');
        }
    }
}
