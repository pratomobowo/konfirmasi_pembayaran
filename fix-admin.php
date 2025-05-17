<?php

// Autoload dependencies
require __DIR__.'/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Import required classes
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

echo "🔍 Debugging middleware admin...\n\n";

// Periksa keberadaan kelas AdminMiddleware
if (class_exists(AdminMiddleware::class)) {
    echo "✅ Kelas AdminMiddleware ditemukan\n";
} else {
    echo "❌ Kelas AdminMiddleware tidak ditemukan\n";
    echo "   Lokasi yang diharapkan: " . app_path('Http/Middleware/AdminMiddleware.php') . "\n";
}

// Periksa registrasi middleware di Kernel
$middlewareAliases = app()->make(\App\Http\Kernel::class)->getMiddlewareAliases();
if (isset($middlewareAliases['admin'])) {
    echo "✅ Middleware 'admin' terdaftar di Kernel.php sebagai: " . $middlewareAliases['admin'] . "\n";
} else {
    echo "❌ Middleware 'admin' tidak terdaftar di Kernel.php\n";
}

// Mencoba clear cache aplikasi
echo "\n🧹 Membersihkan cache aplikasi...\n";
Artisan::call('optimize:clear');
echo "✅ Cache aplikasi dibersihkan\n";

// Periksa rute admin
echo "\n🔍 Memeriksa rute admin...\n";
$adminRoutes = Route::getRoutes()->getRoutesByName();
$adminDashboardRoute = isset($adminRoutes['admin.dashboard']) ? $adminRoutes['admin.dashboard'] : null;

if ($adminDashboardRoute) {
    echo "✅ Rute admin.dashboard ditemukan\n";
    $middleware = $adminDashboardRoute->middleware();
    echo "   Middleware yang terdaftar pada rute: " . implode(", ", $middleware) . "\n";
} else {
    echo "❌ Rute admin.dashboard tidak ditemukan\n";
}

// Mencoba fix masalah middleware
echo "\n🔧 Mencoba memperbaiki masalah middleware...\n";

// Registrasi ulang middleware di runtime
if (class_exists(AdminMiddleware::class)) {
    $router = app('router');
    $router->aliasMiddleware('admin', \App\Http\Middleware\AdminMiddleware::class);
    echo "✅ Middleware 'admin' didaftarkan ulang\n";
} else {
    echo "❌ Tidak dapat mendaftarkan ulang middleware 'admin' karena kelas tidak ditemukan\n";
}

echo "\n🔧 Anda dapat mencoba akses kembali ke halaman admin\n";
echo "   Jika masih terjadi error, pastikan class AdminMiddleware.php ada di lokasi:\n";
echo "   " . app_path('Http/Middleware/AdminMiddleware.php') . "\n";
echo "   Dan pastikan nama namespace sesuai: App\\Http\\Middleware\n\n";
echo "🔧 Sebagai alternatif, silakan mencoba menggunakan nama class lengkap di routes/web.php:\n";
echo "   Route::middleware(['auth', \\App\\Http\\Middleware\\AdminMiddleware::class])...\n\n";

echo "✨ Selesai!\n"; 