<?php

// 1. Paksa Laravel untuk mengabaikan cache bawaan dengan mengalihkan path cache ke /tmp
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_ROUTES_CACHE=/tmp/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');

// 2. Muat sistem otomatisasi (autoload) dan bootstrap Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. Alihkan folder storage ke /tmp (satu-satunya folder yang diizinkan Vercel untuk ditulis)
$app->useStoragePath('/tmp/storage');

// 4. Buat folder-folder internal yang dibutuhkan Laravel di dalam /tmp secara otomatis
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

// 5. Jalankan aplikasi Laravel seperti biasa
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);