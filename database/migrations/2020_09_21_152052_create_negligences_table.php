<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegligencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negligences', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('durée')->default('-');
            $table->string('raison')->default('-');
            $table->string('période')->default('-'); // matin ou après-midi
            $table->string('type')->default('-'); // retard ou absence
            $table->foreignId('employe_id')->constrained();
            $table->foreignId('elève_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negligences');
    }
}
