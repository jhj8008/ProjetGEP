<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSéancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('séances', function (Blueprint $table) {
            $table->id();
            $table->string('jour');
            $table->string('heure_début');
            $table->string('heure_fin');
            $table->string('description');
            $table->foreignId('employe_id')->constrained();
            $table->foreignId('matière_id')->constrained();
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
        Schema::dropIfExists('séances');
    }
}
