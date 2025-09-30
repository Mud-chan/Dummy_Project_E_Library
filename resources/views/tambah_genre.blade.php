@extends('components.petugasheader')

@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">

    <div class="content-header">
        <h1>Tambah Genre</h1>
    </div>

    <section class="form-container">
        <form action="{{ route('genre.store') }}" method="POST">
            @csrf

            <input type="text" name="tag" class="form-field" placeholder="Nama Genre" required aria-label="Genre name" />

            <button type="submit" class="submit-button">Tambah</button>
        </form>
    </section>
@endsection
