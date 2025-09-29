@extends('components.petugasheader')
@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">
    <a href="{{ route('tambah.buku') }}" style="text-decoration: none;">
        <div class="sidebar-item">
            <img src="../assets/images/plus-circle.svg" alt="Settings icon" />
            <span>Tambah Buku</span>
        </div>
    </a>
    <!-- Content Header -->
    <div class="content-header">
        <h1>Colection</h1>
    </div>

    <!-- Book Collection -->
    <section class="book-collection">
        @foreach ($contents as $book)
            <article class="book-item">

                <div class="book-content">
                    <img src="../uploaded_files/{{ $book->thumb }}" alt="La leyenda de la peregrina book cover"
                        class="book-image" />
                    <div class="book-info">
                        <div class="book-header">
                            <div>
                                <div class="book-author">{{ $book->penulis }}</div>
                                <h2 class="book-judul">{{ \Illuminate\Support\Str::limit($book->judul, 20, '...') }}</h2>
                            </div>
                            <div class="book-stats">
                                <div class="stat-item">
                                    <img src="../assets/images/love.svg" alt="Likes" />
                                    <span class="stat-text">363</span>
                                </div>
                                <div class="stat-item views">
                                    <img src="../assets/images/eye.svg" alt="Views" />
                                    <span class="stat-text">{{ $book->peminjaman_count }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="book-description">
                            {{ \Illuminate\Support\Str::limit($book->deskripsi, 100, '...') }}
                        </p>
                        <div class="book-tags">
                            @foreach ($book->genre as $tag)
                                <div class="tag">
                                    <img src="../assets/images/img_image_1.png" alt="{{ $tag->genre }} tag" />
                                    <span>{{ $tag->genre }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="book-tags">
                            <div class="tag">
                                <img src="../assets/images/edit-fill-1480.svg" alt="Action tag" />
                                <span>Edit</span>
                            </div>
                            <div class="tag">
                                <img src="../assets/images/trash-bin-trash.svg" alt="Historical tag" />
                                <span>Hapus</span>
                            </div>
                        </div>
                    </div>
                </div>

            </article>
        @endforeach
    </section>
@endsection
