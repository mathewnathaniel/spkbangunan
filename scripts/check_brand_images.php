<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Brand;

$brands = Brand::all();
if ($brands->isEmpty()) {
    echo "No brands found\n";
    exit;
}

foreach ($brands as $b) {
    $img = $b->image;
    $storagePath = storage_path('app/public/' . $img);
    $publicStoragePath = public_path('storage/' . $img);
    $existsStorage = file_exists($storagePath) ? 'YES' : 'NO';
    $existsPublic = file_exists($publicStoragePath) ? 'YES' : 'NO';
    echo "[{$b->id}] {$b->name}\n";
    echo "  image: " . ($img ?? 'NULL') . "\n";
    echo "  storage_path: {$storagePath} => {$existsStorage}\n";
    echo "  public/storage_path: {$publicStoragePath} => {$existsPublic}\n\n";
}
