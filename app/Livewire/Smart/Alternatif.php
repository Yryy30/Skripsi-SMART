<?php

namespace App\Livewire\Smart;

use App\Imports\ZscoreStandarImport;
use Livewire\Component;
use App\Models\Balita as BalitaModel;
use App\Models\Alternatif as AlternatifModel;
use Flux\Flux;
use Illuminate\Support\Facades\DB;

class Alternatif extends Component
{
    public $balitas;
    public $balita_id = ''; 
    public $tanggal_pengukuran, $tb, $bb, $asi, $mpasi, $sanitasi;
    public $umur_bulan, $tb_zscore, $bb_zscore;
    public $konfirmasiHapusId;
    public $filterTanggal = '';
    public $listTanggal = [];

    protected $rules = [
        'balita_id' => 'required',
        'tanggal_pengukuran' => 'required|date',
        'tb' => 'required|numeric',
        'bb' => 'required|numeric',
        'asi' => 'required',
        'mpasi' => 'required',
        'sanitasi' => 'required',
    ];

    public function resetInputField()
    {
        $this->reset([
            'balita_id',
            'tanggal_pengukuran',
            'tb',
            'bb',
            'asi',
            'mpasi',
            'sanitasi',
            'umur_bulan',
            'tb_zscore',
            'bb_zscore',
        ]);
        $this->resetErrorBag();
    }

    public function mount()
    {
        $this->balitas = BalitaModel::all();
        
        $this->listTanggal = AlternatifModel::select('tanggal_pengukuran')
            ->distinct()
            ->orderBy('tanggal_pengukuran', 'asc')
            ->pluck('tanggal_pengukuran')
            ->toArray();
    }

    public function tambahAlternatif()
    {
        $this->validate();

        $balita = BalitaModel::findOrFail($this->balita_id);

        // Menghitung umur balita dalam bulan
        $dateDiff = date_diff(date_create($balita->tanggal_lahir), date_create($this->tanggal_pengukuran));
        $this->umur_bulan = ($dateDiff->y * 12) + $dateDiff->m;

        // Menghitung z-score TB dan BB
        $this->tb_zscore = $this->hitungTb($this->umur_bulan, $balita->jenis_kelamin, $this->tb);
        $this->bb_zscore = $this->hitungBb($this->umur_bulan, $balita->jenis_kelamin, $this->bb);
    
        // Simpan data
        AlternatifModel::create([
            'balita_id' => $this->balita_id,
            'tanggal_pengukuran' => $this->tanggal_pengukuran,
            'umur_bulan' => $this->umur_bulan,
            'tb' => $this->tb,
            'bb' => $this->bb,
            'tb_zscore' => $this->tb_zscore,
            'bb_zscore' => $this->bb_zscore,
            'asi' => $this->asi,
            'mpasi' => $this->mpasi,
            'sanitasi' => $this->sanitasi,
        ]);

        $this->resetInputField();
        Flux::modal('tambah-alternatif')->close();

        flash()->success('Data Alternatif ditambahkan!');
    }

    public function hitungTb($umur_bulan, $jenis_kelamin, $tb)
    {
        $standarData = DB::table('lhfa')
            ->where('month', (int)$umur_bulan)
            ->where('gender', strtoupper($jenis_kelamin))
            ->first();
        
        if (!$standarData) {
            return null; 
        }

        return zscore_tb($tb, $standarData);
    }

    public function hitungBb($umur_bulan, $jenis_kelamin, $bb)
    {
        $standarData = DB::table('wfa')
            ->where('month', (int)$umur_bulan)
            ->where('gender', strtoupper($jenis_kelamin))
            ->first();
        
        if (!$standarData) {
            return null; 
        }

        return zscore_bb($bb, $standarData);
    }

    public function confirmHapus($id)
    {
        $this->konfirmasiHapusId = $id;
        Flux::modal('konfirmasi-hapus')->show();
    }

    public function hapusAlternatif()
    {
        $balita = AlternatifModel::findOrFail($this->konfirmasiHapusId)->delete();
        $this->konfirmasiHapusId = null;

        Flux::modal('konfirmasi-hapus')->close();
        flash()->success('Data Alternatif Dihapus!');
    }

    public function render()
    {
        $alternatifs = AlternatifModel::when($this->filterTanggal, function ($query) {
                $query->whereDate('tanggal_pengukuran', $this->filterTanggal);
            })
            ->orderBy('tanggal_pengukuran', 'asc')
            ->get();

        return view('livewire.smart.alternatif', [
            'alternatifs' => $alternatifs,
        ]);
    }
}
