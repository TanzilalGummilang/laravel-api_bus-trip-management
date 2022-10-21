<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $number = mt_rand(1000, 9999);
        $gender = Driver::GENDER;
        return [
            'registration_number' => "$number-$number",
            'name' => fake()->name(),
            'phone' => "08".mt_rand(10,99)."-$number-$number",
            'address' => "jalan ".fake()->sentence(mt_rand(1,5)),
            'gender' => $gender[mt_rand(0,1)]
        ];
    }
}
