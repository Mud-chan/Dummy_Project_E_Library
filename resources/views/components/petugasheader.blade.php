<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Library Collection | Digital Books & Reading Platform</title>
    <link rel="icon" href="../assets/images/img_cover.svg">
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">
    <link rel="icon" href="{{ asset('assets/images/img_cover.svg') }}">
    <script type="module"
        src="https://static.rocket.new/rocket-web.js?_cfg=https%3A%2F%2Fmiyakoaiha5841back.builtwithrocket.new&_be=https%3A%2F%2Fapplication.rocket.new&_v=0.1.8">
    </script>
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
                        <a href="#" class="nav-item">{{ Auth::user()->name }} ({{ Auth::user()->role }})</a>
                        <img src="../assets/images/miruko_vol_10.jpg" alt="User avatar" class="user-avatar" />
                    </nav>
                </header>


                <main>
                    @yield('main')
                </main>

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
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <div class="sidebar-item" onclick="document.getElementById('logout-form').submit();">
                            <img src="../assets/images/setting-setting.svg" alt="Settings icon" />
                            <span>Logout</span>
                        </div>
                    </form>

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

    <script src="{{ asset('assets/js/koleksi.js') }}"></script>
</body>

</html>
