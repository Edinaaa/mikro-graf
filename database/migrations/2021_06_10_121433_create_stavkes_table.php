<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStavkesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stavkes', function (Blueprint $table) {
            $table->id();
            $table->string('tekst',200)->charset('utf8mb4');
            $table->float('visina', 6, 2);
            $table->float('sirina', 6, 2); 
            $table->string('opis',200)->charset('utf8mb4'); 
            $table->float('cijena', 6, 2);
            $table->integer('kolicina');
            $table->foreignId('obliks_id')->nullable()->constrained();
            $table->foreignId('fonts_id')->nullable()->constrained();
            $table->foreignId('materijals_id')->nullable()->constrained();
            $table->foreignId('images_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('kategorijas_id')->constrained();
            $table->foreignId('proizvods_id')->nullable()->constrained()->onDelete('SET NULL');
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
        Schema::dropIfExists('stavkes');
    }
}
