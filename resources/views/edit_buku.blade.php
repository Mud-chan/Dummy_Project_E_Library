@extends('components.petugasheader')
@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">

    <div class="content-header">
        <h1>Edit Buku</h1>
    </div>

    <section class="form-container">
        <form onsubmit="handleSubmit(event)">
            <input type="text" class="form-field" placeholder="Judul Buku" required aria-label="Book title" />
            <input type="text" class="form-field" placeholder="Penulis" required aria-label="Author name" />
            <textarea class="form-field textarea-field" placeholder="Deskripsi" aria-label="Book description"></textarea>
            <input type="text" class="form-field" placeholder="Penerbit" aria-label="Publisher" />

            <div class="dropdown-row">
                <div class="dropdown-container">
                    <select class="dropdown-field" aria-label="Select category">
                        <option value>Kategori</option>
                        <option value="novel">Novel</option>
                        <option value="manga">Manga</option>
                        <option value="manhwa">Manhwa</option>
                    </select>

                </div>

                <div class="dropdown-container">
                    <select class="dropdown-field" aria-label="Select genre 2">
                        <option value>Genre 2</option>
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
                    <select class="dropdown-field" aria-label="Select genre 1">
                        <option value>Genre 1</option>
                        <option value="action">Action</option>
                        <option value="adventure">Adventure</option>
                        <option value="horror">Horror</option>
                        <option value="mystery">Mystery</option>
                        <option value="fantasy">Fantasy</option>
                    </select>

                </div>

                <div class="dropdown-container">
                    <select class="dropdown-field" aria-label="Select genre 3">
                        <option value>Genre 3</option>
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
