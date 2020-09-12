<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElèveparentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elèveparents', function(Blueprint $table){
            $table->id();
            $table->string('nom_père');
            $table->string('nom_mère');
            $table->string('fonction_père');
            $table->string('fonction_mère');
            $table->string('tel');
            $table->string('email')->unique();
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elèveparents');
    }
}
