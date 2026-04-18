<?php

namespace App\Livewire\Smart;

use Livewire\Component;
use App\Models\Alternatif as AlternatifModel;
use App\Models\Kriteria as KriteriaModel;

class Hasil extends Component
{
    public $selectedTanggal;
    public $daftar_tanggal = [];

    public $alternatif;
    public array $data_baku   = [];
    public array $utility     = [];
    public array $total_smart = [];

    public array $alternatif_plain = [];
    public array $detail_alternatif = [];

    public function mount()
    {
        $this->daftar_tanggal = AlternatifModel::select('tanggal_pengukuran')
            ->distinct()
            ->orderByDesc('tanggal_pengukuran')
            ->pluck('tanggal_pengukuran')
            ->toArray();
 
        $this->selectedTanggal = $this->daftar_tanggal[0] ?? null;
        $this->prosesSmart();
    }

    public function updatedSelectedTanggal()
    {
        $this->prosesSmart();
    }

    public function prosesSmart()
    {
        // Guard: tidak ada tanggal dipilih
        if (empty($this->selectedTanggal)) {
            $this->resetHasil();
            return;
        }

        $this->alternatif = AlternatifModel::with('balita')
            ->where('tanggal_pengukuran', $this->selectedTanggal)
            ->get();

        // Guard: tidak ada data untuk tanggal ini
        if ($this->alternatif->isEmpty()) {
            $this->resetHasil();
            return;
        }

        $this->alternatif_plain = $this->alternatif->map(fn($item) => [
            'alternatif_id'      => $item->alternatif_id,
            'nama_balita'        => $item->balita->nama_balita,
            'tanggal_pengukuran' => $item->tanggal_pengukuran,
            'umur_bulan'         => $item->umur_bulan,
            'tb'                 => $item->tb,
            'tb_zscore'          => $item->tb_zscore,
            'bb'                 => $item->bb,
            'bb_zscore'          => $item->bb_zscore,
            'asi'                => $item->asi,
            'mpasi'              => $item->mpasi,
            'sanitasi'           => $item->sanitasi,
            'riwayat_penyakit'   => $item->penyakit,
        ])->toArray();
 
        $bobot = KriteriaModel::pluck('kriteria_bobot_normalisasi', 'kriteria_nama')->toArray();
        $hasil = hitungSmart($this->alternatif, $bobot, ['alternatif_id']);
 
        $this->data_baku   = $hasil['data_baku']->values()->toArray();
        $this->utility     = $hasil['utility']->values()->toArray();
        $this->total_smart = $hasil['total_smart']->values()->toArray();
    }

    public function resetDataDetail()
    {
        $this->detail_alternatif = [];
    }

    public function showDetail($nama)
    {
        $this->detail_alternatif = [];
 
        $alternatif = collect($this->alternatif_plain)->firstWhere('nama_balita', $nama);
        $data_baku  = collect($this->data_baku)->firstWhere('nama', $nama);
        $utility    = collect($this->utility)->firstWhere('nama', $nama);
        $total      = collect($this->total_smart)->firstWhere('nama', $nama);
 
        if (!$alternatif || !$total) return;
 
        $this->detail_alternatif = [
            'alternatif' => $alternatif,
            'data_baku'  => $data_baku,
            'utility'    => $utility,
            'total'      => $total,
        ];
    }

    private function resetHasil(): void
    {
        $this->alternatif       = collect();
        $this->alternatif_plain = [];
        $this->data_baku        = [];
        $this->utility          = [];
        $this->total_smart      = [];
        $this->detail_alternatif = [];
    }

    public function render()
    {
        return view('livewire.smart.hasil');
    }
}
