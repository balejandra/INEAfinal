<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaisesIdToPermisoZarpes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->table('permiso_zarpes', function (Blueprint $table) {
            $table->bigInteger('paises_id')->nullable();
            $table->foreign('paises_id')->references('id')->on('public.paises');
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
            $table->dropColumn('paises_id');
        });
    }
}
