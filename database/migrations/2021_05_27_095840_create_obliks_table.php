<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObliksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obliks', function (Blueprint $table) {
            $table->id();
            $table->string('naziv',30)->charset('utf8mb4');
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
        Schema::dropIfExists('obliks');
    }
}
