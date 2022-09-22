<?php

namespace Database\Factories;

use App\Models\CertificadoObligatorio;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificadoObligatorioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CertificadoObligatorio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parametro_embarcacion' => $this->faker->word,
        'operador_logico' => $this->faker->word,
        'parametro_comparacion' => $this->faker->word,
        'nombre_certificado' => $this->faker->word
        ];
    }
}
