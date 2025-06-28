# 🎬 Web Cineflix

Aplikasi web streaming film dan serial TV yang dibangun menggunakan Laravel dan MySQL. Web Cineflix menyediakan pengalaman menonton yang lengkap dengan fitur pencarian, watchlist, komentar, dan trailer.

## 📋 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
- [Konfigurasi Database](#-konfigurasi-database)
- [Panduan Penggunaan](#-panduan-penggunaan)
- [Akun Demo](#-akun-demo)
- [Screenshot](#-screenshot)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)

## ✨ Fitur Utama

- 🎥 **Streaming Movies & TV Shows** - Tonton film dan serial TV favorit
- 🔍 **Pencarian Canggih** - Cari konten berdasarkan judul, genre, atau kategori
- 📱 **Responsive Design** - Tampilan yang optimal di desktop dan mobile
- 👤 **Sistem Autentikasi** - Registrasi dan login pengguna
- 📚 **Watchlist** - Simpan film dan serial untuk ditonton nanti
- 💬 **Sistem Komentar** - Berikan ulasan dan baca komentar pengguna lain
- 🎬 **Trailer Preview** - Tonton trailer sebelum menonton film lengkap
- 📊 **Detail Konten** - Informasi lengkap tentang film dan serial TV

## 🛠 Teknologi yang Digunakan

- **Backend**: Laravel (PHP Framework)
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Server**: Apache/Nginx
- **Package Manager**: Composer

## 📋 Persyaratan Sistem

- PHP >= 8.0
- Composer
- MySQL >= 5.7
- Apache/Nginx Web Server
- Node.js & NPM (untuk asset compilation)

## 🚀 Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/rubysy/web-movie.git
   cd web-movie
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Copy Environment File**
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Compile Assets**
   ```bash
   npm run dev
   # atau untuk production
   npm run build
   ```

## 🗄 Konfigurasi Database

1. **Buat Database MySQL**
   ```sql
   CREATE DATABASE db_film;
   ```

2. **Konfigurasi File .env**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_film
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

3. **Jalankan Migration & Seeder**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

4. **Jalankan Server**
   ```bash
   php artisan serve
   ```

   Akses aplikasi di: `http://localhost:8000`

## 📖 Panduan Penggunaan

### Langkah-langkah Menggunakan Aplikasi:

1. **Akses Website**
   - Buka browser dan kunjungi `http://localhost:8000`
   - Halaman landing akan muncul dengan pilihan login atau registrasi

2. **Autentikasi**
   - **Registrasi**: Klik "Daftar" untuk membuat akun baru
   - **Login**: Masukkan email dan password untuk masuk

3. **Jelajahi Konten**
   - **Movies**: Browse koleksi film tersedia
   - **TV Shows**: Jelajahi serial TV dan episode
   - **Search**: Gunakan fitur pencarian untuk menemukan konten spesifik

4. **Fitur Interaktif**
   - **Watchlist**: Tambahkan film/serial ke daftar tontonan
   - **Detail**: Lihat informasi lengkap, rating, dan sinopsis
   - **Trailer**: Tonton preview sebelum menonton film lengkap
   - **Komentar**: Berikan ulasan dan baca pendapat pengguna lain

5. **Manajemen Komentar**
   - Tambahkan komentar pada halaman detail
   - Edit atau hapus komentar milik sendiri
   - Baca dan respon komentar pengguna lain

6. **Logout**
   - Klik tombol logout untuk keluar dari aplikasi dengan aman

## 👤 Akun Demo

Untuk testing dan demo, gunakan akun berikut:

**User Account:**
- **Email**: `user@cineflix.com`
- **Password**: `cineflix123`

> **Catatan**: Akun ini sudah memiliki beberapa data sample untuk testing fitur aplikasi.

## 📸 Screenshot

<!-- Tambahkan screenshot aplikasi di sini -->
*Screenshot akan ditambahkan*

## 🤝 Kontribusi

Kontribusi selalu diterima! Untuk berkontribusi:

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buka Pull Request

## 📄 Lisensi

Proyek ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk informasi lebih lanjut.

## 📞 Kontak

- **Developer**: [rubysy](https://github.com/rubysy)
- **Repository**: [web-movie](https://github.com/rubysy/web-movie)

---

 **Jangan lupa berikan star jika proyek ini membantu**
