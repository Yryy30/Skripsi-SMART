<?php

namespace App\Http\Controllers;

use App\Models\Alternatif as AlternatifModel;
use App\Models\Kriteria as KriteriaModel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    private function getBobot()
    {
        return KriteriaModel::pluck('kriteria_bobot_normalisasi', 'kriteria_nama')->toArray();
    }

    private function runSmart($alternatif, array $bobot, array $extraKeys = [])
    {
        return hitungSmart($alternatif, $bobot, $extraKeys)['total_smart'];
    }

    public function exportLaporan(string $tanggal)
    {
        $alternatif  = AlternatifModel::with('balita')->where('tanggal_pengukuran', $tanggal)->get();
        $total_smart = $this->runSmart($alternatif, $this->getBobot());
 
        return Pdf::loadView('pages.smart.laporan', [
            'tanggal'     => $tanggal,
            'alternatif'  => $alternatif,
            'total_smart' => $total_smart,
        ])->setPaper('a4', 'landscape')->download("laporan_stunting_{$tanggal}.pdf");
    }

    public function exportDetail(int $id)
    {
        $alternatif = AlternatifModel::with('balita')->findOrFail($id);
 
        $all = AlternatifModel::with('balita')
            ->where('tanggal_pengukuran', $alternatif->tanggal_pengukuran)
            ->get();
 
        $total_smart = $this->runSmart($all, $this->getBobot(), ['alternatif_id']);
 
        $hasil = $total_smart->firstWhere('alternatif_id', $alternatif->alternatif_id);
 
        return Pdf::loadView('pages.smart.laporan-detail', [
            'alternatif' => $alternatif,
            'hasil'      => $hasil,
        ])->setPaper('a4', 'landscape')->download("detail_{$alternatif->balita->nama_balita}.pdf");
    }
}
