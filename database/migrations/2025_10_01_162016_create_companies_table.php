<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_code')->nullable();   // unikalny kod firmy (np. ME482)
            $table->string('name')->nullable();           // nazwa firmy
            $table->string('postal_code')->nullable();    // kod pocztowy
            $table->string('city')->nullable();           // miasto
            $table->string('street')->nullable();         // ulica i numer
            $table->string('nip')->nullable();            // nip
            $table->string('email')->nullable();          // email
            $table->string('phone')->nullable();          // telefon
            $table->string('password')->nullable();       // hasło (zahashowane)
            $table->string('status')->nullable();         // active / suspended
            $table->timestamps();
            $table->softDeletes();                        // do soft delete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
