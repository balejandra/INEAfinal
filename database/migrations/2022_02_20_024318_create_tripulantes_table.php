<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripulantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->create('tripulantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permiso_zarpe_id');
            $table->foreign('permiso_zarpe_id')->references('id')->on('permiso_zarpes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('ctrl_documento_id');
            $table->boolean('capitan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_zarpes_schema')->dropIfExists('tripulantes');
    }
}
