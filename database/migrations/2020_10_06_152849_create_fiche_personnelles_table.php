<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichePersonnellesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiche_personnelles', function (Blueprint $table) {
            $table->id();
            $table->string('nationalité');
            $table->string('num_carte_sejour');
            $table->string('num_carte_travail');
            $table->string('situation_familiale');
            $table->string('num_sécurité_sociale');
            $table->string('code_postale');
            $table->string('ville');
            $table->string('qualification');
            $table->string('contrat');
            $table->string('durée');
            $table->float('salaire_mensuel');
            $table->date('date_entrée');
            $table->date('date_sortie');
            $table->string('situation_avant_enbauche');
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
        Schema::dropIfExists('fiche_personnelles');
    }
}
