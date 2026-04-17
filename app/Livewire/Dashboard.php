<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Balita;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $genderLabels    = [];
    public $genderData      = [];
    public $stuntingLabels  = [];
    public $stuntingData    = [];
    public $hasGenderData   = false;
    public $hasStuntingData = false;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->loadGenderData();
        $this->loadStuntingData();
    }

    private function loadGenderData()
    {
        $gender = Balita::selectRaw('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->pluck('total', 'jenis_kelamin');

        $this->genderLabels   = ['Laki-laki', 'Perempuan'];
        $this->genderData     = [$gender['L'] ?? 0, $gender['P'] ?? 0];
        $this->hasGenderData  = array_sum($this->genderData) > 0;
    }

    private function loadStuntingData()
    {
        $bobot = Kriteria::pluck('kriteria_bobot_normalisasi', 'kriteria_nama')->toArray();

        $semuaAlternatif = Alternatif::with('balita')
            ->orderBy('tanggal_pengukuran')
            ->get()
            ->groupBy('tanggal_pengukuran');

        if ($semuaAlternatif->isEmpty()) {
            $this->hasStuntingData = false;
            $this->stuntingLabels  = [];
            $this->stuntingData    = [];
            return;
        }

        $chartData = $semuaAlternatif->map(function ($alternatif, $tanggal) use ($bobot) {
            $smart        = hitungSmart($alternatif, $bobot);
            $jumlahTinggi = collect($smart['total_smart'])->where('ket', 'Tinggi')->count();

            return [
                'tanggal'       => $tanggal,
                'jumlah_tinggi' => $jumlahTinggi,
            ];
        })->values();

        $this->stuntingLabels  = $chartData->pluck('tanggal')
            ->map(fn($date) => Carbon::parse($date)->translatedFormat('d M Y'))
            ->toArray();
        $this->stuntingData    = $chartData->pluck('jumlah_tinggi')->toArray();
        $this->hasStuntingData = true;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
