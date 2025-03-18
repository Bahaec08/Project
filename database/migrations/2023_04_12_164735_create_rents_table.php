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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->date('startDate');
            $table->date('endDate');
            $table->dateTime('requestDate')->default(now());
            $table->json('extra')->nullable();
            $table->enum('status', ['waiting', 'success'])->default('waiting');
            $table->enum('method', ['cash', 'online'])->default('cash');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
            $table->unique(['startDate', 'car_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table(function (Blueprint $table){
            $table->dropConstrainedForeignId("car_id");
        });

        schema::table(function (Blueprint $table){
            $table->dropConstrainedForeignId("user_id");
        });

        Schema::dropIfExists('rents');
    }
};
