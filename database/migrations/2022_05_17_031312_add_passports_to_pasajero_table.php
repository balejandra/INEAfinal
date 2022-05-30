<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPassportsToPasajeroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::connection('pgsql_zarpes_schema')->table('pasajeros', function (Blueprint $table) {
            $table->string('pasaporte_menor')->nullable();
            $table->string('pasaporte_mayor')->nullable();
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pasajero', function (Blueprint $table) {
            //
        });
    }
}
