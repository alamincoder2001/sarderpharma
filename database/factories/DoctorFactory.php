<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->name(),
            'username'      => $this->faker->unique()->userName(),
            'email'         => $this->faker->safeEmail(),
            'image'         => "uploads/doctor/9171783.png",
            'city_id'       => rand(1, 64),
            'password'      => Hash::make('1'),
            'address'       => "Mirpur-10",
            'chamber_name'  => "Chamber Name",
            'availability'  => "sun,mon,tue,wed",
            'education'     => $this->faker->sentence(),
            'department_id' => $this->faker->numberBetween(1, 4),
            'hospital_id'   => $this->faker->numberBetween(1, 1000),
            'phone'         => $this->faker->numerify('017########'),
            'first_fee'     => $this->faker->numberBetween(600, 1000),
            'second_fee'    => $this->faker->numberBetween(600, 1000),
            'from'          => $this->faker->dateTime()->format('H:i'),
            'to'            => $this->faker->dateTime()->format('H:i'),
        ];
    }
}
