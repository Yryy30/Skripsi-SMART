<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WfaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFilePath = public_path('wfa_0-to-5-years_zscores.csv');
        if (($handle = fopen($csvFilePath, 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ',');

            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                DB::table('wfa')->insert([
                    'month' => $data[0],
                    'gender' => $data[1],
                    'lambda' => $data[2],
                    'mean' => $data[3],
                    'sigma' => $data[4],
                    'sd' => $data[5],
                    'minus_3sd' => $data[6],
                    'minus_2sd' => $data[7],
                    'minus_1sd' => $data[8],
                    'median' => $data[9],
                    'plus_1sd' => $data[10],
                    'plus_2sd' => $data[11],
                    'plus_3sd' => $data[12],
                ]);
            }
            fclose($handle);
        }
    }
}
