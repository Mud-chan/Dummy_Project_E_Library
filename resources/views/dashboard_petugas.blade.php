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
            <div class="book-card">
                <img src="../assets/images/miruko_vol_10.jpg" alt="Mieruko-chan" class="book-cover" />
                <div class="book-title">Mieruko-chan</div>
            </div>
        </div>

    </section>

     <div class="section-header">
            <h2>Buku Terbaru</h2>
        </div>

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

    <section class="trending-section">
            <button class="view-more-btn">View More</button>
    </section>
@endsection
