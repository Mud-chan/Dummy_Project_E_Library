@extends('components.petugasheader')
@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">
    <div class="sidebar-item">
        <img src="../assets/images/plus-circle.svg" alt="Settings icon" />
        <span>Tambah Buku</span>
    </div>
    <!-- Content Header -->
    <div class="content-header">
        <h1>Colection</h1>
    </div>

    <!-- Book Collection -->
    <section class="book-collection">
        <article class="book-item">
            <div class="book-content">
                <img src="../assets/images/miruko_vol_10.jpg" alt="La leyenda de la peregrina book cover"
                    class="book-image" />
                <div class="book-info">
                    <div class="book-header">
                        <div>
                            <div class="book-author">Izumi, Tomoki (Story & Art)</div>
                            <h2 class="book-title">Mieruko Chan</h2>
                        </div>
                        <div class="book-stats">
                            <div class="stat-item">
                                <img src="../assets/images/love.svg" alt="Likes" />
                                <span class="stat-text">363</span>
                            </div>
                            <div class="stat-item views">
                                <img src="../assets/images/eye.svg" alt="Views" />
                                <span class="stat-text">1.7k</span>
                            </div>
                        </div>
                    </div>
                    <p class="book-description">
                        Kisah horror dari gadis yang tau-tau bisa melihat mahkluk gaib disekitarnya
                    </p>
                    <div class="book-tags">
                        <div class="tag">
                            <img src="../assets/images/img_image_1.png" alt="Action tag" />
                            <span>Action</span>
                        </div>
                        <div class="tag">
                            <img src="../assets/images/img_image_11.png" alt="Historical tag" />
                            <span>Historical</span>
                        </div>
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
    </section>
@endsection
