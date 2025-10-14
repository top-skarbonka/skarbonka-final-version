<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies', 'banner_path')) {
                $table->string('banner_path')->nullable()->after('postal_code');
            }
        });
    }

    public function down(): void {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('banner_path');
        });
    }
};
