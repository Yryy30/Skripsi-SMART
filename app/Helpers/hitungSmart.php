<?php

if (!function_exists('hitungSmart')) {
    /**
     * Hitung nilai SMART untuk deteksi risiko stunting
     *
     * @param \Illuminate\Support\Collection\array\ $alternatif  Koleksi model Alternatif (dengan relasi ->balita)
     * @param array $bobot
     * @return array {data_baku: Collection, utility: Collection, total_smart: Collection}
     * Semua Collection kosong jika $alternatif kosong.
     */
    function hitungSmart($alternatif, array $bobot): array
    {
        $alternatif = collect($alternatif);

        // Guard: kembalikan struktur kosong jika tidak ada data alternatif
        if ($alternatif->isEmpty()) {
            return [
                'data_baku'   => collect(),
                'utility'     => collect(),
                'total_smart' => collect(),
            ];
        }

        // Definisi kriteria: key_skor => [key_bobot, tipe, fungsi_skor]
        $kriteria = [
            'tb'       => ['bobot' => 'Tinggi Badan / Umur',        'tipe' => 'benefit', 'fn' => fn($i) => skor_zscore($i->tb_zscore)],
            'bb'       => ['bobot' => 'Berat Badan / Umur',         'tipe' => 'benefit', 'fn' => fn($i) => skor_zscore($i->bb_zscore)],
            'asi'      => ['bobot' => 'Asi Eksklusif',              'tipe' => 'benefit', 'fn' => fn($i) => skor_asi($i->asi)],
            'mpasi'    => ['bobot' => 'Makanan Pendamping Asi',     'tipe' => 'benefit', 'fn' => fn($i) => skor_mpasi($i->mpasi)],
            'sanitasi' => ['bobot' => 'Sanitasi',                   'tipe' => 'benefit', 'fn' => fn($i) => skor_sanitasi($i->sanitasi)],
            'penyakit' => ['bobot' => 'Riwayat Penyakit Infeksi',   'tipe' => 'cost',    'fn' => fn($i) => skor_penyakit($i->penyakit)],
        ];

        // Step 1: Hitung skor mentah
        $data_baku = $alternatif->map(function ($item) use ($kriteria) {
            $row = ['nama' => $item->balita->nama_balita];
            foreach ($kriteria as $key => $cfg) {
                $row["skor_{$key}"] = ($cfg['fn'])($item);
            }
            return $row;
        });

        // Step 2: Hitung min/max tiap kriteria
        $min_max = [];
        foreach ($kriteria as $key => $_) {
            $min_max[$key] = [
                'min' => $data_baku->min("skor_{$key}"),
                'max' => $data_baku->max("skor_{$key}"),
            ];
        }

        // Step 3: Hitung utility tiap kriteria
        $utility = $data_baku->map(function ($item) use ($kriteria, $min_max) {
            $row = ['nama' => $item['nama']];
            foreach ($kriteria as $key => $cfg) {
                $row["utility_{$key}"] = utility_smart(
                    $item["skor_{$key}"],
                    $min_max[$key]['min'],
                    $min_max[$key]['max'],
                    $cfg['tipe']
                );
            }
            return $row;
        });

        // Step 4: Total SMART, kategori & intervensi
        $total_smart = $utility->map(function ($item) use ($kriteria, $bobot) {
            $total = 0;
            foreach ($kriteria as $key => $cfg) {
                $total += ($item["utility_{$key}"] ?? 0) * ($bobot[$cfg['bobot']] ?? 0);
            }
            $total = round($total, 4);
 
            [$kategori, $intervensi] = match(true) {
                $total <= 0.50 => ['Tinggi',   'Rujukan, PMT, monitoring intensif'],
                $total <= 0.75 => ['Menengah', 'Edukasi, monitoring rutin'],
                default        => ['Rendah',   'Edukasi ringan, kontrol berkala'],
            };
 
            return [
                'nama'       => $item['nama'],
                'total'      => $total,
                'ket'        => $kategori,
                'intervensi' => $intervensi,
            ];
        });
 
        return [
            'data_baku'   => $data_baku,
            'utility'     => $utility,
            'total_smart' => $total_smart,
        ];
    }
}