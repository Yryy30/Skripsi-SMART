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
        $faker = \fake();
        
        for ($i = 0; $i < 20; $i++) {
            $rand = rand(1, 100);
            if ($rand <= 70) {
                $tanggalLahir = $faker->dateTimeBetween('-3 years', '-1 years');
            } elseif ($rand <= 85) {
                $tanggalLahir = $faker->dateTimeBetween('-1 years', 'now');
            } else {
                $tanggalLahir = $faker->dateTimeBetween('-5 years', '-3 years');
            }

            DB::table('tbl_balita')->insert([
                'nama_balita' => $faker->firstName(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'tanggal_lahir' => $tanggalLahir->format('Y-m-d'),
                'alamat' => $faker->address(),
                'nama_orangtua' => $faker->name(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
