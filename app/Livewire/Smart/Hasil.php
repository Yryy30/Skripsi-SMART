<?php

namespace App\Livewire\Smart;

use Livewire\Component;
use App\Models\Alternatif as AlternatifModel;
use Illuminate\Support\Facades\DB;

class Hasil extends Component
{
    public $selectedDate = '';
    public $tanggal_pengukuran = [];
    public $alternatif = [];

    public function mount()
    {
        $this->tanggal_pengukuran = AlternatifModel::select(DB::raw('DATE(tanggal_pengukuran) as tanggal'))
            ->distinct()
            ->orderBy('tanggal', 'desc')
            ->pluck('tanggal')
            ->toArray();
    }

    public function updatedSelectedDate($value)
    {
        $this->loadData($value);
    }

    public function loadData($date)
    {
        $this->alternatif = AlternatifModel::whereDate('tanggal_pengukuran', $date)->get();
    }

    public function render()
    {
        return view('livewire.smart.hasil');
    }
}
