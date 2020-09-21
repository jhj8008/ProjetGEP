<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->default('-');
            $table->string('prénom')->default('-');
            $table->string('sexe')->default('-');
            $table->date('date_de_naissance')->nullable();
            $table->string('fonction')->default('-');
            $table->string('email')->unique();
            $table->string('password')->default('-');
            $table->string('adresse')->default('-');
            $table->string('tel')->default('-');
            $table->boolean('admin');
            $table->boolean('personnel');
            $table->boolean('enseignant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employes');
    }
}
