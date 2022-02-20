<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZarpeRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->create('zarpe_revisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('capitania_user_id')->constrained('public.capitania_user')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('permiso_zarpe_id');
            $table->foreign('permiso_zarpe_id')->references('id')->on('permiso_zarpes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('accion');
            $table->string('motivo');
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
        Schema::connection('pgsql_zarpes_schema')->dropIfExists('zarpe_revisions');
    }
}
