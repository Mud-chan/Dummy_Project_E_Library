@extends('components.pengunjungheader')
@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">


    <!-- Content Header -->
    <div class="content-header">
        <h1>{{ $title }}</h1>
    </div>

    <!-- Book Collection -->
    <section class="book-collection">
        @forelse ($contents as $book)
            <article class="book-item">
                <div class="book-content">
                    <a href="{{ route('buku.detail.pengunjung', $book->id_buku) }}">
                        <img src="{{ asset('uploaded_files/' . $book->thumb) }}" alt="Cover {{ $book->judul }}"
                            class="book-image" />
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
                                <div class="stat-item">
                                    <img src="{{ asset('assets/images/love.svg') }}" alt="Likes" />
                                    <span class="stat-text">363</span>
                                </div>
                                <div class="stat-item views">
                                    <img src="{{ asset('assets/images/eye.svg') }}" alt="Views" />
                                    <span class="stat-text">{{ $book->peminjaman_count }}</span>
                                </div>
                            </div>
                        </div>

                        <p class="book-description">
                            {{ \Illuminate\Support\Str::limit($book->deskripsi, 100, '...') }}
                        </p>

                        <div class="book-tags">
                            @foreach ($book->genres as $tag)
                                <a href="{{ route('cari.buku', ['genre' => $tag->tag, 'kategori' => request('kategori')]) }}"
                                    class="tag" style="text-decoration:none;">
                                    <img src="{{ asset('assets/images/img_image_1.png') }}"
                                        alt="{{ $tag->tag }} tag" />
                                    <span>{{ $tag->tag }}</span>
                                </a>
                            @endforeach
                        </div>

                    </div>
                </div>
            </article>
        @empty
            <p>Tidak ada buku ditemukan.</p>
        @endforelse
    </section>
@endsection
