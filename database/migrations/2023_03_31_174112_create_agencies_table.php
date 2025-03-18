<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('agencyName');
            $table->string('ownerName');
            $table->integer('phone');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->enum(
                'location', ['Ariana', 'Béja', 'Ben Arous', 'Bizerte', 'Gabès',
                'Gafsa', 'Jendouba', 'Kairouan', 'Kasserine', 'Kébili', 'Kef', 'Mahdia',
                'Manouba', 'Médenine', 'Monastir', 'Nabeul', 'Sfax', 'Sidi Bouzid', 'Siliana',
                'Sousse', 'Tataouine', 'Tozeur', 'Tunis', 'Zaghouan'])->nullable();
            $table->string('license')->nullable();
            $table->enum('status', ['pending', 'accepted'])->default('pending');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
