<?php

namespace App\Models\Sgm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposCertificado extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_seguridad_maritima';
    public $table = 'sgm.tipos_certificados';

     public $fillable = [
        'responsable',
        'nro_correlativo',
        'nombre_buque',
        'matricula',
        'nombre_certificado',
        'fecha_expedicion',
        'fecha_vencimiento',
        'papel_seguridad',
        'eslora_total',
        'arqueo_bruto',
        'potencia_kw',
        'nro_omi',
        'propietario_armador',
        'retirado_nom_ape_cedula',
        'status',
        'capacidad_personas'
    ];


    protected $casts = [
        'id' => 'integer',
        'responsable'=> 'string',
        'nro_correlativo'=> 'string',
        'nombre_buque'=> 'string',
        'matricula'=> 'string',
        'nombre_certificado'=> 'string',
        'fecha_expedicion'=> 'string',
        'fecha_vencimiento'=> 'string',
        'papel_seguridad'=> 'string',
        'eslora_total'=> 'string',
        'arqueo_bruto'=> 'string',
        'potencia_kw'=> 'string',
        'nro_omi'=> 'string',
        'propietario_armador'=> 'string',
        'retirado_nom_ape_cedula'=> 'string',
        'status'=> 'boolean',
        'capacidad_personas'=> 'integer'
    ];



}
