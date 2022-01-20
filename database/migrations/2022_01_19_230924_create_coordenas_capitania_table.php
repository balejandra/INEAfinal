<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordenasCapitaniaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordenas_capitania', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('capitania_id');
            $table->foreign('capitania_id', 'fk_capitaniaid_coordenadas')->references('id')->on('capitanias')
                ->onDelete('restrict')
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
        Schema::dropIfExists('coordenas_capitania');
    }
}
