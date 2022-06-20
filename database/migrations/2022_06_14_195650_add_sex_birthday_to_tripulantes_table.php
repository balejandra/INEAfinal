<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSexBirthdayToTripulantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->table('tripulantes', function (Blueprint $table) {
            $table->string('sexo')->nullable();
            $table->string('fecha_nacimiento')->nullable();
             

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
            $table->dropColumn('sexo');
            $table->dropColumn('fecha_nacimiento');
             

        });
    }
}
