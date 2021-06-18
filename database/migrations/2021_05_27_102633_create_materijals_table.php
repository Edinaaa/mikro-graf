<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterijalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materijals', function (Blueprint $table) {
            $table->id();
            $table->string('naziv',30)->charset('utf8mb4');
            $table->foreignId('kreirao_id')->constrained('users');
            $table->foreignId('images_id')->constrained();
            $table->float('visina', 4, 2);
            $table->float('sirina', 4, 2); 
            $table->boolean('aktivan'); 
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
        Schema::dropIfExists('materijals');
    }
}
