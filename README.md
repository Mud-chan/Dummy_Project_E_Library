 E-Library

E-Library adalah sistem informasi perpustakaan digital berbasis **Laravel** yang memungkinkan pengguna untuk mengelola buku, melakukan peminjaman, memberikan rating, serta menyimpan buku favorit (bookmark).  
Aplikasi ini mendukung dua role utama: **Petugas** dan **Pengunjung**.

---

## 🚀 Fitur Utama
- 🔑 Autentikasi dengan Laravel Sanctum
- 👥 Role management: Petugas & Pengunjung
- 📖 CRUD Buku
- 🏷️ Manajemen Genre
- 📅 Manajemen Peminjaman & Pengembalian

---

## 🛠️ Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/Mud-chan/Dummy_Project_E_Library.git
   
2. **Install dependencies**
composer install
npm install && npm run dev

4. **Generate app key**
php artisan key:generate

6. **Atur konfigurasi database di file .env**
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_library
DB_USERNAME=root
DB_PASSWORD=

7. **Migrasi & seeder**
php artisan migrate --seed

8. **Jalankan server**
php artisan serve


👥 Roles
Petugas
-Manajemen buku
-Manajemen genre
-Mengatur peminjaman

Pengunjung
-Melihat daftar buku
-Membaca detail buku
-Pinjam dan kembalikan buku

User Login
Petugas → petugas@example.com | password123
Pengunjung → pengunjung@example.com | password123
