<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->enum('optionName', ['BabySeat', 'Luggage Handler', 'GPS']);
            $table->timestamps();
        });

        DB::insert('insert into options (optionName) values (?)',['BabySeat']);
        DB::insert('insert into options (optionName) values (?)',['Luggage Handler']);
        DB::insert('insert into options (optionName) values (?)',['GPS']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table(function (Blueprint $table){
            $table->dropConstrainedForeignId("agency_id");
        });

        Schema::dropIfExists('options');
    }
};
