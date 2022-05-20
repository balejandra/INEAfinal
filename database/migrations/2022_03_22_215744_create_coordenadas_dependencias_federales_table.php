<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordenadasDependenciasFederalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordenadas_dependencias_federales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dependencias_federales_id');
            $table->foreign('dependencias_federales_id', 'coordenadas_dependencias_federales_id_foreign')->references('id')->on('dependencias_federales')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->string('latitud');
            $table->string('longitud');
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
        Schema::dropIfExists('coordenadas_dependencias_federales');
    }
}
