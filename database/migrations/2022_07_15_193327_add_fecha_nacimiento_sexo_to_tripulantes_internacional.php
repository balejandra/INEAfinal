<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFechaNacimientoSexoToTripulantesInternacional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         
        Schema::connection('pgsql_zarpes_schema')->table('tripulante_internacionals', function (Blueprint $table) {
            $table->string('fecha_nacimiento')->nullable();
            $table->string('sexo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tripulante_internacionals', function (Blueprint $table) {
            $table->string('fecha_nacimiento')->nullable();
            $table->string('sexo')->nullable();
        });
    }
}
