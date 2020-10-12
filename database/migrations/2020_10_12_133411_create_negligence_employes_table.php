<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegligenceEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negligenceEmployes', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('durée')->default('-');
            $table->string('raison')->default('-');
            $table->string('période')->default('-'); // matin ou après-midi
            $table->string('type')->default('-'); // retard ou absence
            $table->foreignId('employe_id')->constrained();
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
        Schema::dropIfExists('negligenceEmployes');
    }
}
