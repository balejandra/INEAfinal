<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'description' => $this->faker->word,
        'url' => $this->faker->word,
        'parent' => $this->faker->randomDigitNotNull,
        'order' => $this->faker->randomDigitNotNull,
        'icono' => $this->faker->word,
        'enabled' => $this->faker->word
        ];
    }
}
