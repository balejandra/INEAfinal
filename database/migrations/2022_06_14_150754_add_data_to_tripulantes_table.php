<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToTripulantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->table('tripulantes', function (Blueprint $table) {
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('tipo_doc')->nullable();
            $table->string('nro_doc')->nullable();
            $table->string('doc')->nullable();
            $table->string('rango')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_zarpes_schema')->table('tripulantes', function (Blueprint $table) {
            $table->dropColumn('nombres');
            $table->dropColumn('apellidos');
            $table->dropColumn('tipo_doc');
            $table->dropColumn('nro_doc');
            $table->dropColumn('doc');
            $table->dropColumn('rango');

        });
    }
}
