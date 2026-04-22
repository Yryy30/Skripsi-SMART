<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BalitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            $rand = rand(1, 100);
            if ($rand <= 70) {
                $tgl_lahir = fake()->dateTimeBetween('-3 years', '-1 years');
            } elseif ($rand <= 85) {
                $tanggalLahir = fake()->dateTimeBetween('-1 years', 'now');
            } else {
                $tanggalLahir = fake()->dateTimeBetween('-5 years', '-3 years');
            }

            DB::table('tbl_balita')->insert([
                'nama_balita' => fake()->firstName(),
                'jenis_kelamin' => fake()->randomElement(['L', 'P']),
                'tanggal_lahir' => $tanggalLahir->format('Y-m-d'),
                'alamat' => fake()->address(),
                'nama_orangtua' => fake()->name(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
