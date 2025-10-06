<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            if (!Schema::hasColumn('clients', 'client_code')) {
                $table->string('client_code', 20)->nullable()->after('email');
            }

            if (!Schema::hasColumn('clients', 'postal_code')) {
                $table->string('postal_code', 10)->nullable()->after('client_code');
            }

            if (!Schema::hasColumn('clients', 'city')) {
                $table->string('city', 100)->nullable()->after('postal_code');
            }

            if (!Schema::hasColumn('clients', 'phone')) {
                $table->string('phone', 20)->nullable()->after('city');
            }

            if (!Schema::hasColumn('clients', 'birth_date')) {
                $table->date('birth_date')->nullable()->after('phone');
            }

            if (!Schema::hasColumn('clients', 'gender')) {
                $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('birth_date');
            }

            if (!Schema::hasColumn('clients', 'consent_sms')) {
                $table->boolean('consent_sms')->default(false)->after('gender');
            }

            if (!Schema::hasColumn('clients', 'consent_email')) {
                $table->boolean('consent_email')->default(false)->after('consent_sms');
            }

            if (!Schema::hasColumn('clients', 'consent_personal')) {
                $table->boolean('consent_personal')->default(false)->after('consent_email');
            }
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'client_code',
                'postal_code',
                'city',
                'phone',
                'birth_date',
                'gender',
                'consent_sms',
                'consent_email',
                'consent_personal',
            ]);
        });
    }
};
