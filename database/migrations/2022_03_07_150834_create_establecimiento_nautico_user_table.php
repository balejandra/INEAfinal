<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablecimientoNauticoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->create('establecimiento_nautico_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('public.users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('establecimiento_nautico_id');
            $table->foreign('establecimiento_nautico_id')->references('id')->on('establecimiento_nauticos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::connection('pgsql_zarpes_schema')->dropIfExists('establecimiento_nautico_user');
    }
}
