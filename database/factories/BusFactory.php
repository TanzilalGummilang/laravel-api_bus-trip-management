<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $number = mt_rand(1000, 9999);
        $alphabet = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $region = implode('', fake()->randomElements($alphabet, mt_rand(1,2)));
        $subRegion = implode('', fake()->randomElements($alphabet, 3));
        $busType = implode('', fake()->randomElements($alphabet, 4));
        $distributor = ['scania', 'hino', 'volvo', 'mercedes-benz'];

        return [
            'number_plate' => "$region $number $subRegion",
            'serial_number' => "$busType-$number-$number",
            'distributor' => $distributor[mt_rand(0, count($distributor)-1)],
            'number_of_seats' => mt_rand(20,60)
        ];
    }
}
