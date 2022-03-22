<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependenciasFederalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencias_federales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->bigInteger('capitania_id');
            $table->foreign('capitania_id')->references('id')->on('capitanias')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::dropIfExists('dependencias_federales');
    }
}
