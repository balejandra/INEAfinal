<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoSolicitudToPermisoEstadiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->table('permiso_estadias', function (Blueprint $table) {
            $table->string('cantidad_solicitud');
            $table->date('vencimiento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_zarpes_schema')->table('permiso_estadias', function (Blueprint $table) {
            $table->dropColumn('tipo_solicitud');
            $table->dropColumn('vencimiento');
        });
    }
}
