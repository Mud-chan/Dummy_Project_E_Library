@extends('components.petugasheader')
@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">

    <!-- Popular Books Section -->
    <section>
        <div class="section-header">
            <h2>Buku Populer</h2>
            <span class="see-more">Lainnya</span>
        </div>

        <div class="books-grid">
            @foreach ($popularBooks as $buku)
                <div class="book-card">
                    <img src="../uploaded_files/{{ $buku->thumb }}" alt="Mieruko-chan" class="book-cover" />
                    <div class="book-title">{{ \Illuminate\Support\Str::limit($buku->judul, 20, '...') }}</div>
                </div>
            @endforeach


        </div>

    </section>

    <div class="section-header">
        <h2>Buku Terbaru</h2>
    </div>

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
                            <a href="{{ route('edit.buku', $book->id_buku) }}" style="text-decoration: none;">
                                <div class="tag">
                                    <img src="../assets/images/edit-fill-1480.svg" alt="Action tag" />
                                    <span>Edit</span>
                                </div>
                            </a>
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


    <section class="trending-section">
        <button class="view-more-btn">View More</button>
    </section>
@endsection
