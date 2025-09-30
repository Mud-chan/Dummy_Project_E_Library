@extends('components.petugasheader')

@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">

    <div class="content-header">
        <h1>Edit Genre</h1>
    </div>

    <section class="form-container">
        {{-- tampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('genre.update', $genre->id_genre) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="tag" class="form-field" placeholder="Nama Genre"
                value="{{ old('tag', $genre->tag) }}" required aria-label="Genre name" />

            <button type="submit" class="submit-button">Simpan</button>
        </form>
    </section>
@endsection
