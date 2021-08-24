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
            $table->string('tekst',200)->charset('utf8mb4');
            $table->float('visina', 6, 2);
            $table->float('sirina', 6, 2);    
            $table->foreignId('obliks_id')->nullable()->constrained();
            $table->foreignId('fonts_id')->nullable()->constrained();
            $table->foreignId('materijals_id')->constrained();
            $table->float('cijena', 6, 2);
            $table->integer('popust');
            $table->boolean('novo');
            $table->boolean('aktivan');

            $table->foreignId('images_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('kategorijas_id')->constrained();

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
