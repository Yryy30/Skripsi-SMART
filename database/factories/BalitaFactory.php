<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Balita>
 */
class BalitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rand = rand(1, 100);

        if ($rand <= 70) {
            $tanggalLahir = fake()->dateTimeBetween('-3 years', '-1 years');
        } elseif ($rand <= 85) {
            $tanggalLahir = fake()->dateTimeBetween('-1 years', 'now');
        } else {
            $tanggalLahir = fake()->dateTimeBetween('-5 years', '-3 years');
        }

        return [
            'nama_balita' => fake()->firstName(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'tanggal_lahir' => $tanggalLahir->format('Y-m-d'),
            'alamat' => fake()->address(),
            'nama_orangtua' => fake()->name(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
