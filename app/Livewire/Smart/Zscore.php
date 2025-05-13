<?php

namespace App\Livewire\Smart;

use App\Imports\ZscoreStandarImport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Zscore extends Component
{
   
    public function coba()
    {
        $filepath1 = public_path('lhfa_0-to-5-years_zscores.xlsx');
        $filepath2 = public_path('wfa_0-to-5-years_zscores.xlsx');
        $data1 = Excel::toArray(new ZscoreStandarImport, $filepath1);
        $data2 = Excel::toArray(new ZscoreStandarImport, $filepath2);

        $standarData1 = $data1[0];
        $standarData2 = $data2[0];

        $umur = 25;
        $jk = 'F';
        $tb = 88;
        $bb = 13.5;

        $zscore = zscore_tb($umur, $jk, $tb, $standarData1);
        $zscore2 = zscore_tb($umur, $jk, $bb, $standarData2);

        dd($zscore, $zscore2);
    }

    public function render()
    {
        return view('livewire.smart.zscore');
    }
}
