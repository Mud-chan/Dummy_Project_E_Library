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
                    <a href="{{ route('buku.detail', $buku->id_buku) }}">
                        <img src="{{ asset('uploaded_files/' . $buku->thumb) }}" alt="Cover {{ $buku->judul }}"
                            class="book-cover" />
                    </a>
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
                    <a href="{{ route('buku.detail', $book->id_buku) }}">
                        <img src="{{ asset('uploaded_files/' . $book->thumb) }}" alt="Cover {{ $book->judul }}"
                            class="book-image" />
                    </a>

                    <div class="book-info">
                        <div class="book-header">
                            <div>
                                <div class="book-author">{{ $book->penulis }}</div>
                                <h2 class="book-judul">{{ \Illuminate\Support\Str::limit($book->judul, 20, '...') }}</h2>
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

                        {{-- Tags Genre --}}
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


                        <div class="book-tags">
                            <a href="{{ route('edit.buku', $book->id_buku) }}" style="text-decoration: none;">
                                <div class="tag">
                                    <img src="{{ asset('assets/images/edit-fill-1480.svg') }}" alt="Edit Buku" />
                                    <span>Edit</span>
                                </div>
                            </a>

                            <div class="tag">
                                <form id="form-hapus-{{ $book->id_buku }}"
                                    action="{{ route('hapus.buku', $book->id_buku) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <img src="{{ asset('assets/images/trash-bin-trash.svg') }}" alt="Delete icon" />
                                    <span
                                        onclick="if(confirm('Yakin mau hapus buku ini?')) document.getElementById('form-hapus-{{ $book->id_buku }}').submit()"
                                        style="cursor:pointer; color:red;">
                                        Hapus
                                    </span>
                                </form>
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
