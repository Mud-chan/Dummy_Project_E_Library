@extends('components.petugasheader')
@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">

    <style>
        .thumb-wrapper {
            position: relative;
            width: 180px;
            height: 250px;
            margin: 0 auto 20px auto;
            cursor: pointer;
        }

        .thumb-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #ddd;
        }

        .thumb-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 8px;
            font-weight: bold;
            font-size: 18px;
        }

        .thumb-wrapper:hover .thumb-overlay {
            opacity: 1;
        }

        .thumb-input {
            display: none;
        }
    </style>

    <div class="content-header">
        <h1>Edit Buku</h1>
    </div>

    <section class="form-container">
        <form action="{{ route('update.buku', $book->id_buku) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="thumb-wrapper" onclick="document.getElementById('thumb').click()">
                <img src="{{ $book->thumb ? asset('uploaded_files/' . $book->thumb) : asset('assets/images/no-cover.png') }}"
                    alt="Thumbnail" id="thumbPreview">
                <div class="thumb-overlay">Edit</div>
            </div>
            <input type="file" name="thumb" id="thumb" class="thumb-input" accept="image/*"
                onchange="previewThumb(event)">

            <input type="text" name="judul" class="form-field" placeholder="Judul Buku"
                value="{{ old('judul', $book->judul) }}" required aria-label="Book title" />

            <input type="text" name="penulis" class="form-field" placeholder="Penulis"
                value="{{ old('penulis', $book->penulis) }}" required aria-label="Author name" />

            <textarea name="deskripsi" class="form-field textarea-field" placeholder="Deskripsi" aria-label="Book description">{{ old('deskripsi', $book->deskripsi) }}</textarea>

            <div class="dropdown-row">
                <div class="dropdown-container">
                    <select name="kategori" class="dropdown-field" aria-label="Select category" required>
                        <option value="">Kategori</option>
                        <option value="novel" {{ $book->kategori == 'novel' ? 'selected' : '' }}>Novel</option>
                        <option value="manga" {{ $book->kategori == 'manga' ? 'selected' : '' }}>Manga</option>
                        <option value="manhwa" {{ $book->kategori == 'manhwa' ? 'selected' : '' }}>Manhwa</option>
                    </select>
                </div>

                <div class="dropdown-container">
                    <label for="genres">Genre</label>
                    <select name="genres[]" id="genres" class="dropdown-field" multiple required>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id_genre }}"
                                {{ in_array($genre->id_genre, $book->genres->pluck('id_genre')->toArray()) ? 'selected' : '' }}>
                                {{ ucfirst($genre->tag) }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">* Gunakan Ctrl / Command untuk pilih lebih dari satu</small>
                </div>

            </div>

            <button type="submit" class="submit-button">Simpan Perubahan</button>

        </form>
    </section>

    <script>
        function previewThumb(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('thumbPreview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
