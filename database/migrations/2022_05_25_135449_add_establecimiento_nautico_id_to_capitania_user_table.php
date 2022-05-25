<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstablecimientoNauticoIdToCapitaniaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('capitania_user', function (Blueprint $table) {
            //
            $table->bigInteger('establecimiento_nautico_id')->nullable();
            $table->foreign('establecimiento_nautico_id')->references('id')->on('zarpes.establecimiento_nauticos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('capitania_user', function (Blueprint $table) {
            //
        });
    }
}
