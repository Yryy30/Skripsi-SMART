<?php

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

beforeEach(function () {
    $this->standarData = [
        ['month' => 24, 'gender' => 'L', 'mean' => 87.8, 'sd' => 3.2],
        ['month' => 24, 'gender' => 'P', 'mean' => 86.4, 'sd' => 3.1],
    ];
});

test('mengembalikan z-score yang benar jika data valid', function () {
    $result = zscore_tb(24, 'L', 90, $this->standarData);
    $expected = round((90 - 87.8) / 3.2, 2);

    assertEquals($expected, $result);
});

test('mengembalikan null jika data tidak ditemukan', function () {
    $result = zscore_tb(12, 'L', 80, $this->standarData);
    assertNull($result);
});

test('mengembalikan null jika data tidak lengkap', function () {
    $incomplete = [
        ['month' => 24, 'gender' => 'L', 'mean' => 87.8], // sd hilang
    ];
    $result = zscore_tb(24, 'L', 90, $incomplete);
    assertNull($result);
});

test('tidak sensitif terhadap huruf besar/kecil pada gender', function () {
    $resultLower = zscore_tb(24, 'l', 90, $this->standarData);
    $resultUpper = zscore_tb(24, 'L', 90, $this->standarData);

    assertEquals($resultUpper, $resultLower);
});
