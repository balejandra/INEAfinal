<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPermisoEstadiaIdToPermisoZarpesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->table('permiso_zarpes', function (Blueprint $table) {
            $table->bigInteger('permiso_estadia_id')->nullable();
            $table->foreign('permiso_estadia_id')->references('id')->on('permiso_estadias')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_zarpes_schema')->table('permiso_zarpes', function (Blueprint $table) {
            $table->dropColumn('permiso_estadia_id');
        });
    }
}
