<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Deteksi Stunting</title>
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
  <h1>LAPORAN HASIL DETEKSI STUNTING</h1>
  <h2>POSYANDU JERUK</h2>
  <hr>

  <div class="info">
    <p>Tanggal : {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</p>
    <p>Jumlah : {{ count($total_smart) }}</p>
    <p>Risiko Tinggi : {{ $total_smart->where('ket', 'Tinggi')->count() }}</p>
  </div>

  <table>
    <thead>
      <tr>
        <th>NO</th>
        <th>NAMA</th>
        <th>TB</th>
        <th>BB</th>
        <th>ASI</th>
        <th>MP-ASI</th>
        <th>SANITASI</th>
        <th>SKOR SMART</th>
        <th>KETERANGAN</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($alternatif as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $total_smart[$index]['nama'] }}</td>
                <td>{{ $item->tb }}</td>
                <td>{{ $item->bb }}</td>
                <td>{{ $item->asi }}</td>
                <td>{{ $item->mpasi }}</td>
                <td>{{ $item->sanitasi }}</td>
                <td>{{ number_format($total_smart[$index]['total'], 4) }}</td>
                <td>{{ $total_smart[$index]['ket'] }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>

</body>
</html>
