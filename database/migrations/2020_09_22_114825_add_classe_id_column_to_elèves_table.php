<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClasseIdColumnToElèvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('elèves', function(Blueprint $table){
            $table->foreignId('classe_id')->constrained();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('elèves', function(Blueprint $table){
            $table->dropColumn('classe_id');
        });
    }
}
