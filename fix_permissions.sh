#!/bin/bash
# Script untuk memperbaiki izin pada server

# Ubah direktori ke root aplikasi
cd /www/wwwroot/konfirmasi.usbypkp.ac.id/konfirmasi_pembayaran

# Perbaiki izin pada direktori storage dan bootstrap/cache
echo "Memperbaiki izin pada direktori storage dan bootstrap/cache..."
chmod -R 775 storage bootstrap/cache

# Perbaiki izin pada vendor dan node_modules
echo "Memperbaiki izin pada direktori vendor dan node_modules..."
chmod -R 755 vendor node_modules

# Berikan izin execute pada semua file di bin
echo "Memperbaiki izin pada file executable di node_modules/.bin..."
chmod -R +x node_modules/.bin

# Perbaiki izin pada file penting
echo "Memperbaiki izin pada file artisan..."
chmod +x artisan

echo "Selesai memperbaiki izin!" 