<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoPermisoZarpeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->create('equipo_permiso_zarpe', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permiso_zarpe_id');
            $table->foreign('permiso_zarpe_id')->references('id')->on('permiso_zarpes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('equipo_id');
            $table->foreign('equipo_id')->references('id')->on('equipos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('cantidad')->nullable();
            $table->string('otros')->nullable();
            $table->string('valores_otros')->nullable();
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
        Schema::connection('pgsql_zarpes_schema')->dropIfExists('equipo_permiso_zarpe');
    }
}
