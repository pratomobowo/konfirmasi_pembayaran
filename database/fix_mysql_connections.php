<?php
/**
 * Script untuk memeriksa koneksi MySQL dan debugger bantuan
 * Jalankan dengan: php database/fix_mysql_connections.php
 */

// Autoload dari Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Muat file .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

echo "=== PEMERIKSAAN KONEKSI MYSQL ===\n\n";

// Ambil konfigurasi MySQL dari .env
$host = $_ENV['DB_HOST'] ?? '127.0.0.1';
$port = $_ENV['DB_PORT'] ?? '3306';
$database = $_ENV['DB_DATABASE'] ?? 'laravel';
$username = $_ENV['DB_USERNAME'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? '';

echo "Konfigurasi dari .env:\n";
echo "- Host: $host\n";
echo "- Port: $port\n";
echo "- Database: $database\n";
echo "- Username: $username\n";
echo "- Password: " . (empty($password) ? "(kosong)" : "(terisi)") . "\n\n";

// Coba koneksi ke MySQL
echo "Mencoba koneksi ke MySQL... ";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "BERHASIL!\n\n";
    
    // Cek versi MySQL
    $stmt = $pdo->query("SELECT VERSION() as version");
    $version = $stmt->fetch(PDO::FETCH_ASSOC)['version'];
    echo "Versi MySQL: $version\n\n";
    
    // Cek tabel yang ada
    echo "Tabel yang ada di database:\n";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        echo "- Tidak ada tabel di database ini.\n";
    } else {
        foreach ($tables as $table) {
            echo "- $table\n";
        }
    }
    
    echo "\n";
    
    // Cek tabel migrations
    if (in_array('migrations', $tables)) {
        echo "Isi tabel migrations:\n";
        $stmt = $pdo->query("SELECT * FROM migrations ORDER BY batch, id");
        $migrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($migrations)) {
            echo "- Tabel migrations kosong.\n";
        } else {
            foreach ($migrations as $migration) {
                echo "- {$migration['id']}: {$migration['migration']} (batch {$migration['batch']})\n";
            }
        }
    } else {
        echo "Tabel migrations tidak ditemukan!\n";
        echo "Perlu menjalankan: php artisan migrate:install\n";
    }
    
} catch (PDOException $e) {
    echo "GAGAL!\n\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    
    echo "Kemungkinan penyebab dan solusi:\n";
    
    if (strpos($e->getMessage(), "Access denied") !== false) {
        echo "- Username atau password salah. Periksa konfigurasi .env\n";
        echo "- Pengguna tidak memiliki akses ke database. Pastikan hak akses pengguna.\n";
    } elseif (strpos($e->getMessage(), "Unknown database") !== false) {
        echo "- Database '$database' tidak ada. Buat database terlebih dahulu dengan:\n";
        echo "  CREATE DATABASE $database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;\n";
    } elseif (strpos($e->getMessage(), "Connection refused") !== false) {
        echo "- Server MySQL tidak berjalan atau tidak dapat dijangkau di $host:$port\n";
        echo "- Firewall mungkin memblokir koneksi. Periksa pengaturan firewall.\n";
    }
}

echo "\n=== SELESAI ===\n"; 