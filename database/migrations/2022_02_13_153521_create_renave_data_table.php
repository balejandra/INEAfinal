<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenaveDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_renave_schema')->create('renave_data', function (Blueprint $table) {
            $table->id();
            $table->string('numero_expediente');
            $table->string('nombrebuque_actual');
            $table->string('nombrebuque_anterior')
                ->nullable()
                ->default('no posee');
            $table->string('matricula_actual');
            $table->string('matricula_anterior')
                ->nullable()
                ->default('no posee');
            $table->string('indicativo_llamada')
                ->nullable()
                ->default('no posee');
            $table->string('destinacion')->nullable();
            $table->string('subclasificacion_pesquero')->nullable();
            $table->string('eslora')
                ->default('no posee');
            $table->string('manga')
                ->default('no posee');
            $table->string('puntal')
                ->default('no posee');
            $table->string('UAB')
                ->default('no posee');
            $table->string('UAN')
                ->default('no posee');
            $table->string('estatus_buque')
                ->default('operativo');
            $table->string('nombre_propietario')->nullable();
            $table->string('numero_identificacion')->nullable();
            $table->string('bandera')
                ->default('V');
            $table->string('bandera_origen')
                ->default('VENEZOLANA');
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
        Schema::connection('pgsql_renave_schema')->dropIfExists('renave_data');
    }
}
