@extends('components.pengunjungheader')
@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">

    <!-- Content Header -->
    <div class="content-header">
        <h1>{{ $title }}</h1>
    </div>

    <!-- Daftar Genre -->
    <section class="book-collection">
        <article class="book-item">
            <div class="book-content">
                <div class="book-info">
                    <div class="book-tags">
                        @php
                            $genreDipilih = request('genre');
                        @endphp

                        @forelse ($genres as $tag)
                            <a href="{{ route('cari.buku.pengunjung', ['genre' => $tag->tag, 'kategori' => request('kategori')]) }}"
                                class="{{ (string) $genreDipilih === (string) $tag->tag ? 'active-item' : '' }}">
                                <div class="tag" style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                                    <span>{{ $tag->tag }}</span>
                                </div>
                            @empty
                                <p style="text-align:center; margin-top:20px;">Belum ada genre tersedia.</p>
                        @endforelse
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </section>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $genres->onEachSide(1)->links('pagination::simple-bootstrap-5') }}
    </div>
@endsection
