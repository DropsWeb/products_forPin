<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ARTICLE' => $this->faker->numerify('##########'),
            'NAME' => $this->faker->name(),
            'STATUS' => "available",
            'DATA' => '{"1":{"name":"\u0412\u0435\u0441","value":"1\u043a\u0433"},"3":{"name":"\u0426\u0432\u0435\u0442","value":"\u0421\u0438\u043d\u0438\u0439"}}'
        ];
    }
}
