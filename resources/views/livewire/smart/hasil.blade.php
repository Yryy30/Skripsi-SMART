<div>
    <flux:select wire:model.lazy="selectedTanggal" placeholder="Pilih Tanggal...">
        @foreach ($daftar_tanggal as $tanggal)
            <flux:select.option value="{{ $tanggal }}">
                {{ $tanggal }}
            </flux:select.option>
        @endforeach
    </flux:select>
    
    {{-- Tabel Data Alternatif --}}
    <div class="overflow-x-auto mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">tgl pengukuran</th>
                <th scope="col" class="px-6 py-3">nama</th>
                <th scope="col" class="px-6 py-3">umur(bulan)</th>
                <th scope="col" class="px-6 py-3">tb/u</th>
                <th scope="col" class="px-6 py-3">tb/u(z-score)</th>
                <th scope="col" class="px-6 py-3">bb/u</th>
                <th scope="col" class="px-6 py-3">bb/u(z-score)</th>
                <th scope="col" class="px-6 py-3">asi</th>
                <th scope="col" class="px-6 py-3">mpasi</th>
                <th scope="col" class="px-6 py-3">sanitasi</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($alternatif as $alternatif)
                <tr wire:key="alternatif-{{ $alternatif->alternatif_id }}" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-2 text-gray-900 dark:text-white">{{ $alternatif->tanggal_pengukuran }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->balita->nama_balita }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->umur_bulan }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->tb }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->tb_zscore }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->bb }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->bb_zscore }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->asi }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->mpasi }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->sanitasi }}</td>
                </tr>
                
                @endforeach
            </tbody>
            
        </table>
    </div>
    
    <div class="relative mt-6 w-full">
        <flux:separator variant="subtle" text="Data Baku" />
    </div>

    {{-- Tabel Data Baku --}}
    <div class="overflow-x-auto mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">nama</th>
                <th scope="col" class="px-6 py-3">tb/u</th>
                <th scope="col" class="px-6 py-3">bb/u</th>
                <th scope="col" class="px-6 py-3">asi</th>
                <th scope="col" class="px-6 py-3">mpasi</th>
                <th scope="col" class="px-6 py-3">sanitasi</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($data_baku as $item)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['nama'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['skor_tb'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['skor_bb'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['skor_asi'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['skor_mpasi'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['skor_sanitasi'] }}</td>
                </tr>
                
                @endforeach
            </tbody>
            
        </table>
    </div>

    <div class="relative mt-6 w-full">
        <flux:separator variant="subtle" text="Data Utility" />
    </div>

    {{-- Tabel Data Utility --}}
    <div class="overflow-x-auto mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">nama</th>
                <th scope="col" class="px-6 py-3">tb/u</th>
                <th scope="col" class="px-6 py-3">bb/u</th>
                <th scope="col" class="px-6 py-3">asi</th>
                <th scope="col" class="px-6 py-3">mpasi</th>
                <th scope="col" class="px-6 py-3">sanitasi</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($utility as $item)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['nama'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['utility_tb'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['utility_bb'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['utility_asi'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['utility_mpasi'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['utility_sanitasi'] }}</td>
                </tr>
                
                @endforeach
            </tbody>
            
        </table>
    </div>

    <div class="relative mt-6 w-full">
        <flux:separator variant="subtle" text="Perangkingan" />
    </div>

    {{-- Tabel Perangkingan --}}
    <div class="overflow-x-auto mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">nama</th>
                <th scope="col" class="px-6 py-3">Total SMART</th>
                <th scope="col" class="px-6 py-3">Keterangan</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($total_smart as $item)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['nama'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['total'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['ket'] }}</td>
                </tr>
                
                @endforeach
            </tbody>
            
        </table>
    </div>

</div>