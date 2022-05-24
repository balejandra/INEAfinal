<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilesRepresentanteToPasajeroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->table('pasajeros', function (Blueprint $table) {
            $table->string('representante')->nullable();
            $table->string('partida_nacimiento')->nullable();
            $table->string('autorizacion')->nullable();
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pasajeros', function (Blueprint $table) {
            //
        });
    }
}
