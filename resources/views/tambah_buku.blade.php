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

                <div class="dropdown-container">
                    <select name="genre2" class="dropdown-field" aria-label="Select genre 2">
                        <option value="">Genre 2</option>
                        <option value="action">Action</option>
                        <option value="adventure">Adventure</option>
                        <option value="horror">Horror</option>
                        <option value="mystery">Mystery</option>
                        <option value="fantasy">Fantasy</option>
                    </select>
                </div>
            </div>

            <div class="dropdown-row">
                <div class="dropdown-container">
                    <select name="genre1" class="dropdown-field" aria-label="Select genre 1" required>
                        <option value="">Genre 1</option>
                        <option value="action">Action</option>
                        <option value="adventure">Adventure</option>
                        <option value="horror">Horror</option>
                        <option value="mystery">Mystery</option>
                        <option value="fantasy">Fantasy</option>
                    </select>
                </div>

                <div class="dropdown-container">
                    <select name="genre3" class="dropdown-field" aria-label="Select genre 3">
                        <option value="">Genre 3</option>
                        <option value="action">Action</option>
                        <option value="adventure">Adventure</option>
                        <option value="horror">Horror</option>
                        <option value="mystery">Mystery</option>
                        <option value="fantasy">Fantasy</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="submit-button">Tambah</button>
        </form>
    </section>
@endsection
