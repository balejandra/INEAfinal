<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFechaLlegadaEscalaToPermisoZarpeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->table('permiso_zarpes', function (Blueprint $table) {
            $table->dateTime('fecha_llegada_escala')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_zarpes_schema')->table('permiso_zarpes', function (Blueprint $table) {
            $table->dropColumn('fecha_llegada_escala');
        });
    }
}
