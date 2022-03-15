<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenciasTitulosGmarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_gente_de_mar')->create('licencias_titulos_gmar', function (Blueprint $table) {
            $table->id();
            $table->string('ci')->nullable();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('solicitud');
            $table->string('documento');
            $table->string('nro_ctrl');
            $table->date('fecha_solicitud');
            $table->dateTime('fecha_emision');
            $table->dateTime('fecha_vencimiento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_gente_de_mar')->dropIfExists('licencias_titulos_gmar');
    }
}
