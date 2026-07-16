<?php

/**
 * VERCEL SERVERLESS SCRIPT
 * Memaksa Laravel menggunakan folder /tmp untuk semua aktivitas storage
 */

$newStoragePath = '/tmp/storage';

// Buat struktur folder framework yang dibutuhkan Laravel secara on-the-fly
$directories = [
    $newStoragePath . '/app/public',
    $newStoragePath . '/framework/cache/data',
    $newStoragePath . '/framework/sessions',
    $newStoragePath . '/framework/testing',
    $newStoragePath . '/framework/views',
    $newStoragePath . '/logs',
];

foreach ($directories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
}

// Timpa pengaturan storage bawaan
$_ENV['APP_STORAGE'] = $newStoragePath;
putenv('APP_STORAGE=' . $newStoragePath);

// Panggil file index bawaan public Laravel
require __DIR__ . '/../public/index.php';