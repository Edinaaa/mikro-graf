<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKorpasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('korpas', function (Blueprint $table) {
            $table->id();
            $table->string('tekst',200)->charset('utf8mb4');
            $table->float('visina', 4, 2);
            $table->float('sirina', 4, 2); 
            $table->string('opis',200)->charset('utf8mb4'); 
            $table->float('cijena', 4, 2);
            $table->integer('kolicina');
            $table->foreignId('obliks_id')->nullable()->constrained();
            $table->foreignId('fonts_id')->nullable()->constrained();
            $table->foreignId('materijals_id')->constrained();
            $table->foreignId('images_id')->nullable()->constrained();
            $table->foreignId('artikals_id')->constrained();
            $table->foreignId('proizvods_id')->nullable()->constrained();
            $table->foreignId('narudzbas_id')->nullable()->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('korpas');
    }
}
