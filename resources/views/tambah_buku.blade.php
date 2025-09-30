@extends('components.petugasheader')
@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">

    <div class="content-header">
        <h1>Tambah Buku</h1>
    </div>

    <section class="form-container">
        <form action="{{ route('upload.buku') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="judul" class="form-field" placeholder="Judul Buku" required
                aria-label="Book title" />
            <input type="text" name="penulis" class="form-field" placeholder="Penulis" required
                aria-label="Author name" />
            <textarea name="deskripsi" class="form-field textarea-field" placeholder="Deskripsi" aria-label="Book description"></textarea>

            <!-- Upload cover buku -->
            <div class="file-upload">
                <label for="thumb">📂 Pilih Cover Buku</label>
                <input type="file" name="thumb" id="thumb" class="form-field" accept="image/*" required>
            </div>

            <div class="dropdown-row">
                <div class="dropdown-container">
                    <select name="kategori" class="dropdown-field" aria-label="Select category" required>
                        <option value="">Kategori</option>
                        <option value="novel">Novel</option>
                        <option value="manga">Manga</option>
                        <option value="manhwa">Manhwa</option>
                    </select>
                </div>

            </div>

            <div class="dropdown-row">
                <div class="dropdown-container">
                    <label for="genres">Genre</label>
                    <select name="genres[]" id="genres" class="dropdown-field" multiple required>
                        @foreach ($genreLists as $id => $tag)
                            <option value="{{ $id }}">{{ ucfirst($tag) }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">* Gunakan Ctrl / Command untuk pilih lebih dari satu</small>
                </div>
            </div>


            <button type="submit" class="submit-button">Tambah</button>
        </form>
    </section>
@endsection
