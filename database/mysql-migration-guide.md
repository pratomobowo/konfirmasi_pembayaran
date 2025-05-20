# Panduan Migrasi dari SQLite ke MySQL

## 1. Konfigurasi Database MySQL

Buka file `.env` dan ubah konfigurasi database sebagai berikut:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=konfirmasi_usbypkp
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan kredensial MySQL Anda.

## 2. Membuat Database

Buat database baru dengan nama yang sesuai dengan `DB_DATABASE` di file `.env` (misalnya `konfirmasi_usbypkp`).

```sql
CREATE DATABASE konfirmasi_usbypkp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

## 3. Migrasi Database

Setelah mengkonfigurasi database, jalankan migrasi Laravel:

```bash
php artisan migrate:fresh --seed
```

Perintah ini akan membuat skema database dan mengisi data awal jika ada.

## 4. Perubahan Kode untuk Kompatibilitas MySQL

Semua perubahan kode yang diperlukan untuk kompatibilitas dengan MySQL sudah dilakukan, meliputi:

1. Mengubah tanda kutip ganda (`"`) menjadi tanda kutip tunggal (`'`) di query CASE WHEN
2. Mengganti fungsi SQLite `strftime("%m", created_at)` dengan fungsi MySQL `MONTH(created_at)`
3. Menyesuaikan format output dari query untuk ditampilkan di halaman laporan

## 5. Cadangkan Database SQLite

Sebelum melakukan migrasi, pastikan Anda membuat cadangan database SQLite yang sudah ada:

```bash
cp database/database.sqlite database/database.sqlite.backup
```

## 6. Import Data dari SQLite ke MySQL (Opsional)

Jika Anda perlu memindahkan data dari SQLite ke MySQL, gunakan langkah-langkah berikut:

1. Export data dari SQLite ke CSV
2. Import data ke MySQL menggunakan format CSV
3. Alternatif: gunakan library seperti Laravel Excel untuk proses migrasi data

## 7. Troubleshooting

- Jika ada masalah dengan koneksi database, pastikan MySQL server sudah berjalan
- Pastikan kredensial database sudah benar
- Periksa bahwa port MySQL (biasanya 3306) tidak diblokir oleh firewall
- Jika ada error terkait kolom atau tipe data, lihat error message dan sesuaikan migrasi Laravel

## 8. Performa

MySQL umumnya memiliki performa yang lebih baik untuk aplikasi dengan banyak pengguna simultan. Pastikan untuk mengoptimalkan query dan indeks sesuai dengan pola akses data pada aplikasi. 