<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePorukasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('porukas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posiljaoc_id')->nullable()->constrained('users');
            $table->foreignId('primaoc_id')->nullable()->constrained('users');
            $table->string('sadrzaj');
            $table->string('naslov');
            $table->string('email',191)->nullable();

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
        Schema::dropIfExists('porukas');
    }
}
