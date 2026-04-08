<?php

namespace App\Livewire\Smart;

use App\Models\Kriteria as ModelsKriteria;
use Flux\Flux;
use Livewire\Component;

class Kriteria extends Component
{
    public $kriterias = [];

    public function mount()
    {
        $this->kriterias = ModelsKriteria::all()->toArray();
    }

    public function updateBobot()
    {
        $totalInput = array_sum(array_column($this->kriterias, 'kriteria_bobot'));
        if ($totalInput != 100){
            flash()->error('Total bobot harus 100%!');
            return;
        }

        foreach ($this->kriterias as $kriteria) {
            ModelsKriteria::where('kriteria_id', $kriteria['kriteria_id'])
                ->update([
                    'kriteria_bobot' => $kriteria['kriteria_bobot'],
                ]);
        }

        $this->normalisasiBobot();
        $this->kriterias = ModelsKriteria::all()->toArray();

        Flux::modals()->close();
        flash()->success('Bobot berhasil diubah!');
    }

    protected function normalisasiBobot()
    {
        $total = array_sum(array_column($this->kriterias, 'kriteria_bobot'));
        foreach ($this->kriterias as $kriteria) {
            $normal = $total > 0 ? $kriteria['kriteria_bobot'] / $total : 0;
            ModelsKriteria::where('kriteria_id', $kriteria['kriteria_id'])
                ->update(['kriteria_bobot_normalisasi' => $normal]);
        }
    }

    public function render()
    {
        return view('livewire.smart.kriteria');
    }
}
