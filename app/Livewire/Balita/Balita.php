<?php

namespace App\Livewire\Balita;

use Livewire\Component;
use App\Models\Balita as BalitaModel;
use Flux\Flux;

class Balita extends Component
{
    public $balita_id, $nama_balita, $jenis_kelamin, $tanggal_lahir, $alamat, $nama_orangtua;
    public $konfirmasiHapusId;

    protected $rules = [
        'nama_balita' => 'required',
        'jenis_kelamin' => 'required',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required',
        'nama_orangtua' => 'required',
    ];

    public function resetInputField()
    {
        $this->reset([
            'balita_id',
            'nama_balita',
            'jenis_kelamin',
            'tanggal_lahir',
            'alamat',
            'nama_orangtua',
        ]);
        $this->resetErrorBag();
    }

    public function tambahBalita()
    {
        $this->validate();

        BalitaModel::create([
            'nama_balita' => $this->nama_balita,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'nama_orangtua' => $this->nama_orangtua,
        ]);

        $this->resetInputField();
        Flux::modal('tambah-balita')->close();

        $this->dispatch('saved');
    }

    public function confirmHapus($id)
    {
        $this->konfirmasiHapusId = $id;
        Flux::modal('konfirmasi-hapus')->show();
    }

    public function hapusBalita()
    {
        $balita = BalitaModel::findOrFail($this->konfirmasiHapusId)->delete();
        $this->konfirmasiHapusId = null;

        Flux::modal('konfirmasi-hapus')->close();
        $this->dispatch('deleted');
    }

    public function render()
    {
        $balitas = BalitaModel::all();
        return view('livewire.balita.balita', [
            'balitas' => $balitas,
        ]);
    }
}
