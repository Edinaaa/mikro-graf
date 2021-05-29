<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProizvodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proizvods', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->string('visina');
            $table->string('sirina');    
            $table->foreignId('obliks_id')->nullable()->constrained();
            $table->foreignId('fonts_id')->constrained();
            $table->foreignId('materijals_id')->constrained();
            $table->string('cijena');
            $table->string('popust');
            $table->string('novo');
            $table->foreignId('images_id')->constrained();
            $table->foreignId('kreirao_id')->constrained('users');

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
        Schema::dropIfExists('proizvods');
    }
}
