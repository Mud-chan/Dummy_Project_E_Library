@extends('components.pengunjungheader')
@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">
    <style>
        /* Book detail wrapper */
        .detail-wrapper {
            display: flex;
            flex-direction: column;
            gap: 30px;
            width: 100%;
        }

        .detail-card {
            position: relative;
            width: 100%;
            background-color: rgba(246, 231, 174, 0.4);
            border-radius: 20px;
            padding: 28px 20px;
            min-height: 200px;
        }

        .detail-cover {
            width: 120px;
            height: 180px;
            border-radius: 20px;
            margin: 0 auto 20px;
            display: block;
        }

        .detail-meta {
            text-align: center;
        }

        .detail-author {
            font-size: 16px;
            font-weight: 400;
            line-height: 23px;
            color: #000000;
            margin-bottom: 8px;
        }

        .detail-title {
            font-size: 28px;
            font-weight: 600;
            line-height: 36px;
            color: #000000;
            margin-bottom: 20px;
        }

        .detail-genres {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .genre-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 22px 6px 16px;
            background-color: #f6e7ae;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 400;
            line-height: 27px;
            color: #000000;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .genre-pill:hover {
            background-color: #f0d97a;
        }

        .fav-icon {
            position: absolute;
            top: 28px;
            right: 30px;
            width: 24px;
            height: 22px;
            cursor: pointer;
        }

        .stat-group {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .stat-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stat-img {
            width: 14px;
            height: 14px;
        }

        .stat-val {
            font-size: 16px;
            font-weight: 400;
            line-height: 28px;
            color: #000000;
        }

        /* Description */
        .desc-section {
            margin-top: 30px;
        }

        .desc-heading {
            font-size: 20px;
            font-weight: 600;
            line-height: 31px;
            color: #000000;
            margin-bottom: 14px;
        }

        .desc-text {
            font-size: 16px;
            font-weight: 300;
            line-height: 22px;
            text-align: justify;
            color: #000000;
        }

        /* Borrow history */
        .borrow-box {
            background-color: rgba(246, 231, 174, 0.4);
            border-radius: 20px;
            padding: 22px;
            margin-top: 30px;
        }

        .borrow-title {
            font-size: 20px;
            font-weight: 600;
            line-height: 31px;
            color: #000000;
            text-align: center;
            margin-bottom: 16px;
        }

        .borrow-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        .borrow-head {
            border-bottom: 1px solid #000000;
        }

        .borrow-head th {
            font-size: 14px;
            font-weight: 600;
            line-height: 21px;
            color: #000000;
            padding: 8px;
            text-align: left;
        }

        .borrow-row td {
            font-size: 14px;
            font-weight: 600;
            line-height: 21px;
            color: #000000;
            padding: 12px 8px;
            border-bottom: 1px solid #ddd;
        }
    </style>

    @if (session('success'))
        <div style="background: #d4edda; color:#155724; padding:10px; border-radius:8px; margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background: #f8d7da; color:#721c24; padding:10px; border-radius:8px; margin-bottom:15px;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Book Detail Section -->
    <section class="detail-wrapper">
        <div class="detail-card">
            <img src="{{ $book->thumb ? asset('uploaded_files/' . $book->thumb) : asset('assets/images/no-cover.png') }}"
                alt="Cover {{ $book->judul }}" class="detail-cover" />

            <div class="detail-meta">
                <p class="detail-author">{{ $book->penulis }}</p>
                <h1 class="detail-title">{{ $book->judul }}</h1>
                <div class="detail-genres">
                    @forelse ($book->genres as $genre)
                        <button class="genre-pill">{{ $genre->tag }}</button>
                    @empty
                        <span style="font-size:14px; color:#555;">Tidak ada genre</span>
                    @endforelse
                </div>


            </div>

            <img src="{{ asset('assets/images/love-svgrepo-com.svg') }}" alt="Tambah ke favorit" class="fav-icon" />

            <div class="stat-group">
                <div class="stat-box">
                    <img src="{{ asset('assets/images/love.svg') }}" alt class="stat-img" />
                    <span class="stat-val">{{ $book->bookmark->count() }}</span>
                </div>
                <div class="stat-box">
                    <img src="{{ asset('assets/images/eye.svg') }}" alt class="stat-img" />
                    <span class="stat-val">{{ $book->peminjaman->count() }}</span>
                </div>
            </div>
        </div>

        <!-- Synopsis -->
        <div class="desc-section">
            <h2 class="desc-heading">Sinopsis</h2>
            <p class="desc-text">
                {{ $book->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}
            </p>
        </div>
        @php
            $userId = Auth::id();
            $pinjamAktif = $book->peminjaman->where('id_pengunjung', $userId)->where('status', 'dipinjam')->first();
        @endphp

        <form action="{{ route('buku.pinjam', $book->id_buku) }}" method="POST">
            @csrf
            <button type="submit" class="submit-button"
                style="background-color: {{ $pinjamAktif ? '#ccc' : '#f6e7ae' }}; color: {{ $pinjamAktif ? '#555' : '#000' }};">
                {{ $pinjamAktif ? 'Kembalikan' : 'Pinjam' }}
            </button>
        </form>

    </section>
@endsection
