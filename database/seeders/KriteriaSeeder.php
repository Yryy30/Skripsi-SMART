<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [1, 'TB/U', 'Benefit', 30, 0.3, '2025-05-17 10:46:30', '2026-01-12 21:28:22'],
            [2, 'BB/U', 'Benefit', 25, 0.25, '2025-05-17 10:47:36', '2026-01-12 21:28:22'],
            [3, 'ASI', 'Benefit', 15, 0.15, '2025-05-17 10:47:55', '2026-01-12 21:28:22'],
            [4, 'MPASI', 'Benefit', 20, 0.20, '2025-05-17 10:48:09', '2026-01-12 21:28:22'],
            [5, 'SANITASI', 'Benefit', 10, 0.10, '2025-05-17 10:49:07', '2026-01-12 21:28:22'],
        ];

        foreach ($data as $item) {
            DB::table('tbl_kriteria')->insert([
                'kriteria_id'                   => $item[0],
                'kriteria_nama'                 => $item[1],
                'kriteria_atribut'              => $item[2],
                'kriteria_bobot'                => $item[3],
                'kriteria_bobot_normalisasi'    => $item[4],
                'created_at'                    => $item[5],
                'updated_at'                    => $item[6],
            ]);
        }
    }
}
