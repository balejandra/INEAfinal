<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMangaToPermisoEstadiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->table('permiso_estadias', function (Blueprint $table) {
            $table->string('manga');
            $table->string('puntal');
            $table->string('ultimo_puerto_zarpe');
            $table->bigInteger('establecimiento_nautico_id')->nullable();
            $table->foreign('establecimiento_nautico_id')->references('id')->on('zarpes.establecimiento_nauticos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_zarpes_schema')->table('permiso_estadias', function (Blueprint $table) {
            $table->dropColumn('manga');
            $table->dropColumn('puntal');
            $table->dropColumn('ultimo_puerto_zarpe');
            $table->dropColumn('establecimiento_nautico_id');
        });
    }
}
