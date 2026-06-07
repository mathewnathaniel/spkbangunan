<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$brands = \App\Models\Brand::all(['id', 'name', 'image']);
foreach ($brands as $brand) {
    echo "ID: {$brand->id}, Name: {$brand->name}, Image: " . ($brand->image ?? 'NULL') . "\n";
}
