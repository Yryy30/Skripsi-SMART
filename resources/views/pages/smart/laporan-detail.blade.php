<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Detail Deteksi Stunting</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 11px;
      margin: 20px;
    }
    h1, h2 {
      text-align: center;
      margin: 0;
      font-size: 16px;
    }
    .info {
      margin: 10px 0;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 10px;
    }
    table, th, td {
      border: 1px solid black;
    }
    th, td {
      padding: 4px;
      text-align: center;
    }
    .logo {
      position: absolute;
      top: 10px;
      left: 20px;
    }
  </style>
</head>
<body>

  <img src="{{ public_path('posyandu.png') }}" alt="Logo Posyandu" class="logo" width="50">
  <h1>LAPORAN DETAIL HASIL DETEKSI STUNTING</h1>
  <h2>POSYANDU JERUK</h2>
  <hr>

  <div class="info">
    <p>Nama : {{ $alternatif->balita->nama_balita }}</p>
    <p>Umur : {{ $alternatif->umur_bulan }} bulan</p>
    <p>Tanggal Penimbangan : {{ $alternatif->tanggal_pengukuran }}</p>
  </div>

  <table>
    <thead>
      <tr>
        <th>Tinggi Badan</th>
        <th>Z-score TB</th>
        <th>Berat Badan</th>
        <th>Z-score BB</th>
        <th>ASI</th>
        <th>MPASI</th>
        <th>Sanitasi</th>
      </tr>
    </thead>
    <tbody>
          <tr>
              <td>{{ $alternatif->tb }}</td>
              <td>{{ $alternatif->tb_zscore }}</td>
              <td>{{ $alternatif->bb }}</td>
              <td>{{ $alternatif->bb_zscore }}</td>
              <td>{{ $alternatif->asi }}</td>
              <td>{{ $alternatif->mpasi }}</td>
              <td>{{ $alternatif->sanitasi }}</td>
          </tr>
    </tbody>
  </table>

  <br>

  <div class="info">
    <h3>Hasil SMART</h3>
    <p><strong>Total:</strong> {{ number_format($hasil['total'], 4) }}</p>
    <p><strong>Kategori:</strong> {{ $hasil['ket'] }}</p>
    <p><strong>Intervensi:</strong> {{ $hasil['intervensi'] }}</p>
  </div>

</body>
</html>