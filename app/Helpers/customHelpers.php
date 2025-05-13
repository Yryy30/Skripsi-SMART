<?php

if (!function_exists('zscore_tb')) {
    /**
     * Hitung Z-Score tinggi badan per umur (TB/U)
     *
     * @param int $umur Umur dalam bulan
     * @param string $jk Jenis kelamin (L/P)
     * @param float $tb Tinggi badan anak
     * @param array $standarData Data standar TB/U dari Excel
     * @return float|null Nilai Z-Score atau null jika tidak ditemukan
     */
    function zscore_tb($umur, $jk, $tb, $standarData)
    {
        // Normalisasi jenis kelamin
        $jk = strtoupper($jk);

        // Cari data standar berdasarkan umur dan gender
        $data = collect($standarData)->first(function ($item) use ($umur, $jk) {
            return (int)$item['month'] === (int)$umur && strtoupper($item['gender']) === $jk;
        });

        if (!$data || !isset($data['mean']) || !isset($data['sd'])) {
            return null; // Data tidak ditemukan atau tidak lengkap
        }

        // Rumus Z-Score: (X - Mean) / SD
        $mean = (float) $data['mean'];
        $sd = (float) $data['sd'];

        return round(($tb - $mean) / $sd, 2);
    }
}

if (!function_exists('zscore_bb')) {
    /**
     * Hitung Z-Score Berat Badan per Umur (BB/U)
     *
     * @param int $umur Umur dalam bulan
     * @param string $jk Jenis kelamin (L/P)
     * @param float $bb Berat badan anak
     * @param array $standarData Data standar TB/U dari Excel
     * @return float|null
     */
    function zscore_bb_u($umur, $jk, $bb, $standarData)
    {
        $jk = strtoupper($jk);

        $data = collect($standarData)->first(function ($item) use ($umur, $jk) {
            return (int)$item['month'] === (int)$umur && strtoupper($item['gender']) === $jk;
        });

        if (!$data || !isset($data['mean']) || !isset($data['sd'])) {
            return null;
        }

        $mean = (float) $data['mean'];
        $sd = (float) $data['sd'];

        return round(($bb - $mean) / $sd, 2);
    }
}

if (!function_exists('skor_zscore')) {
    /**
     * Konversi data Z-Score ke dalam data baku
     * @param float $zscore TB/U atau BB/U
     * @return int|null
     */
    function skor_zscore($zscore)
    {
        if ($zscore > -1) return 5;                     // Normal
        if ($zscore <= -1 && $zscore >= -2) return 3;   // Risiko
        if ($zscore < -2) return 1;                     // Stunting
        return null;
    }
}

if (!function_exists('skor_asi')) {
    /**
     * Konversi data ASI ke dalam data baku
     * @param string $asi
     * @return int|null
     */
    function skor_asi($asi)
    {
        $asi = strtolower(trim($asi));
        return $asi === 'ya' ? 5 : 1;
    }
}

if (!function_exists('skor_sanitasi')) {
    /**
     * Konversi data Sanitasi ke dalam data baku
     * @param string $sanitasi
     * @return int|null
     */
    function skor_sanitasi($sanitasi)
    {
        $sanitasi = strtolower(trim($sanitasi));
        if ($sanitasi === 'layak') return 5;
        if ($sanitasi === 'sebagian layak') return 3;
        return 1;
    }
}

if (!function_exists('utility_smart')) {
    /**
     * Hitung utility SMART
     * @param int $c_out 
     */
    function utility_smart($c_out, $c_min, $c_max)
    {
        if ($c_max == $c_min) {
            return 1; // atau 0.5 default jika semua nilai sama
        }
        return round(($c_out - $c_min) / ($c_max - $c_min), 4);
    }
}

//  if (!function_exists('total_smart')) {

//      function total_utility_smart($skor_tb, $skor_bb, $skor_asi, $skor_sanitasi)
//      {
//         // Ambil nilai min & max per indikator dari data
//         $min_max = [
//             'tb' => ['min' => min(array_column($data, 'tb')), 'max' => max(array_column($data, 'tb'))],
//             'bb' => ['min' => min(array_column($data, 'bb')), 'max' => max(array_column($data, 'bb'))],
//             'asi' => ['min' => min(array_column($data, 'asi')), 'max' => max(array_column($data, 'asi'))],
//             'sanitasi' => ['min' => min(array_column($data, 'sanitasi')), 'max' => max(array_column($data, 'sanitasi'))],
//         ];

//         // Normalisasi dan hitung total SMART
//         foreach ($data as $row) {
//             $u_tb = utility_dynamic($row['tb'], $min_max['tb']['min'], $min_max['tb']['max']);
//             $u_bb = utility_dynamic($row['bb'], $min_max['bb']['min'], $min_max['bb']['max']);
//             $u_asi = utility_dynamic($row['asi'], $min_max['asi']['min'], $min_max['asi']['max']);
//             $u_sanitasi = utility_dynamic($row['sanitasi'], $min_max['sanitasi']['min'], $min_max['sanitasi']['max']);

//             $utility_total = round(
//                 ($u_tb * 0.3) + ($u_bb * 0.3) + ($u_asi * 0.2) + ($u_sanitasi * 0.2),
//                 4
//             );

//             // Simpan hasil
//             $results[] = [
//                 'nama' => $row['nama'],
//                 'utility_tb' => $u_tb,
//                 'utility_bb' => $u_bb,
//                 'utility_asi' => $u_asi,
//                 'utility_sanitasi' => $u_sanitasi,
//                 'utility_total' => $utility_total,
//                 'keterangan' => keterangan_utility($utility_total),
//             ];
//         }
//      }
// }