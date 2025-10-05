<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Dodanie kolumny client_id do tabeli points
     */
    public function up(): void
    {
        Schema::table('points', function (Blueprint $table) {
            if (!Schema::hasColumn('points', 'client_id')) {
                $table->string('client_id')->nullable()->after('company_id')->comment('ID klienta (z QR lub wpisane ręcznie)');
            }
        });
    }

    /**
     * Usunięcie kolumny client_id w razie rollbacka
     */
    public function down(): void
    {
        Schema::table('points', function (Blueprint $table) {
            if (Schema::hasColumn('points', 'client_id')) {
                $table->dropColumn('client_id');
            }
        });
    }
};
