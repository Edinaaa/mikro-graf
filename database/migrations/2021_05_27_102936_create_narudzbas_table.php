<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNarudzbasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('narudzbas', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->string('visina');
            $table->string('sirina');
            $table->string('opis');
            $table->foreignId('obliks_id')->nullable()->constrained();
            $table->foreignId('fonts_id')->constrained();
            $table->foreignId('materijals_id')->constrained();
            $table->string('cijena');//cijena narudzbe koja se moze naknadno dodati
           ///u slucaju da narudzbu kreira ne logirani korisnik
            $table->string('email',191)->nullable();
            $table->string('telefon')->nullable();

            $table->foreignId('narucilac_id')->nullable()->constrained('users');
            
            $table->foreignId('proizvods_id')->nullable()->constrained();
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
        Schema::dropIfExists('narudzbas');
    }
}
