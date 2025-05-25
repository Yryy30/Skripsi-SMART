<?php

namespace App\Livewire\Balita;

use App\Models\Balita as BalitaModel;
use App\Models\Alternatif as AlternatifModel;
use Livewire\Component;

class BalitaDetail extends Component
{
    public $balita;
    public $nama_balita, $jenis_kelamin, $tanggal_lahir, $alamat, $nama_orangtua;

    protected $rules = [
        'nama_balita' => 'required',
        'jenis_kelamin' => 'required',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required',
        'nama_orangtua' => 'required',
    ];

    public function mount($id)
    {
        $this->balita = BalitaModel::findOrFail($id);
        $this->nama_balita = $this->balita->nama_balita;
        $this->jenis_kelamin = $this->balita->jenis_kelamin;
        $this->tanggal_lahir = $this->balita->tanggal_lahir;
        $this->alamat = $this->balita->alamat;
        $this->nama_orangtua = $this->balita->nama_orangtua;
    }

    public function updateBalita()
    {
        $this->validate();

        $this->balita->update([
            'nama_balita' => $this->nama_balita,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'nama_orangtua' => $this->nama_orangtua,
        ]);

        flash()->success('Data balita berhasil diperbarui!');
    }

    public function render()
    {
        $alternatifs = AlternatifModel::where('balita_id', $this->balita->balita_id)->get();
        return view('livewire.balita.balita-detail', [
            'alternatifs' => $alternatifs,
        ]);
    }
}
