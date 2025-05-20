# Panduan Migrasi dari SQLite ke MySQL

## Solusi Untuk Masalah Migrasi

Terdapat 2 cara untuk melakukan migrasi dari SQLite ke MySQL:

### Cara 1: Menggunakan Complete Schema (Direkomendasikan)

File `database/complete_schema.sql` sudah berisi seluruh struktur database lengkap yang siap digunakan untuk MySQL. File ini meliputi:
- Struktur tabel lengkap
- Index dan foreign key
- Data awal untuk tabel penting (settings, payment_types, dll)
- Entri migrations yang diperlukan

Langkah-langkah:
1. Pastikan MySQL server sudah berjalan
2. Buat database baru di MySQL:
   ```
   mysql -u username -p -e "CREATE DATABASE nama_database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
   ```
3. Import skema database:
   ```
   mysql -u username -p nama_database < database/complete_schema.sql
   ```
4. Perbarui file .env dengan konfigurasi MySQL:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=username
   DB_PASSWORD=password
   ```
5. Bersihkan cache Laravel:
   ```
   php artisan config:clear
   php artisan cache:clear
   ```

### Cara 2: Export Data SQLite ke MySQL

Jika Anda perlu mempertahankan data dari database SQLite yang sudah ada, gunakan script `database/sqlite_to_mysql.php` untuk mengekspor data.

Langkah-langkah:
1. Jalankan script ekspor data:
   ```
   php database/sqlite_to_mysql.php
   ```
   Ini akan menghasilkan file `database/sqlite_data.sql`

2. Buat dan siapkan database MySQL seperti pada Cara 1 (langkah 1-2)

3. Import skema terlebih dahulu:
   ```
   mysql -u username -p nama_database < database/complete_schema.sql
   ```

4. Import data yang telah diekspor:
   ```
   mysql -u username -p nama_database < database/sqlite_data.sql
   ```

5. Perbarui file .env dengan konfigurasi MySQL (seperti pada langkah 4 Cara 1)

6. Bersihkan cache Laravel (seperti pada langkah 5 Cara 1)

## Mengatasi Masalah Umum

### 1. Collation UTF8MB4

Jika server MySQL Anda tidak mendukung `utf8mb4_0900_ai_ci`, gunakan alternatif seperti:
- `utf8mb4_unicode_ci`
- `utf8mb4_general_ci`

Untuk mengubah, buka file `database/complete_schema.sql` dan ganti semua `utf8mb4_0900_ai_ci` menjadi `utf8mb4_unicode_ci`.

### 2. Error "Table Already Exists"

Jika muncul error bahwa tabel sudah ada, pastikan:
- Database benar-benar kosong sebelum import
- Atau hapus database dan buat ulang:
  ```
  mysql -u username -p -e "DROP DATABASE nama_database; CREATE DATABASE nama_database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
  ```

### 3. Permission Denied

Jika terjadi masalah permission pada file:
```
chmod -R 755 /path/to/laravel/folder
chmod -R 777 /path/to/laravel/storage
chmod -R 777 /path/to/laravel/bootstrap/cache
```

### 4. Vendor/Autoload.php missing

Jika file vendor/autoload.php tidak ditemukan:
```
composer install
```

## Verifikasi Migrasi

Setelah migrasi selesai, verifikasi bahwa aplikasi berjalan dengan baik:

1. Cek koneksi database:
   ```
   php artisan tinker
   DB::connection()->getPdo();
   ```

2. Jalankan server development:
   ```
   php artisan serve
   ```

3. Periksa halaman admin dan pastikan data muncul dengan benar 