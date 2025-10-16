<?php

use Illuminate\Support\Facades\DB;
use App\Models\Admin;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "✅ Połączenie z bazą: " . config('database.connections.mysql.database') . PHP_EOL;

$admins = Admin::all();
if ($admins->isEmpty()) {
    echo "⚠️  Brak rekordów w tabeli admins.\n";
} else {
    foreach ($admins as $admin) {
        echo "🧑‍💼 {$admin->name} ({$admin->email})\n";
    }
}
