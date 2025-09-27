<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Library</title>
l <rel rel="icon" href="../assets/images/img_cover.svg">
  <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
<script type="module" src="https://static.rocket.new/rocket-web.js?_cfg=https%3A%2F%2Fyukarisa7296back.builtwithrocket.new&_be=https%3A%2F%2Fapplication.rocket.new&_v=0.1.8"></script>
</head>
<body>
  <main class="main-container">
    <!-- Header Section -->
    <header class="header-container">
      <div class="header-content">
        <div class="logo-section">
          <img src="../assets/images/img_cover.svg" alt="Logo" class="logo-image" />
          <span class="logo-text">E-Library</span>
        </div>

        <nav class="nav-menu" role="navigation">
          <a href="#features" class="nav-link active">Feature</a>
          <a href="#location" class="nav-link">Location</a>
        </nav>

        <button class="login-btn" onclick="window.location='{{ url('/login') }}'">Login</button>
      </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
      <img src="../assets/images/img_cover.svg" alt="Hero Background" class="hero-background" />

      <div class="hero-content">
        <div class="hero-text-section">
          <h1 class="hero-title">
            Cari & Pinjam<br />
            <span class="highlight">Buku </span>Favorite<br />
            Dengan Mudah!
          </h1>

          <p class="hero-description">
            Temukan, cari, ulas, dan pinjam buku favorit Anda dengan mudah melalui platform perpustakaan digital revolusioner kami. Pinjaman cepat
          </p>

          <button class="cta-button" onclick="window.location='{{ url('/login') }}'">Start now →</button>
        </div>

        <div class="hero-books">
          <div class="book-grid">
            <img src="../assets/images/img_dompet_ayah_sepatu.png" alt="Dompet Ayah Sepatu Book" class="book-item large" />
            <img src="../assets/images/img_talking_to_strangers.png" alt="Talking to Strangers Book" class="book-item" />
            <img src="../assets/images/img_the_midnight_library.png" alt="The Midnight Library Book" class="book-item" />
            <img src="../assets/images/img_the_visual_mba.png" alt="The Visual MBA Book" class="book-item" />
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
      <div class="content-wrapper">
        <div class="section-header">
          <span class="section-label">FEATURES</span>
          <h2 class="section-title">🤔• Apa yang Dapat Anda Lakukan?</h2>
        </div>

        <div class="features-grid">
          <article class="feature-card">
            <div class="feature-icon">
              <img src="../assets/images/img_frame.svg" alt="Search Icon" />
            </div>
            <h3 class="feature-title">Cari Buku</h3>
            <p class="feature-description">
              Temukan bacaan Anda berikutnya dengan mudah dengan pencarian buku kami yang canggih dan intuitif.
            </p>
          </article>

          <article class="feature-card">
            <div class="feature-icon">
              <img src="../assets/images/img_frame_white_a700.svg" alt="Review Icon" />
            </div>
            <h3 class="feature-title">Pinjam Buku</h3>
            <p class="feature-description">
                Nikmati kemudahan meminjam buku favorit Anda kapan saja, di mana saja, tanpa repot.
            </p>
          </article>

          <article class="feature-card">
            <div class="feature-icon">
              <img src="../assets/images/img_frame_white_a700_44x44.svg" alt="Wishlist Icon" />
            </div>
            <h3 class="feature-title">Wishlist Buku</h3>
            <p class="feature-description">
                Simpan buku yang Anda minati ke dalam wishlist pribadi untuk akses cepat di masa mendatang.
            </p>
          </article>
        </div>
      </div>
    </section>

    <!-- Location Section -->
    <section id="location" class="location-section">
      <div class="content-wrapper">
        <div class="section-header">
          <span class="section-label">LOCATION</span>
          <h2 class="section-title">🗺• Our Library Location</h2>
        </div>

        <div class="map-container">
          <iframe title="Library Location Map" src="https://www.openstreetmap.org/export/embed.html?bbox=-74.0059,40.7128,-73.9352,40.7589&layer=mapnik" class="map-iframe" allowFullScreen loading="lazy">
          </iframe>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer-section">
    <div class="content-wrapper">
      <div class="footer-content">
        <div class="footer-brand">
          <h3 class="footer-brand-title">Managed By</h3>
          <img src="../assets/images/logo_bawah.png" alt="Logo" class="footer-logo" />
        </div>

        <div class="footer-social">
          <h3 class="social-title">Social Media</h3>
          <div class="social-icons">
            <img src="../assets/images/img_twitter.svg" alt="Twitter" class="social-icon" />
            <img src="../assets/images/img_instagram.svg" alt="Instagram" class="social-icon" />
            <img src="../assets/images/img_facebook.svg" alt="Facebook" class="social-icon" />
          </div>
        </div>

        <div class="footer-slogan">
          <h3 class="slogan-title">Slogan</h3>
          <p class="slogan-text">#RentFavBooks</p>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p class="footer-copyright">© 2025 Pramudya. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
