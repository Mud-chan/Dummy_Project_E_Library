<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Library Collection | Digital Books & Reading Platform</title>
  <link rel="icon" href="../assets/images/img_cover.svg">
  <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">
<script type="module" src="https://static.rocket.new/rocket-web.js?_cfg=https%3A%2F%2Fmiyakoaiha5841back.builtwithrocket.new&_be=https%3A%2F%2Fapplication.rocket.new&_v=0.1.8"></script>
</head>
<body>
  <main class="main-container">
    <div class="content-wrapper">
      <!-- Left Sidebar -->
      <aside class="sidebar">
        <img src="../assets/images/img_sidebar_logo.png" alt="E-Library Logo" class="sidebar-logo" />

        <div class="sidebar-section">
          <h3>Kategori</h3>
          <nav class="sidebar-menu">
            <div class="menu-item">
              <img src="../assets/images/book.svg" alt="Novel icon" />
              <span>Novel</span>
            </div>
            <div class="menu-item">
              <img src="../assets/images/book.svg" alt="Manga icon" />
              <span>Manga</span>
            </div>
            <div class="menu-item">
              <img src="../assets/images/book.svg" alt="Manhwa icon" />
              <span>Manhwa</span>
            </div>
          </nav>
        </div>

        {{-- <div class="genre-section">
          <h3>Genre</h3>
          <nav class="sidebar-menu">
            <div class="menu-item">
              <img src="../assets/images/img_image_1.png" alt="Action icon" />
              <span>Action</span>
            </div>
            <div class="menu-item">
              <img src="../assets/images/img_image_2.png" alt="Adventure icon" />
              <span>Adventure</span>
            </div>
            <div class="menu-item">
              <img src="../assets/images/img_image_3.png" alt="Horror icon" />
              <span>Horor</span>
            </div>
            <div class="menu-item">
              <img src="../assets/images/img_image_4.png" alt="Mystery icon" />
              <span>Misteri</span>
            </div>
            <div class="menu-item">
              <img src="../assets/images/img_image_5.png" alt="Fantasy icon" />
              <span>Fantasy</span>
            </div>
            <div class="menu-item">
              <img src="../assets/images/img_arrow_down.svg" alt="More options" />
              <span>Lainnya</span>
            </div>
          </nav>
        </div> --}}
      </aside>

      <!-- Main Content -->
      <div class="main-content">
        <!-- Header -->
        <header class="header">
          <button class="mobile-menu-btn" aria-label="Open menu">☰</button>

          <div class="search-container">
            <input type="search" class="search-input" placeholder="Cari Buku" aria-label="Search books" />
            <img src="../assets/images/img_searchicon.svg" alt="Search" class="search-icon" />
          </div>

          <nav class="header-nav">
            <a href="#" class="nav-item">nama orang</a>
            <img src="../assets/images/miruko_vol_10.jpg" alt="User avatar" class="user-avatar" />
          </nav>
        </header>

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
              <img src="../assets/images/miruko_vol_10.jpg" alt="La leyenda de la peregrina book cover" class="book-image" />
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
      </div>

      <!-- Right Sidebar -->
      <aside class="right-sidebar">
        <div class="sidebar-section">
          <button class="collection-btn">
            <img src="../assets/images/archives-document.svg" alt="Collection icon" />
            Colection
          </button>

          <div class="sidebar-item">
            <img src="../assets/images/basic-popular-statistic.svg" alt="Statistics icon" />
            <span>Statistik</span>
          </div>

          <div class="sidebar-item">
            <img src="../assets/images/bookmark.svg" alt="Settings icon" />
            <span>Bookmark</span>
          </div>

          <div class="sidebar-item">
            <img src="../assets/images/setting-setting.svg" alt="Settings icon" />
            <span>Peminjaman</span>
          </div>

          <div class="sidebar-item">
            <img src="../assets/images/setting-setting.svg" alt="Settings icon" />
            <span>User</span>
          </div>
        </div>

        <div class="sidebar-section">
          <div class="filter-header">
            <h2>Filter</h2>
            <a href="#" class="view-all">Lainnya</a>
          </div>

          <div class="sidebar-item">
            <img src="../assets/images/img_image_3.png" alt="Reading icon" />
            <span>Horor</span>
          </div>

          <div class="sidebar-item">
            <img src="../assets/images/img_image_1.png" alt="Action icon" />
            <span>Action</span>
          </div>

          <div class="sidebar-item">
            <img src="../assets/images/img_image_1.png" alt="Action icon" />
            <span>Fantasi</span>
          </div>

          <div class="sidebar-item">
            <img src="../assets/images/img_image_1.png" alt="Action icon" />
            <span>Adventure</span>
          </div>
        </div>
      </aside>
    </div>
  </main>

  <script>
    // Mobile menu toggle functionality
    document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
      const sidebar = document.querySelector('.sidebar');
      sidebar.style.display = sidebar.style.display === 'flex' ? 'none' : 'flex';
    });

    // Search functionality
    document.querySelector('.search-input').addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      const bookItems = document.querySelectorAll('.book-item');

      bookItems.forEach(item => {
        const title = item.querySelector('.book-title').textContent.toLowerCase();
        const author = item.querySelector('.book-author').textContent.toLowerCase();

        if (title.includes(searchTerm) || author.includes(searchTerm)) {
          item.style.display = 'flex';
        } else {
          item.style.display = searchTerm === '' ? 'flex' : 'none';
        }
      });
    });

    // Filter functionality
    document.querySelectorAll('.right-sidebar .sidebar-item').forEach(item => {
      item.addEventListener('click', function() {
        // Remove active class from all items
        document.querySelectorAll('.right-sidebar .sidebar-item').forEach(i => i.classList.remove('active'));
        // Add active class to clicked item
        this.classList.add('active');

        const filterText = this.querySelector('span').textContent.toLowerCase();
        const bookItems = document.querySelectorAll('.book-item');

        if (filterText === 'leyendo') {
          // Show all books for "reading" filter
          bookItems.forEach(item => item.style.display = 'flex');
        } else {
          // Filter by genre
          bookItems.forEach(item => {
            const tags = item.querySelectorAll('.tag span');
            let hasTag = false;

            tags.forEach(tag => {
              if (tag.textContent.toLowerCase().includes(filterText)) {
                hasTag = true;
              }
            });

            item.style.display = hasTag ? 'flex' : 'none';
          });
        }
      });
    });

    // Sidebar menu interactions
    document.querySelectorAll('.sidebar .menu-item').forEach(item => {
      item.addEventListener('click', function() {
        // Remove active state from all menu items
        document.querySelectorAll('.sidebar .menu-item').forEach(i => i.classList.remove('active'));
        // Add active state to clicked item
        this.classList.add('active');
      });
    });
  </script>
</body>
</html>
