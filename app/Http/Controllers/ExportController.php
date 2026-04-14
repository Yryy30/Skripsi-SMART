<?php

namespace App\Http\Controllers;

use App\Models\Alternatif as AlternatifModel;
use App\Models\Kriteria as KriteriaModel;
use Spatie\LaravelPdf\Facades\Pdf;

class ExportController extends Controller
{
    public function exportLaporan($tanggal)
    {
        $alternatif = AlternatifModel::where('tanggal_pengukuran', $tanggal)->get();

        // Hitung ulang seperti di Livewire
        $data_baku = collect($alternatif)->map(function ($item) {
            return [
                'nama' => $item->balita->nama_balita,
                'skor_tb' => skor_zscore($item->tb_zscore),
                'skor_bb' => skor_zscore($item->bb_zscore),
                'skor_asi' => skor_asi($item->asi),
                'skor_mpasi' => skor_mpasi($item->mpasi),
                'skor_sanitasi' => skor_sanitasi($item->sanitasi),
            ];
        });

        $min_max = [
            'tb' => ['min' => $data_baku->min('skor_tb'), 'max' => $data_baku->max('skor_tb')],
            'bb' => ['min' => $data_baku->min('skor_bb'), 'max' => $data_baku->max('skor_bb')],
            'asi' => ['min' => $data_baku->min('skor_asi'), 'max' => $data_baku->max('skor_asi')],
            'mpasi' => ['min' => $data_baku->min('skor_mpasi'), 'max' => $data_baku->max('skor_mpasi')],
            'sanitasi' => ['min' => $data_baku->min('skor_sanitasi'), 'max' => $data_baku->max('skor_sanitasi')],
        ];

        $utility = $data_baku->map(function ($item) use ($min_max) {
            return [
                'nama' => $item['nama'],
                'utility_tb' => utility_smart($item['skor_tb'], $min_max['tb']['min'], $min_max['tb']['max']),
                'utility_bb' => utility_smart($item['skor_bb'], $min_max['bb']['min'], $min_max['bb']['max']),
                'utility_asi' => utility_smart($item['skor_asi'], $min_max['asi']['min'], $min_max['asi']['max']),
                'utility_mpasi' => utility_smart($item['skor_mpasi'], $min_max['mpasi']['min'], $min_max['mpasi']['max']),
                'utility_sanitasi' => utility_smart($item['skor_sanitasi'], $min_max['sanitasi']['min'], $min_max['sanitasi']['max']),
            ];
        });

        $bobot = KriteriaModel::pluck('kriteria_bobot_normalisasi', 'kriteria_nama')->toArray();

        $total_smart = $utility->map(function ($item) use ($bobot) {
            $total = 0;
            $total += ($item['utility_tb'] ?? 0) * ($bobot['TB/U'] ?? 0);
            $total += ($item['utility_bb'] ?? 0) * ($bobot['BB/U'] ?? 0);
            $total += ($item['utility_asi'] ?? 0) * ($bobot['ASI'] ?? 0);
            $total += ($item['utility_mpasi'] ?? 0) * ($bobot['MPASI'] ?? 0);
            $total += ($item['utility_sanitasi'] ?? 0) * ($bobot['SANITASI'] ?? 0);

            $kategori = $total <= 0.50 ? 'Tinggi' : ($total <= 0.75 ? 'Menengah' : 'Rendah');

            if ($kategori === 'Tinggi') {
                $intervensi = 'Rujukan, PMT, monitoring intensif';
            } elseif ($kategori === 'Menengah') {
                $intervensi = 'Edukasi, monitoring rutin';
            } else {
                $intervensi = 'Edukasi ringan, kontrol berkala';
            }

            return [
                'nama' => $item['nama'],
                'total' => $total,
                'ket' => $kategori,
                'intervensi' => $intervensi,
            ];
        });

        return Pdf::view('pages.smart.laporan', [
            'tanggal' => $tanggal,
            'alternatif' => $alternatif,
            'total_smart' => $total_smart,
        ])->download("laporan_stunting_{$tanggal}.pdf");
        dd($alternatif, $data_baku, $utility,$total_smart);
    }

