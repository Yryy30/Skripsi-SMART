<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balita as BalitaModel;
use App\Models\Alternatif as AlternatifModel;
use App\Models\Kriteria as KriteriaModel;

class DashboardController extends Controller
{
    public function index()
    {
        $jumLk = BalitaModel::where('jenis_kelamin', 'L')->count();
        $jumPr = BalitaModel::where('jenis_kelamin', 'P')->count();

        $labels = ['Laki-laki', 'Perempuan'];
        $data = [$jumLk, $jumPr];

        // Grafik Resiko Stunting Tinggi
        $bobot = KriteriaModel::pluck('kriteria_bobot_normalisasi', 'kriteria_nama')->toArray();
        $tanggalList = AlternatifModel::select('tanggal_pengukuran')->distinct()->pluck('tanggal_pengukuran');

        $chartData = $tanggalList->map(function ($tanggal) use ($bobot) {
            $alternatif = AlternatifModel::with('balita') // penting: eager load relasi
                ->where('tanggal_pengukuran', $tanggal)
                ->get();

            $smart = hitungSmart($alternatif, $bobot);
            $jumlahTinggi = collect($smart['total_smart'])->where('ket', 'Tinggi')->count();

            return [
                'tanggal' => $tanggal,
                'jumlah_tinggi' => $jumlahTinggi,
            ];
        })->sortBy('tanggal')->values();

        return view('dashboard', compact('labels', 'data', 'chartData'));
    }
}
