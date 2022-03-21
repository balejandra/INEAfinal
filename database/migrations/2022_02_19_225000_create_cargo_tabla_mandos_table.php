<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoTablaMandosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->create('cargo_tabla_mandos', function (Blueprint $table) {
            $table->id();
            $table->string('cargo_desempena');
            $table->string('titulacion_aceptada_minima');
            $table->string('titulacion_aceptada_maxima');
            $table->unsignedBigInteger('tabla_mando_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tabla_mando_id')->references('id')->on('tabla_mandos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_zarpes_schema')->dropIfExists('cargo_tabla_mandos');
    }
}
