<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescripcionNavegacionIdToPermisoZarpesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->table('permiso_zarpes', function (Blueprint $table) {
            $table->unsignedBigInteger('descripcion_navegacion_id')->nullable();
            $table->foreign('descripcion_navegacion_id')->references('id')->on('descripcion_navegacion');
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
