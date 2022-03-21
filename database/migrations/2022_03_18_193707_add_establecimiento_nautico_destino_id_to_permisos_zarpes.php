<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstablecimientoNauticoDestinoIdToPermisosZarpes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->table('permiso_zarpes', function (Blueprint $table) {
            $table->unsignedBigInteger('establecimiento_nautico_destino_id')->after('establecimiento_nautico_id')->nullable();
            $table->foreign('establecimiento_nautico_destino_id')->references('id')->on('establecimiento_nauticos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permiso_zarpes', function (Blueprint $table) {
            //
        });
    }
}
