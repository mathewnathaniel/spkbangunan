<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$results = App\Models\RankingResult::with('brand')->get();
if ($results->isEmpty()) {
    echo "No ranking results\n";
    exit;
}
foreach ($results as $r) {
    echo ($r->brand->name ?? 'Unknown') . ' => ' . ($r->final_score ?? 0) . ' (rank ' . ($r->ranking ?? '-') . ')\n';
}
