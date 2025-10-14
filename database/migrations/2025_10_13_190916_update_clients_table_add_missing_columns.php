<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            if (!Schema::hasColumn('clients', 'postal_code')) {
                $table->string('postal_code')->nullable();
            }
            if (!Schema::hasColumn('clients', 'city')) {
                $table->string('city')->nullable();
            }
            if (!Schema::hasColumn('clients', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('clients', 'birth_year')) {
                $table->integer('birth_year')->nullable();
            }
            if (!Schema::hasColumn('clients', 'gender')) {
                $table->string('gender')->nullable();
            }
            if (!Schema::hasColumn('clients', 'client_code')) {
                $table->string('client_code', 10)->unique();
            }
            if (!Schema::hasColumn('clients', 'points')) {
                $table->integer('points')->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'postal_code',
                'city',
                'phone',
                'birth_year',
                'gender',
                'client_code',
                'points'
            ]);
        });
    }
};
