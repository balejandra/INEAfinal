<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordenadasCapitaniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordenadas_capitanias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('capitania_id');
            $table->foreign('capitania_id')->references('id')->on('capitanias')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->string('latitud');
            $table->string('longitud');
            $table->unsignedInteger('orden')->nullable();
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
        Schema::dropIfExists('coordenadas_capitanias');
    }
}
