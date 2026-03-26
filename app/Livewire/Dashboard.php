<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Balita;
use App\Models\Alternatif;
use App\Models\Kriteria;

class Dashboard extends Component
{
    public $genderLabels = [];
    public $genderData = [];
    public $stuntingLabels = [];
    public $stuntingData = [];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        // Data Jenis Kelamin
        $jumLk = Balita::where('jenis_kelamin', 'L')->count();
        $jumPr = Balita::where('jenis_kelamin', 'P')->count();

        $this->genderLabels = ['Laki-laki', 'Perempuan'];
        $this->genderData = [$jumLk, $jumPr];

        // Grafik Resiko Stunting Tinggi
        $bobot = Kriteria::pluck('kriteria_bobot_normalisasi', 'kriteria_nama')->toArray();
        $tanggalList = Alternatif::select('tanggal_pengukuran')
            ->distinct()
            ->pluck('tanggal_pengukuran');

        $chartData = $tanggalList->map(function ($tanggal) use ($bobot) {
            $alternatif = Alternatif::with('balita')
                ->where('tanggal_pengukuran', $tanggal)
                ->get();

            $smart = hitungSmart($alternatif, $bobot);
            $jumlahTinggi = collect($smart['total_smart'])->where('ket', 'Tinggi')->count();

            return [
                'tanggal' => $tanggal,
                'jumlah_tinggi' => $jumlahTinggi,
            ];
        })->sortBy('tanggal')->values();

        // Persiapkan data untuk Line Chart
        $this->stuntingLabels = $chartData->pluck('tanggal')->map(function($date) {
            return \Carbon\Carbon::parse($date)->format('d M Y');
        })->toArray();
        
        $this->stuntingData = $chartData->pluck('jumlah_tinggi')->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
