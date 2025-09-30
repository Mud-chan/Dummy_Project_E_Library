<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Library Collection | Digital Books & Reading Platform</title>
    <link rel="icon" href="{{ asset('assets/images/img_cover.svg') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/koleksi.css') }}">
    <style>
        /* Perbaikan tambahan */
        a {
            text-decoration: none;
            color: inherit;
        }

        .active-item {
            background-color: #F6E7AE;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <main class="main-container">
        <div class="content-wrapper">
            <!-- Left Sidebar -->
            <aside class="sidebar">
                <a href="{{ route('dashboard.pengunjung') }}">
                    <img src="{{ asset('assets/images/img_sidebar_logo.png') }}" alt="E-Library Logo"
                        class="sidebar-logo" />
                </a>

                {{-- ================= KATEGORI ================= --}}
                <div class="sidebar-section">
                    <h3>Kategori</h3>
                    <nav class="sidebar-menu">
                        @php
                            $kategoriList = ['novel', 'manga', 'manhwa'];
                            $kategoriDipilih = request('kategori');
                        @endphp
                        @foreach ($kategoriList as $kategori)
                            <a href="{{ route('cari.buku', ['kategori' => $kategori, 'genre' => request('genre')]) }}"
                                class="menu-item {{ $kategoriDipilih === $kategori ? 'active-item' : '' }}">
                                <img src="{{ asset('assets/images/book.svg') }}" alt="{{ $kategori }} icon" />
                                <span>{{ ucfirst($kategori) }}</span>
                            </a>
                        @endforeach
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Header -->
                <header class="header">
                    <button class="mobile-menu-btn" aria-label="Open menu">☰</button>

                    <div class="search-container">
                        <form action="{{ route('cari.buku') }}" method="GET">
                            <input type="search" name="q" class="search-input" placeholder="Cari Buku"
                                value="{{ request('q') }}" aria-label="Search books" />
                            <button type="submit" style="border:none;background:none;">
                                <img src="{{ asset('assets/images/img_searchicon.svg') }}" alt="Search"
                                    class="search-icon" />
                            </button>
                        </form>
                    </div>

                    <nav class="header-nav">
                        <a href="{{ route('profile.show.pengunjung') }}" class="nav-item">
                            {{ Auth::user()->name }} ({{ Auth::user()->role }})
                        </a>
                        <a href="{{ route('profile.show.pengunjung') }}">
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
                    <a href="{{ route('koleksi.petugas') }}">
                        <div class="sidebar-item {{ request()->routeIs('koleksi.petugas') ? 'active-item' : '' }}">
                            <img src="{{ asset('assets/images/archives-document.svg') }}" alt="Collection icon" />
                            <span>Colection</span>
                        </div>
                    </a>


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

                {{-- ================= FILTER GENRE ================= --}}
                <div class="sidebar-section">
                    <div class="filter-header">
                        <h2>Filter</h2>
                        <a href="{{ route('genre.detail') }}" class="view-all">Lainya</a>
                    </div>

                    <a href="{{ route('genre.tambah') }}"
                            class="sidebar-item">
                            <img src="{{ asset('assets/images/plus-circle.svg') }}" alt="icon" />
                            <span>Tambah Genre</span>
                    </a>

                    @php
                        $genreDipilih = request('genre');
                    @endphp

                    @forelse ($genreList as $genre)
                        <a href="{{ route('cari.buku', ['genre' => $genre, 'kategori' => request('kategori')]) }}"
                            class="sidebar-item {{ $genreDipilih === $genre ? 'active-item' : '' }}">

                            <span>{{ ucfirst($genre) }}</span>
                        </a>
                    @empty
                        <p style="padding: 10px; font-size: 14px; color: #777;">Tidak ada genre tersedia</p>
                    @endforelse

                </div>

            </aside>
        </div>
    </main>
</body>

</html>
