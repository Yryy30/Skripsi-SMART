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
            [1, 'Tinggi Badan / Umur', 'Benefit', 25, 0.25, '2025-05-17 10:46:30', '2026-01-12 21:28:22'],
            [2, 'Berat Badan / Umur', 'Benefit', 20, 0.20, '2025-05-17 10:47:36', '2026-01-12 21:28:22'],
            [3, 'Asi Eksklusif', 'Benefit', 15, 0.15, '2025-05-17 10:47:55', '2026-01-12 21:28:22'],
            [4, 'Makanan Pendamping Asi', 'Benefit', 20, 0.20, '2025-05-17 10:48:09', '2026-01-12 21:28:22'],
            [5, 'Sanitasi', 'Benefit', 10, 0.10, '2025-05-17 10:49:07', '2026-01-12 21:28:22'],
            [6, 'Riwayat Penyakit Infeksi', 'Cost', 10, 0.10, '2025-05-17 10:52:07', '2026-01-12 21:28:22'],
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
