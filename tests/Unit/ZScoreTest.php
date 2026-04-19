<?php

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

beforeEach(function () {
    $this->standarData = (object) ['mean' => 87.8, 'sd' => 3.2];
});

test('mengembalikan z-score yang benar jika data valid', function () {
    $result = zscore_tb(90, $this->standarData);
    $expected = round((90 - 87.8) / 3.2, 2);
    assertEquals($expected, $result);
});

test('mengembalikan null jika data tidak lengkap', function () {
    $incomplete = (object) ['mean' => 87.8]; // sd hilang
    $result = zscore_tb(90, $incomplete);
    assertNull($result);
});
