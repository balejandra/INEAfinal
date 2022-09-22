<?php

namespace App\Repositories\Zarpes;

use App\Models\Zarpes\CertificadoObligatorio;
use App\Repositories\BaseRepository;

/**
 * Class CertificadoObligatorioRepository
 * @package App\Repositories
 * @version September 19, 2022, 8:00 pm -04
*/

class CertificadoObligatorioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'parametro_embarcacion',
        'cantidad_comparacion',
        'nombre_certificado'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CertificadoObligatorio::class;
    }
}
