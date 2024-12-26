<?php

namespace Database\Factories;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Anggota>
 */
class AnggotaFactory extends Factory
{
    protected $model = Anggota::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name(), // Generate a random name
            'alamat' => $this->faker->address(), // Generate a random address
            'noHP' => $this->faker->phoneNumber(), // Generate a phone number
            'username' => $this->faker->unique()->userName(), // Unique username using faker
            'password' => bcrypt('Password@123'), // Default password, hashed
        ];
    }
}