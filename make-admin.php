<?php

// Autoload dependencies
require __DIR__.'/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Import required classes
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Email user yang ingin dijadikan admin
$email = $argv[1] ?? 'admin@example.com'; // Default atau bisa diubah melalui parameter CLI

// Cari user berdasarkan email
$user = User::where('email', $email)->first();

if ($user) {
    // Update role menjadi admin
    $user->role = 'admin';
    $user->save();
    
    echo "✅ User dengan email {$email} berhasil diubah menjadi admin!\n";
} else {
    echo "❌ User dengan email {$email} tidak ditemukan.\n";
    
    // Buat pengguna admin baru jika diinginkan
    echo "Apakah Anda ingin membuat pengguna admin baru? (y/n): ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    
    if (trim($line) === 'y' || trim($line) === 'Y') {
        echo "Masukkan nama: ";
        $name = trim(fgets($handle));
        
        echo "Masukkan password: ";
        $password = trim(fgets($handle));
        
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin'
        ]);
        
        echo "✅ User admin baru dengan email {$email} berhasil dibuat!\n";
    }
    
    fclose($handle);
}

echo "\nSelesai! 🎉\n";