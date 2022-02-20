<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisoZarpesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->create('permiso_zarpes', function (Blueprint $table) {
            $table->id();
            $table->string('nro_solicitud');
            $table->foreignId('user_id')->constrained('public.users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('bandera');
            $table->string('matricula');
            $table->unsignedBigInteger('tipo_zarpe_id');
            $table->foreign('tipo_zarpe_id')->references('id')->on('tipo_zarpes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('establecimiento_nautico_id');
            $table->foreign('establecimiento_nautico_id')->references('id')->on('tipo_zarpes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('coordenadas');
            $table->foreignId('destino_capitania_id')->constrained('public.capitanias')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->dateTime('fecha_hora_salida');
            $table->dateTime('fecha_hora_regreso');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status')
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
        Schema::connection('pgsql_zarpes_schema')->dropIfExists('permiso_zarpes');
    }
}
