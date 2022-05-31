<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripulanteInternacionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('tripulante_internacionals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::connection('pgsql_zarpes_schema')->create('tripulante_internacionals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permiso_zarpe_id');
            $table->foreign('permiso_zarpe_id')->references('id')->on('permiso_zarpes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('funcion');
            $table->string('tipo_doc');
            $table->string('nro_doc');
            $table->string('rango');
            $table->string('doc');
         
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
        Schema::dropIfExists('tripulante_internacionals');
    }
}
