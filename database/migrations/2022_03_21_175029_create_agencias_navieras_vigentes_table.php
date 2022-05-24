<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciasNavierasVigentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_vageneral_schema')->create('agencias_navieras_vigentes', function (Blueprint $table) {
            $table->increments('vasolicitude_id');
            $table->string('nomactv');
            $table->string('rifemp');
            $table->string('nomemp');
            $table->date('vencimiento_permiso');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_vageneral_schema')->dropIfExists('agencias_navieras_vigentes');
    }
}
