<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{

    public function definition(): array
    {
        return [
            'category_id' => rand(1,5),
            'name' =>[
                'uz' => fake()->sentence(3),
                'ru' => 'komplekt spalniy',
            ],
            'price' => rand(50000,1000000),
            'description' => [
                'uz' => fake()->sentence(5),
                'ru' =>'ruscha matin',
            ],
        ];
    }
}
