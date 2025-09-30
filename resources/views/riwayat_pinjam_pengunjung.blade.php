@extends('components.pengunjungheader')
@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">

    <div class="content-header">
        <h1>{{ $title }}</h1>
    </div>

    <section class="book-collection">
        @forelse ($contents as $book)
            <article class="book-item">
                <div class="book-content">
                    <a href="{{ route('buku.detail.pengunjung', $book->id_buku) }}">
                        <img src="{{ $book->thumb ? asset('uploaded_files/' . $book->thumb) : asset('assets/images/no-cover.png') }}"
                            alt="Cover {{ $book->judul }}" class="book-image" />
                    </a>

                    <div class="book-info">
                        <div class="book-header">
                            <div>
                                <div class="book-author">{{ $book->penulis }}</div>
                                <h2 class="book-judul">
                                    {{ \Illuminate\Support\Str::limit($book->judul, 20, '...') }}
                                </h2>
                            </div>
                            <div class="book-stats">
                                <div class="stat-item views">
                                    <img src="{{ asset('assets/images/eye.svg') }}" alt="Views" />
                                    <span class="stat-text">{{ $book->peminjaman->count() }}</span>
                                </div>
                            </div>
                        </div>

                        <p class="book-description">
                            {{ \Illuminate\Support\Str::limit($book->deskripsi, 100, '...') }}
                        </p>

                        <div class="book-tags">
                            @foreach ($book->genres as $tag)
                                <span class="tag">{{ $tag->tag }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <p style="text-align:center; margin-top:20px;">Belum ada riwayat peminjaman.</p>
        @endforelse
    </section>

    <div class="pagination-container">
        {{ $contents->onEachSide(1)->links('pagination::simple-bootstrap-5') }}
    </div>
@endsection
