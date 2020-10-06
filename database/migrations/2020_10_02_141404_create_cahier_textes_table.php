<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCahierTextesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cahier_textes', function (Blueprint $table) {
            $table->id();
            $table->date('date_publication');
            $table->string('a_faire')->default('-');
            $table->string('fait')->default('-');
            $table->string('cours')->default('-');
            $table->string('niveau_scolaire')->default('-');
            $table->foreignId('employe_id')->constrained();
            $table->foreignId('classe_id')->constrained();
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
        Schema::dropIfExists('cahier_textes');
    }
}
