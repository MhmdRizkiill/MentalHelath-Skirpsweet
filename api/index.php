<?php

// 1. Jurus Pamungkas HTTPS (Wajib Paling Atas!)
$_SERVER['HTTPS'] = 'on';

// 2. Alihkan cache ke /tmp (Bawaan Vercel)
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_ROUTES_CACHE=/tmp/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');

// 3. Buat folder-folder internal yang dibutuhkan Laravel di dalam /tmp
$required_dirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs'
];

foreach ($required_dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 4. Muat sistem otomatisasi (autoload)
require __DIR__ . '/../vendor/autoload.php';

// 5. Muat bootstrap Laravel 11/12
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 6. Alihkan folder storage ke /tmp
$app->useStoragePath('/tmp/storage');

// 7. Jalankan aplikasi Laravel (Gaya Laravel 11/12 yang benar)
$app->handleRequest(Illuminate\Http\Request::capture());