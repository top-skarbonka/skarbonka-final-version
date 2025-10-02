<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies', 'status')) {
                $table->string('status')->default('active')->after('phone');
            }
            if (!Schema::hasColumn('companies', 'deleted_at')) {
                $table->softDeletes(); // obsługa soft delete
            }
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            if (Schema::hasColumn('companies', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('companies', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};