    public function exportDetail($id)
    {
        $alternatif = AlternatifModel::with('balita')->findOrFail($id);

        // Ambil semua data di tanggal yg sama (biar bisa hitung min-max)
        $all = AlternatifModel::where('tanggal_pengukuran', $alternatif->tanggal_pengukuran)->get();

        // DATA BAKU
        $data_baku = collect($all)->map(function ($item) {
            return [
                'id' => $item->alternatif_id,
                'nama' => $item->balita->nama_balita,
                'skor_tb' => skor_zscore($item->tb_zscore),
                'skor_bb' => skor_zscore($item->bb_zscore),
                'skor_asi' => skor_asi($item->asi),
                'skor_mpasi' => skor_mpasi($item->mpasi),
                'skor_sanitasi' => skor_sanitasi($item->sanitasi),
            ];
        });

        // MIN MAX
        $min_max = [
            'tb' => ['min' => $data_baku->min('skor_tb'), 'max' => $data_baku->max('skor_tb')],
            'bb' => ['min' => $data_baku->min('skor_bb'), 'max' => $data_baku->max('skor_bb')],
            'asi' => ['min' => $data_baku->min('skor_asi'), 'max' => $data_baku->max('skor_asi')],
            'mpasi' => ['min' => $data_baku->min('skor_mpasi'), 'max' => $data_baku->max('skor_mpasi')],
            'sanitasi' => ['min' => $data_baku->min('skor_sanitasi'), 'max' => $data_baku->max('skor_sanitasi')],
        ];

        // UTILITY
        $utility = $data_baku->map(function ($item) use ($min_max) {
            return [
                'id' => $item['id'],
                'utility_tb' => utility_smart($item['skor_tb'], $min_max['tb']['min'], $min_max['tb']['max']),
                'utility_bb' => utility_smart($item['skor_bb'], $min_max['bb']['min'], $min_max['bb']['max']),
                'utility_asi' => utility_smart($item['skor_asi'], $min_max['asi']['min'], $min_max['asi']['max']),
                'utility_mpasi' => utility_smart($item['skor_mpasi'], $min_max['mpasi']['min'], $min_max['mpasi']['max']),
                'utility_sanitasi' => utility_smart($item['skor_sanitasi'], $min_max['sanitasi']['min'], $min_max['sanitasi']['max']),
            ];
        });

        $bobot = KriteriaModel::pluck('kriteria_bobot_normalisasi', 'kriteria_nama')->toArray();

        // TOTAL SMART
        $total_smart = $utility->map(function ($item) use ($bobot) {
            $total = 0;
            $total += $item['utility_tb'] * ($bobot['TB/U'] ?? 0);
            $total += $item['utility_bb'] * ($bobot['BB/U'] ?? 0);
            $total += $item['utility_asi'] * ($bobot['ASI'] ?? 0);
            $total += $item['utility_mpasi'] * ($bobot['MPASI'] ?? 0);
            $total += $item['utility_sanitasi'] * ($bobot['SANITASI'] ?? 0);

            $kategori = $total <= 0.50 ? 'Tinggi' : ($total <= 0.75 ? 'Menengah' : 'Rendah');

            $intervensi = match ($kategori) {
                'Tinggi' => 'Rujukan, PMT, monitoring intensif',
                'Menengah' => 'Edukasi, monitoring rutin',
                default => 'Edukasi ringan, kontrol berkala',
            };

            return [
                'id' => $item['id'],
                'total' => $total,
                'ket' => $kategori,
                'intervensi' => $intervensi,
            ];
        });

        // ambil hanya 1 balita
        $hasil = $total_smart->firstWhere('id', $alternatif->alternatif_id);

        return Pdf::view('pages.smart.laporan-detail', [
            'alternatif' => $alternatif,
            'hasil' => $hasil
        ])->download("detail_{$alternatif->balita->nama_balita}.pdf");
    }
}
