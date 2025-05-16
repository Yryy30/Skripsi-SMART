<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BalitaController extends Controller
{
    public function balitaDetail($id)
    {
        return view('pages.balita.balita-detail', ['id' => $id]);
    }
}
