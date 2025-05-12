<?php

namespace App\Livewire\Balita;

use Livewire\Component;
use App\Models\Balita as BalitaModel;
use Flux\Flux;

class Balita extends Component
{
    public $balita_id, $nama_balita, $jenis_kelamin, $tanggal_lahir, $alamat, $nama_orangtua;

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

        flash()->success('Data balita ditambahkan!');
    }

    public function editBalita($balita_id)
    {
        $balita = BalitaModel::findOrFail($balita_id);

        $this->balita_id = $balita->balita_id;
        $this->nama_balita = $balita->nama_balita;
        $this->jenis_kelamin = $balita->jenis_kelamin;
        $this->tanggal_lahir = $balita->tanggal_lahir;
        $this->alamat = $balita->alamat;
        $this->nama_orangtua = $balita->nama_orangtua;
    }

    public function updateBalita()
    {
        $this->validate();

        $balita = BalitaModel::findOrFail($this->balita_id);
        $balita->update([
            'nama_balita' => $this->nama_balita,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'nama_orangtua' => $this->nama_orangtua,
        ]);

        $this->resetInputField();
        Flux::modals()->close();

        flash()->success('Data balita diubah!');
    }

    //Delete

    public function render()
    {
        $balitas = BalitaModel::all();
        return view('livewire.balita.balita', [
            'balitas' => $balitas,
        ]);
    }
}
