<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasajerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->create('pasajeros', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('tipo_doc');
            $table->string('nro_doc');
            $table->string('sexo');
            $table->date('fecha_nacimiento');
            $table->boolean('menor_edad');
            $table->unsignedBigInteger('permiso_zarpe_id');
            $table->foreign('permiso_zarpe_id')->references('id')->on('permiso_zarpes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_zarpes_schema')->dropIfExists('pasajeros');
    }
}
