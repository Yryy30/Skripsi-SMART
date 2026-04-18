<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LhfaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFilePath = public_path('lhfa_0-to-5-years_zscores.csv');
        if (($handle = fopen($csvFilePath, 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ',');

            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                DB::table('lhfa')->insert([
                    'month' => $data[0],
                    'gender' => $data[1],
                    'mean' => $data[2],
                    'sd' => $data[3],
                    'minus_3sd' => $data[4],
                    'minus_2sd' => $data[5],
                    'minus_1sd' => $data[6],
                    'median' => $data[7],
                    'plus_1sd' => $data[8],
                    'plus_2sd' => $data[9],
                    'plus_3sd' => $data[10],
                ]);
            }
            fclose($handle);
        }
    }
}
