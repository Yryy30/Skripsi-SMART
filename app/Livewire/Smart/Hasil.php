<?php

namespace App\Livewire\Smart;

use Livewire\Component;
use App\Models\Alternatif as AlternatifModel;
use App\Models\Kriteria as KriteriaModel;
use Illuminate\Support\Facades\DB;

class Hasil extends Component
{
    public $alternatif = [];
    public $data_baku = [];
    public $utility = [];
    public $total_smart = [];

    public function mount()
    {
        $this->alternatif = AlternatifModel::where('tanggal_pengukuran', '2025-05-14')->get();
        $this->data_baku = $this->getDataBaku();
        $this->utility = $this->getUtility();
        $this->total_smart = $this->getTotalSmart();
    }

    private function getDataBaku()
    {
        $data_baku = [];

        foreach ($this->alternatif as $item) {
            $data_baku[] = [
                'nama' => $item->balita->nama_balita,
                'skor_tb' => skor_zscore($item->tb_zscore),
                'skor_bb' => skor_zscore($item->bb_zscore),
                'skor_asi' => skor_asi($item->asi),
                'skor_mpasi' => skor_mpasi($item->mpasi),
                'skor_sanitasi' => skor_sanitasi($item->sanitasi),
            ];
        }

        return $data_baku;
    }

    private function getUtility()
    {
        $utility = [];

        $min_max = [
            'tb' => [
                'min' => min(array_column($this->data_baku, 'skor_tb')),
                'max' => max(array_column($this->data_baku, 'skor_tb'))
            ],
            'bb' => [
                'min' => min(array_column($this->data_baku, 'skor_bb')),
                'max' => max(array_column($this->data_baku, 'skor_bb'))
            ],
            'asi' => [
                'min' => min(array_column($this->data_baku, 'skor_asi')),
                'max' => max(array_column($this->data_baku, 'skor_asi'))
            ],
            'mpasi' => [
                'min' => min(array_column($this->data_baku, 'skor_mpasi')),
                'max' => max(array_column($this->data_baku, 'skor_mpasi'))
            ],
            'sanitasi' => [
                'min' => min(array_column($this->data_baku, 'skor_sanitasi')),
                'max' => max(array_column($this->data_baku, 'skor_sanitasi'))
            ],
        ];

        foreach ($this->data_baku as $item) {
            $utility[] = [
                'nama' => $item['nama'],
                'utility_tb' => utility_smart($item['skor_tb'], $min_max['tb']['min'], $min_max['tb']['max']),
                'utility_bb' => utility_smart($item['skor_bb'], $min_max['bb']['min'], $min_max['bb']['max']),
                'utility_asi' => utility_smart($item['skor_asi'], $min_max['asi']['min'], $min_max['asi']['max']),
                'utility_mpasi' => utility_smart($item['skor_mpasi'], $min_max['mpasi']['min'], $min_max['mpasi']['max']),
                'utility_sanitasi' => utility_smart($item['skor_sanitasi'], $min_max['sanitasi']['min'], $min_max['sanitasi']['max']),
            ];
        }

        return $utility;
    }

    private function getTotalSmart()
    {
        $total_smart = [];

        // Ambil semua bobot dan buat array asosiatif berdasarkan nama kriteria
        $bobot = KriteriaModel::pluck('kriteria_bobot_normalisasi', 'kriteria_nama')->toArray();

        foreach ($this->utility as $item) {
            $total = 0;

            // Hitung total skor SMART dengan bobot
            $total += ($item['utility_tb'] ?? 0) * ($bobot['TB/U'] ?? 0);
            $total += ($item['utility_bb'] ?? 0) * ($bobot['BB/U'] ?? 0);
            $total += ($item['utility_asi'] ?? 0) * ($bobot['ASI'] ?? 0);
            $total += ($item['utility_mpasi'] ?? 0) * ($bobot['MPASI'] ?? 0);
            $total += ($item['utility_sanitasi'] ?? 0) * ($bobot['SANITASI'] ?? 0);

            // Klasifikasi berdasarkan risiko stunting
            if ($total <= 0.50) {
                $kategori = 'Tinggi'; // risiko stunting tinggi
            } elseif ($total <= 0.75) {
                $kategori = 'Menengah';
            } else {
                $kategori = 'Rendah'; // sehat, risiko rendah
            }

            $total_smart[] = [
                'nama' => $item['nama'],
                'total' => $total,
                'ket' => $kategori,
            ];
        }

        return $total_smart;
    }


    public function render()
    {
        return view('livewire.smart.hasil');
    }
}
