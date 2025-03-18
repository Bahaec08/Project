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
        Schema::create('rent_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agop_id')->constrained('agoptions')->onDelete('cascade');
            $table->foreignId('rent_id')->constrained('rents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table(function (Blueprint $table){
            $table->dropConstrainedForeignId("rent_id");
        });

        Schema::dropIfExists('rent_options');
    }
};
