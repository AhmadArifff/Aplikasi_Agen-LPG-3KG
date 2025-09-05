# Aplikasi Agen LPG 3KG

Aplikasi ini adalah sistem manajemen perencanaan dan penyaluran LPG 3KG berbasis web yang dibangun menggunakan Laravel.

## Persyaratan Sistem

Sebelum memulai, pastikan Anda memiliki persyaratan berikut:
- **PHP**: Versi `^8.1` atau lebih baru
- **Composer**: Dependency manager untuk PHP
- **Node.js**: Versi `^16` atau lebih baru
- **NPM**: Paket manajer untuk Node.js
- **Database**: MySQL atau MariaDB
- **XAMPP/WAMP**: Untuk menjalankan server lokal (opsional)

---

## Langkah Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek ini:

### 1. Clone Repository

Clone repository ini ke komputer Anda:

```bash
git clone https://github.com/AhmadArifff/Aplikasi_Agen-LPG-3KG.git
```

Masuk ke direktori proyek:

```bash
cd Aplikasi_Agen-LPG-3KG
```

### 2. Instal Dependensi PHP:

Sebelum menjalankan `composer install`, hapus terlebih dahulu folder `vendor` dan file `composer.lock` jika sudah ada:

```bash
# Jika Anda menggunakan Git Bash atau terminal Linux/MacOS:
rm -rf vendor composer.lock

# Catatan: Perintah di atas akan error jika dijalankan di PowerShell Windows,
# misalnya:
# Remove-Item: A parameter cannot be found that matches parameter name 'rf'.

# Jika menggunakan PowerShell, gunakan perintah berikut:
Remove-Item -Recurse -Force vendor, composer.lock
```

Kemudian instal dependensi PHP dengan Composer:

```bash
composer install
```

### 3. Instal Dependensi Frontend

Gunakan NPM untuk menginstal dependensi frontend:

```bash
npm install
```

### 4. Buat Database dan Konfigurasi File .env

Sebelum mengonfigurasi file `.env`, buat terlebih dahulu database baru dengan nama `laravel` di MySQL atau MariaDB Anda. Anda dapat menggunakan phpMyAdmin atau perintah SQL berikut:

```sql
CREATE DATABASE laravel;
```

Setelah database dibuat, salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Buka file `.env` dan sesuaikan konfigurasi berikut:

```env
APP_NAME="Aplikasi Agen LPG 3KG"
APP_ENV=local
APP_KEY=base64:GENERATE_KEY
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Pastikan untuk mengganti `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` sesuai dengan konfigurasi database Anda.

### 5. Generate Application Key

Jalankan perintah berikut untuk membuat application key:

```bash
php artisan key:generate
```

### 6. Migrasi dan Seed Database

Jalankan migrasi untuk membuat tabel di database:

```bash
php artisan migrate
```

Jalankan seeder untuk mengisi data awal:

```bash
php artisan db:seed --class=DatabaseSeeder
```

### 7. Build Frontend Assets

Untuk mengompilasi aset frontend, jalankan:

```bash
npm run dev
```

Jika Anda ingin membangun aset untuk produksi, gunakan:

```bash
npm run build
```

### 8. Jalankan Server

Jalankan server Laravel menggunakan perintah berikut:

```bash
php artisan serve
```

Akses aplikasi di browser Anda melalui URL:

```
http://127.0.0.1:8000
```

---

## Fitur Utama

- **Perencanaan**: Kelola data perencanaan LPG 3KG.
- **Penyaluran**: Kelola data penyaluran LPG 3KG.
- **Import Data**: Import data perencanaan dari file CSV atau Excel.
- **Rekapitulasi**: Lihat laporan rekapitulasi data.

---

## Struktur Proyek

- `app/Models`: Berisi model untuk database.
- `app/Http/Controllers`: Berisi controller untuk logika aplikasi.
- `resources/views`: Berisi file Blade untuk tampilan frontend.
- `routes/web.php`: Berisi definisi rute aplikasi.
- `database/migrations`: Berisi file migrasi untuk struktur database.
- `database/seeders`: Berisi seeder untuk data awal.

---

## Troubleshooting

Jika Anda mengalami masalah, berikut adalah beberapa langkah yang dapat membantu:

- **Periksa Log Laravel**: Log error dapat ditemukan di `storage/logs/laravel.log`.
- **Perbarui Composer dan NPM**: Jalankan perintah berikut untuk memperbarui dependensi:

    ```bash
    composer update
    npm update
    ```

- **Hapus Cache**: Bersihkan cache aplikasi dengan perintah:

    ```bash
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    php artisan view:clear
    ```

---

## Kontribusi

Kontribusi sangat terbuka! Silakan fork repository ini dan buat pull request untuk fitur atau perbaikan bug.

---

## Lisensi

Proyek ini menggunakan lisensi [MIT](LICENSE).

---

## Kontak

Jika ada pertanyaan atau saran, silakan hubungi:

- Ahmad Arif - [ahmadarif@example.com](mailto:ahmadarif@example.com)
- [GitHub Issues](https://github.com/AhmadArifff/Aplikasi_Agen-LPG-3KG/issues)

