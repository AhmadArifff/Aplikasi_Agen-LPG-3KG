# Instalasi Aplikasi Agen LPG

## Deskripsi Proyek

Aplikasi Agen LPG adalah sistem distribusi gas LPG yang dirancang untuk memfasilitasi agen dalam merencanakan distribusi gas, mengelola transaksi pembayaran, dan melakukan autentikasi pengguna. Aplikasi ini dibangun menggunakan framework CodeIgniter 4.

## Fitur Utama

- **Autentikasi Pengguna**: Pengguna dapat mendaftar dan masuk ke dalam sistem.
- **Perencanaan Distribusi**: Agen dapat merencanakan distribusi gas ke basis yang terdaftar.
- **Pelacakan Transaksi Pembayaran**: Pengguna dapat memantau status pembayaran untuk basis LPG.

## Persyaratan Server

Pastikan server Anda memenuhi persyaratan berikut:

- PHP versi 7.4 atau lebih tinggi
- Ekstensi PHP yang diaktifkan:
    - intl
    - libcurl (untuk HTTP\CURLRequest)
    - json (aktif secara default)
    - mbstring
    - mysqlnd
    - xml (aktif secara default)

## Langkah Instalasi

1. **Clone Repository**
     ```bash
     git clone https://github.com/username/repo.git
     ```
     Atau salin folder aplikasi ke direktori web server Anda.

2. **Konfigurasi Web Server**
     - Pastikan web server mengarah ke folder `public` di dalam proyek, bukan ke root proyek.
     - Contoh konfigurasi Apache (di `httpd.conf` atau `.htaccess`):
         ```
         DocumentRoot "/path/to/project/public"
         <Directory "/path/to/project/public">
                 AllowOverride All
                 Require all granted
         </Directory>
         ```

3. **Konfigurasi Database**
     - Edit file `.env` atau `app/Config/Database.php` sesuai kebutuhan.
     - Contoh konfigurasi di `.env`:
         ```
         database.default.hostname = localhost
         database.default.database = nama_database
         database.default.username = user_database
         database.default.password = password_database
         database.default.DBDriver = MySQLi
         ```

4. **Install Dependencies**
     - Pastikan Composer sudah terinstall.
     - Jalankan perintah berikut di root proyek:
         ```bash
         composer install
         ```

5. **Migrasi dan Seeder (Opsional)**
     - Jika aplikasi menggunakan migrasi database:
         ```bash
         php spark migrate
         php spark db:seed
         ```

6. **Akses Aplikasi**
     - Buka browser dan akses aplikasi melalui alamat yang mengarah ke folder `public`.

## Referensi

- [Dokumentasi CodeIgniter 4](https://codeigniter4.github.io/userguide/)
- [Forum CodeIgniter](http://forum.codeigniter.com)