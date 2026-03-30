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
        $data = [
            [1,'ALVARO KENZIE DEVANNA','L','2024-10-10','RT 05','ANA','2025-09-10 19:09:22','2025-09-10 19:12:24'],
            [2,'AZZURA N. R.','P','2023-08-15','RT 05','ADLA','2025-09-10 19:10:46','2025-09-10 19:12:41'],
            [3,'DELIA AMELIA P.','P','2021-06-20','RT 05','RIZKI','2025-09-10 19:12:08','2025-09-10 19:12:08'],
            [4,'ERDANA','L','2023-02-05','RT 04','ANGGI','2025-09-10 19:13:46','2025-09-10 19:13:46'],
            [5,'M. HAFIDZ ALFATIH','L','2024-11-06','RT 04','LILIS','2025-09-10 19:14:41','2025-09-10 19:14:41'],
            [6,'M. RASYID FADHILAH','L','2022-04-14','RT 05','DEWI','2025-09-10 19:15:50','2025-09-10 19:15:50'],
            [7,'NADIRA ZIA S.','P','2022-01-31','RT 02','RIA H.','2025-09-10 19:16:56','2025-09-10 19:16:56'],
            [8,'RACHEL NADIA A.','P','2021-03-22','RT 04','EKO','2025-09-10 19:18:10','2025-09-10 19:18:10'],
            [9,'ZAURA MAZAYA X.','P','2022-11-10','RT 02','TIARA','2025-09-10 19:18:58','2025-09-10 19:18:58'],
            [10,'M. KAILANDRA A.','L','2025-02-01','RT 02','ISNA NIA','2025-09-10 19:19:54','2025-09-10 19:19:54'],
        ];

        foreach ($data as $item) {
            DB::table('tbl_balita')->insert([
                'balita_id'             => $item[0],
                'nama_balita'           => $item[1],
                'jenis_kelamin'         => $item[2],
                'tanggal_lahir'         => $item[3],
                'alamat'                => $item[4],
                'nama_orangtua'         => $item[5],
                'created_at'            => $item[6],
                'updated_at'            => $item[7],
            ]);
        }
    }
}
