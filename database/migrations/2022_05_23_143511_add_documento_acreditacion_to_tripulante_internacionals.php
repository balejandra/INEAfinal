<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentoAcreditacionToTripulanteInternacionals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->table('tripulante_internacionals', function (Blueprint $table) {
            $table->string('documento_acreditacion')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_zarpes_schema')->table('tripulante_internacionals', function (Blueprint $table) {
            //
        });
    }
}
