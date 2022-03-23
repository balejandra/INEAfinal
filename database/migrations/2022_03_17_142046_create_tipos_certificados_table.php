<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_seguridad_maritima')->create('tipos_certificados', function (Blueprint $table) {
            $table->id();
            $table->string('responsable')->nullable();
            $table->string('nro_correlativo');
            $table->string('nombre_buque');
            $table->string('matricula');
            $table->string('nombre_certificado');
            $table->string('fecha_expedicion')->nullable();
            $table->string('fecha_vencimiento')->nullable();
            $table->string('papel_seguridad')->nullable();
            $table->string('eslora_total')->nullable();
            $table->string('arqueo_bruto')->nullable();
            $table->string('nro_omi')->nullable();
            $table->string('propietario_armador')->nullable();
            $table->string('retirado_nom_ape_cedula')->nullable();
            $table->string('status')->nullable();
            $table->string('capacidad_personas')->nullable();
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
        Schema::dropIfExists('tipos_certificados');
    }
}
