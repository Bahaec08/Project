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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string("carMark");
            $table->string("carModel");
            $table->integer("consumption");
            $table->Integer("Kilometrage");
            $table->enum("Gearbox", ['Manual', 'Automatic'])->default('Manual');
            $table->enum("petrolType", ['Essance', 'Disel'])->define('Essance');
            $table->string('photo')->default('car.png')->nullable();
            $table->integer("price")->nullable();
            $table->smallInteger("nofplaces");
            $table->foreignId('agency_id')->constrained('agencies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table(function (Blueprint $table){
            $table->dropConstrainedForeignId("agency_id");
        });

        Schema::dropIfExists('cars');
    }
};
