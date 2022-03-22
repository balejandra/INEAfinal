<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEsloraToPermisoEstadiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->table('permiso_estadias', function (Blueprint $table) {
            $table->string('eslora');
            $table->string('potencia_kw');
            $table->integer('cant_pasajeros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permiso_estadias', function (Blueprint $table) {
            //
        });
    }
}
