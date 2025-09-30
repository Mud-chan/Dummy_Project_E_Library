<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Library Collection | Digital Books & Reading Platform</title>
    <link rel="icon" href="{{ asset('assets/images/img_cover.svg') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">
    <script type="module"
        src="https://static.rocket.new/rocket-web.js?_cfg=https%3A%2F%2Fmiyakoaiha5841back.builtwithrocket.new&_be=https%3A%2F%2Fapplication.rocket.new&_v=0.1.8">
    </script>
</head>

<body>
    <main class="main-container">
        <div class="content-wrapper">
            <!-- Left Sidebar -->
            <aside class="sidebar">
                <a href="{{ route('dashboard.petugas') }}" style="text-decoration: none;">
                    <img src="{{ asset('assets/images/img_sidebar_logo.png') }}" alt="E-Library Logo"
                        class="sidebar-logo" />
                </a>

                <div class="sidebar-section">
                    <h3>Kategori</h3>
                    <nav class="sidebar-menu">
                        <div class="menu-item">
                            <img src="{{ asset('assets/images/book.svg') }}" alt="Novel icon" />
                            <span>Novel</span>
                        </div>
                        <div class="menu-item">
                            <img src="{{ asset('assets/images/book.svg') }}" alt="Manga icon" />
                            <span>Manga</span>
                        </div>
                        <div class="menu-item">
                            <img src="{{ asset('assets/images/book.svg') }}" alt="Manhwa icon" />
                            <span>Manhwa</span>
                        </div>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Header -->
                <header class="header">
                    <button class="mobile-menu-btn" aria-label="Open menu">☰</button>

                    <div class="search-container">
                        <input type="search" class="search-input" placeholder="Cari Buku" aria-label="Search books" />
                        <img src="{{ asset('assets/images/img_searchicon.svg') }}" alt="Search" class="search-icon" />
                    </div>

                    <nav class="header-nav">
                        <a href="{{ route('profile.show') }}" class="nav-item">{{ Auth::user()->name }} ({{ Auth::user()->role }})</a>
                        <a href="{{ route('profile.show') }}" style="text-decoration: none;">
                            <img src="{{ Auth::user()->image ? asset('uploaded_profiles/' . Auth::user()->image) : asset('assets/images/no-cover.png') }}"
                                alt="User avatar" class="user-avatar" />
                        </a>
                    </nav>

                </header>

                <main>
                    @yield('main')
                </main>
            </div>

            <!-- Right Sidebar -->
            <aside class="right-sidebar">
                <div class="sidebar-section">
                    <a href="{{ route('koleksi.petugas') }}" style="text-decoration: none;">
                        <div class="sidebar-item">
                            <img src="{{ asset('assets/images/archives-document.svg') }}" alt="Collection icon" />
                            <span>Colection</span>
                        </div>
                    </a>

                    <div class="sidebar-item">
                        <img src="{{ asset('assets/images/basic-popular-statistic.svg') }}" alt="Statistics icon" />
                        <span>Statistik</span>
                    </div>

                    <div class="sidebar-item">
                        <img src="{{ asset('assets/images/bookmark.svg') }}" alt="Bookmark icon" />
                        <span>Bookmark</span>
                    </div>

                    <div class="sidebar-item">
                        <img src="{{ asset('assets/images/setting-setting.svg') }}" alt="Borrow icon" />
                        <span>Peminjaman</span>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <div class="sidebar-item" onclick="document.getElementById('logout-form').submit();">
                            <img src="{{ asset('assets/images/setting-setting.svg') }}" alt="Logout icon" />
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
                        <img src="{{ asset('assets/images/img_image_3.png') }}" alt="Horror icon" />
                        <span>Horor</span>
                    </div>

                    <div class="sidebar-item">
                        <img src="{{ asset('assets/images/img_image_1.png') }}" alt="Action icon" />
                        <span>Action</span>
                    </div>

                    <div class="sidebar-item">
                        <img src="{{ asset('assets/images/img_image_1.png') }}" alt="Fantasy icon" />
                        <span>Fantasi</span>
                    </div>

                    <div class="sidebar-item">
                        <img src="{{ asset('assets/images/img_image_1.png') }}" alt="Adventure icon" />
                        <span>Adventure</span>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <script src="{{ asset('assets/js/koleksi.js') }}"></script>
</body>

</html>
