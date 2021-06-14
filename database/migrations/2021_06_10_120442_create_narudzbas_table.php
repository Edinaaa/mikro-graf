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
            $table->float('cijena',4,2);//cijena narudzbe koja se moze naknadno dodati
            ///u slucaju da narudzbu kreira ne logirani korisnik
             $table->string('email',191)->nullable();
             $table->string('telefon',15)->nullable();
             $table->foreignId('stanjes_id')->constrained();
             $table->foreignId('narucilac_id')->nullable()->constrained('users');
             
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
