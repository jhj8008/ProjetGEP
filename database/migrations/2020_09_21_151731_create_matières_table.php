<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatièresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matières', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->mediumText('description');
            $table->integer('coefficient');
            $table->integer('nbr_heures');
            $table->string('niveau_scolaire');
            $table->index(['nom','niveau_scolaire']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employe_matière');
        Schema::dropIfExists('matières');
    }
}
