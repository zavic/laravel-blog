<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->word();
        $colors = ['red', 'green', 'cyan', 'purple', 'yellow', 'blue'];
        $randomColor = $colors[array_rand($colors)]; 
        return [
            'name' => ucfirst($name),
            'slug' => $name,
            'color' => $randomColor,
        ];
    }
}
