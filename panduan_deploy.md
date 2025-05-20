# Panduan Deploy dan Perbaikan Masalah di Server

## Langkah 1: Pull Kode Terbaru
```bash
cd /www/wwwroot/konfirmasi.usbypkp.ac.id/konfirmasi_pembayaran
git pull origin master
```

## Langkah 2: Instal Dependensi Composer
```bash
composer install --no-scripts
```

## Langkah 3: Salin dan Konfigurasi File .env (jika belum ada)
```bash
cp .env.example .env
# Edit file .env sesuai dengan konfigurasi server
```

## Langkah 4: Generate Application Key (jika belum)
```bash
php artisan key:generate
```

## Langkah 5: Update Tabel Migrations
```bash
# Gunakan file SQL yang sudah dibuat
mysql -u username -p sql_konfirmasi_u < database/update_migrations.sql
# Ganti username dengan username MySQL Anda
```

## Langkah 6: Perbaiki Izin File dan Direktori
```bash
# Jalankan script fix_permissions.sh
chmod +x fix_permissions.sh
./fix_permissions.sh
```

## Langkah 7: Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

## Langkah 8: Build Assets (pada Environment Lokal)
```bash
# Di lingkungan lokal
npm run build
# Upload folder public/build ke server
```

## Langkah 9: Atau Jalankan Build di Server (jika izin sudah diperbaiki)
```bash
npm install
npm run build
```

## Langkah 10: Restart Queue Worker (jika menggunakan)
```bash
php artisan queue:restart
```

## Langkah 11: Verifikasi Deploy
Periksa aplikasi setelah deploy untuk memastikan semuanya berjalan dengan baik.

## Troubleshooting

### Masalah Database
- Jika masih ada error tentang tabel yang sudah ada, coba jalankan:
  ```bash
  php artisan migrate:status
  ```
  Periksa migrasi mana yang belum dijalankan, dan tambahkan secara manual ke tabel migrations.

### Masalah Permission
- Jika masih ada masalah izin, perlu menyesuaikan user dan group:
  ```bash
  chown -R www-data:www-data /www/wwwroot/konfirmasi.usbypkp.ac.id/konfirmasi_pembayaran
  ```
  (Ganti www-data dengan pengguna web server Anda)

### Masalah Composer
- Jika `composer install` gagal karena memori, coba:
  ```bash
  COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev
  ```

### Masalah NPM
- Jika npm run build gagal karena memori:
  ```bash
  NODE_OPTIONS=--max_old_space_size=4096 npm run build
  ``` 