@extends('components.petugasheader')
@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">

    <!-- Tombol Tambah -->
    <a href="{{ route('genre.tambah') }}" style="text-decoration: none;">
        <div class="sidebar-item">
            <img src="{{ asset('assets/images/plus-circle.svg') }}" alt="Tambah Genre" />
            <span>Tambah Genre</span>
        </div>
    </a>

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
                            <a href="{{ route('cari.buku', ['genre' => $tag->tag, 'kategori' => request('kategori')]) }}"
                                class="{{ (string) $genreDipilih === (string) $tag->tag ? 'active-item' : '' }}">
                                {{-- <span>{{ ucfirst($genre->tag) }}</span> --}}


                                <div class="tag" style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                                    <span>{{ $tag->tag }}</span>

                                    <!-- Tombol Edit -->
                                    <a href="{{ route('genre.edit', $tag->id_genre) }}"
                                        style="margin-left:10px; color:blue; text-decoration:none;">
                                        Edit
                                    </a>



                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('genre.hapus', $tag->id_genre) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus genre ini?')"
                                            style="color:red; background:none; border:none; cursor:pointer;">
                                            Hapus
                                        </button>
                                    </form>
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
