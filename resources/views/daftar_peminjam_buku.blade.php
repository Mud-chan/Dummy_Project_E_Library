@extends('components.petugasheader')
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


    <section class="detail-wrapper">
        <div class="detail-card">
            <div class="detail-meta">
                <h1 class="detail-title">
                    <small style="font-size:18px; font-weight:400;">
                        (Buku Yang Tersedia: {{ $tersedia }})
                    </small>
                </h1>
            </div>

            <img src="{{ asset('assets/images/love-svgrepo-com.svg') }}" alt="Tambah ke favorit" class="fav-icon" />

        </div>

        <!-- Borrowing Section -->
        <div class="borrow-box">
            <h2 class="borrow-title">Daftar Peminjam</h2>
            <table class="borrow-table">
                <thead class="borrow-head">
                    <tr>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjaman as $pinjam)
                        <tr class="borrow-row">
                            <td>{{ $pinjam->user->name }} </td>
                            <td>({{ $pinjam->user->nohp }})</td>
                            <td>{{ $pinjam->buku->judul }}</td>
                            <td>{{ \Carbon\Carbon::parse($pinjam->tgl_pinjam)->format('d/m/Y') }}</td>
                            <td>{{ $pinjam->tgl_kembali ? \Carbon\Carbon::parse($pinjam->tgl_kembali)->format('d/m/Y') : '-' }}
                            </td>
                            <td>{{ ucfirst($pinjam->status) }}</td>
                            <td>
                                <form action="{{ route('peminjaman.destroy', $pinjam->id_peminjaman ) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background:#e3342f; color:white; padding:6px 12px; border:none; border-radius:6px; cursor:pointer;">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;">Belum ada data peminjaman</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

            <!-- Pagination -->
            <div style="margin-top: 15px; text-align:center;">
                {{ $peminjaman->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection
