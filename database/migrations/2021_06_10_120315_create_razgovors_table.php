<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRazgovorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('razgovors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('primaoc_id')->nullable()->constrained('users');
            $table->foreignId('posiljaoc_id')->nullable()->constrained('users');
            $table->string('tema',100)->charset('utf8mb4');
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
        Schema::dropIfExists('razgovors');
    }
}
