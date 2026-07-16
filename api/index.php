<?php

// 1. Muat sistem otomatisasi (autoload) dan bootstrap Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 2. Alihkan folder storage ke /tmp (satu-satunya folder yang diizinkan Vercel untuk ditulis)
$app->useStoragePath('/tmp/storage');

// 3. Buat folder-folder internal yang dibutuhkan Laravel di dalam /tmp secara otomatis
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

// 4. Jalankan aplikasi Laravel seperti biasa
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);