#!/bin/bash
echo "Fixing Storage Link for Laravel Application"

# Pergi ke direktori aplikasi
cd "$(dirname "$0")"

# Hapus symbolic link yang ada jika ada
if [ -L "public/storage" ]; then
    echo "Removing existing storage link..."
    rm public/storage
fi

# Buat symbolic link baru
echo "Creating new storage link..."
php artisan storage:link

# Set permission
echo "Setting permissions on storage directory..."
chmod -R 755 storage
chown -R www-data:www-data storage
chown -R www-data:www-data public/storage

echo "Done! Storage link has been fixed." 