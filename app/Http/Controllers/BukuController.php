<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Log;

class BukuController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (Auth::user()->role !== 'petugas') {
            abort(403, 'Anda tidak punya akses.');
        }

        $contents = Buku::with(['genre'])
            ->withCount('peminjaman')
            ->orderBy('date_created', 'DESC')
            ->take(6)
            ->get();

        $popularBooks = Buku::withCount('peminjaman')
            ->orderBy('peminjaman_count', 'DESC')
            ->take(4)
            ->get();

        return view('dashboard_petugas', [
            "title"        => "Buku",
            "contents"     => $contents,
            "popularBooks" => $popularBooks,
        ]);
    }

    public function koleksi()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (Auth::user()->role !== 'petugas') {
            abort(403, 'Anda tidak punya akses.');
        }

        $contents = Buku::with(['genre'])
            ->withCount('peminjaman')
            ->orderBy('date_created', 'DESC')
            ->take(6)
            ->get();

        return view('koleksi_petugas', [
            "title"        => "Buku",
            "contents"     => $contents,
        ]);
    }

    public function show_tambah_buku()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (Auth::user()->role !== 'petugas') {
            abort(403, 'Anda tidak punya akses.');
        }

        return view('tambah_buku', [
            "title" => "Tambah Buku",
        ]);
    }

    public function upload_buku(Request $request)
    {
        if (!Auth::check()) {
            Log::warning('Upload Buku: User belum login.');
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (Auth::user()->role !== 'petugas') {
            Log::warning('Upload Buku: User tanpa akses mencoba upload', [
                'user_id' => Auth::id(),
                'role'    => Auth::user()->role,
            ]);
            abort(403, 'Anda tidak punya akses.');
        }

        // Validasi input
        try {
            $request->validate([
                'judul'     => 'required|string|max:255',
                'penulis'   => 'required|string|max:255',
                'deskripsi' => 'nullable|string|max:1000',
                'kategori'  => 'required|string|max:100',
                'thumb'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
                'genre1'    => 'required|string|max:100', // genre1 wajib
                'genre2'    => 'nullable|string|max:100',
                'genre3'    => 'nullable|string|max:100',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Upload Buku: Validasi gagal', [
                'errors' => $e->errors(),
                'input'  => $request->all(),
            ]);
            throw $e;
        }

        try {
            $id = uniqid("buku_");
            $id_petugas = Auth::id();
            $date = now()->format('Y-m-d');

            // Upload cover buku
            $thumbName = null;
            if ($request->hasFile('thumb')) {
                $thumb = $request->file('thumb');
                $thumbName = time() . '_' . uniqid() . '.' . $thumb->getClientOriginalExtension();
                $thumb->move(public_path('uploaded_files'), $thumbName);
                Log::info('Upload Buku: Thumbnail berhasil diupload', ['file' => $thumbName]);
            }

            // Simpan ke tabel buku
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

            Log::info('Upload Buku: Buku berhasil disimpan', ['buku' => $buku]);

            // Simpan ke tabel genre
            $genres = [];

            if ($request->genre1 && strtolower($request->genre1) !== 'genre 1') {
                $genres[] = ['id_buku' => $id, 'genre' => $request->genre1];
            }
            if ($request->genre2 && strtolower($request->genre2) !== 'genre 2') {
                $genres[] = ['id_buku' => $id, 'genre' => $request->genre2];
            }
            if ($request->genre3 && strtolower($request->genre3) !== 'genre 3') {
                $genres[] = ['id_buku' => $id, 'genre' => $request->genre3];
            }

            if (!empty($genres)) {
                Genre::insert($genres);
                Log::info('Upload Buku: Genre berhasil disimpan', ['genre' => $genres]);
            }

            return redirect()->route('koleksi.petugas')->with('success', 'Buku baru berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Upload Buku: Gagal menambahkan buku', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
            ]);
            return redirect()->back()->with('error', 'Gagal menambahkan buku: ' . $e->getMessage());
        }
    }

    public function show_edit_buku($id_buku)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (Auth::user()->role !== 'petugas') {
            abort(403, 'Anda tidak punya akses.');
        }

        $book = Buku::with('genre')->findOrFail($id_buku);

        return view('edit_buku', [
            "title" => "Edit Buku",
            "book"  => $book
        ]);
    }


    public function update_buku(Request $request, $id_buku)
    {
        if (!Auth::check()) {
            Log::warning('Update Buku: User belum login.');
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (Auth::user()->role !== 'petugas') {
            Log::warning('Update Buku: User tanpa akses mencoba edit', [
                'user_id' => Auth::id(),
                'role'    => Auth::user()->role,
            ]);
            abort(403, 'Anda tidak punya akses.');
        }

        try {
            $request->validate([
                'judul'     => 'required|string|max:255',
                'penulis'   => 'required|string|max:255',
                'deskripsi' => 'nullable|string|max:1000',
                'kategori'  => 'required|string|max:100',
                'thumb'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
                'genre1'    => 'required|string|max:100',
                'genre2'    => 'nullable|string|max:100',
                'genre3'    => 'nullable|string|max:100',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Update Buku: Validasi gagal', [
                'errors' => $e->errors(),
                'input'  => $request->all(),
            ]);
            throw $e;
        }

        try {
            $buku = Buku::findOrFail($id_buku);

            // update thumbnail
            if ($request->hasFile('thumb')) {
                // hapus file lama
                if ($buku->thumb && file_exists(public_path('uploaded_files/' . $buku->thumb))) {
                    unlink(public_path('uploaded_files/' . $buku->thumb));
                }

                $thumb = $request->file('thumb');
                $thumbName = time() . '_' . uniqid() . '.' . $thumb->getClientOriginalExtension();
                $thumb->move(public_path('uploaded_files'), $thumbName);

                $buku->thumb = $thumbName;
            }

            // update data buku
            $buku->update([
                'judul'     => $request->judul,
                'penulis'   => $request->penulis,
                'deskripsi' => $request->deskripsi,
                'kategori'  => $request->kategori,
            ]);

            // hapus genre lama → insert baru
            Genre::where('id_buku', $id_buku)->delete();

            $genres = [];
            if ($request->genre1 && strtolower($request->genre1) !== 'genre 1') {
                $genres[] = ['id_buku' => $id_buku, 'genre' => $request->genre1];
            }
            if ($request->genre2 && strtolower($request->genre2) !== 'genre 2') {
                $genres[] = ['id_buku' => $id_buku, 'genre' => $request->genre2];
            }
            if ($request->genre3 && strtolower($request->genre3) !== 'genre 3') {
                $genres[] = ['id_buku' => $id_buku, 'genre' => $request->genre3];
            }

            if (!empty($genres)) {
                Genre::insert($genres);
            }

            Log::info('Update Buku: Buku berhasil diperbarui', ['buku' => $buku, 'genres' => $genres]);

            return redirect()->route('koleksi.petugas')->with('success', 'Buku berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Update Buku: Gagal update buku', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
            ]);
            return redirect()->back()->with('error', 'Gagal memperbarui buku: ' . $e->getMessage());
        }
    }

    public function delete_buku($id_buku)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (Auth::user()->role !== 'petugas') {
            abort(403, 'Anda tidak punya akses.');
        }

        try {
            $buku = Buku::findOrFail($id_buku);

            // Hapus file thumbnail kalau ada
            if ($buku->thumb && file_exists(public_path('uploaded_files/' . $buku->thumb))) {
                unlink(public_path('uploaded_files/' . $buku->thumb));
            }

            // Hapus relasi terkait
            Peminjaman::where('id_buku', $id_buku)->delete();
            Genre::where('id_buku', $id_buku)->delete();
            Bookmark::where('id_buku', $id_buku)->delete();
            Rating::where('id_buku', $id_buku)->delete();

            // Hapus buku
            $buku->delete();

            Log::info('Delete Buku: Buku berhasil dihapus', ['id_buku' => $id_buku]);

            return redirect()->route('koleksi.petugas')->with('success', 'Buku berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Delete Buku: Gagal menghapus buku', [
                'id_buku' => $id_buku,
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Gagal menghapus buku: ' . $e->getMessage());
        }
    }
}
