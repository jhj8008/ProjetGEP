<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElèvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elèves', function(Blueprint $table){
            $table->id();
            $table->string('nom')->default('-');
            $table->string('prénom')->default('-');
            $table->string('sexe')->default('-');
            $table->date('date_de_naissance')->nullable();
            $table->string('niveau_scolaire');
            $table->unsignedInteger('parent_id');
            $table->unsignedInteger('classe_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('elèves');
    }
}
