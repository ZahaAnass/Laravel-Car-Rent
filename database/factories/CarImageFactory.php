<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarImage>
 */
class CarImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $carFolders = [
            'Lexus-RX200t-2016',
        ];

        $folder = fake()->randomElement($carFolders);
        $imageNumber = fake()->numberBetween(1, 7);

        return [
            'image_path' => "/img/cars/{$folder}/{$imageNumber}.jpeg",
            'position' => $imageNumber,
        ];
    }
}
