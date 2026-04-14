<div>
    <div class="flex items-center gap-2">
        <flux:select wire:model.lazy="selectedTanggal" placeholder="Pilih Tanggal..." class="flex-1">
            @foreach ($daftar_tanggal as $tanggal)
                <flux:select.option value="{{ $tanggal }}">
                    {{ $tanggal }}
                </flux:select.option>
            @endforeach
        </flux:select>
        <flux:button 
            href="{{ route('laporan', ['tanggal' => $selectedTanggal]) }}"
            icon="arrow-down-tray" 
            class="whitespace-nowrap"
        >
            Export
        </flux:button>
    </div>
    
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
        <flux:separator variant="subtle" text="Data Parameter" />
    </div>

    {{-- Tabel Data Parameter --}}
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
        <flux:separator variant="subtle" text="Hasil" />
    </div>

    {{-- Tabel Hasil --}}
    <div class="overflow-x-auto mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">nama</th>
                <th scope="col" class="px-6 py-3">Total SMART</th>
                <th scope="col" class="px-6 py-3">Keterangan</th>
                <th scope="col" class="px-6 py-3">Intervensi</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($total_smart as $item)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                        <flux:modal.trigger name="hasil-alternatif">
                            <span 
                                class="text-blue-600 cursor-pointer hover:underline"
                                wire:click.prevent="showDetail('{{ $item['nama'] }}')"
                            >
                                {{ $item['nama'] }}
                            </span>
                        </flux:modal.trigger>
                    </td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['total'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['ket'] }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item['intervensi'] }}</td>
                </tr>
                
                @endforeach
            </tbody>
            
        </table>
    </div>

    {{-- Modal Hasil per alternatif --}}
    <flux:modal name="hasil-alternatif" @close="$wire.resetDataDetail()" class="md:w-1/2">
        @if(!empty($detail_alternatif))
            <div class="space-y-3">
                <h2 class="text-lg font-bold">Detail Hasil Balita</h2>
                <flux:button 
                    href="{{ route('laporan.detail', ['id' => $detail_alternatif['alternatif']->alternatif_id]) }}"
                    target="_blank"
                    icon="printer"
                >
                    Cetak
                </flux:button>

                {{-- DATA ALTERNATIF --}}
                <div class="border-b pb-2">
                    <div><strong>Nama:</strong> {{ $detail_alternatif['alternatif']->balita->nama_balita }}</div>
                    <div><strong>Tanggal:</strong> {{ $detail_alternatif['alternatif']->tanggal_pengukuran }}</div>
                    <div><strong>Umur:</strong> {{ $detail_alternatif['alternatif']->umur_bulan }} bulan</div>

                    <div><strong>TB:</strong> {{ $detail_alternatif['alternatif']->tb }}</div>
                    <div><strong>Z-Score TB/U:</strong> {{ $detail_alternatif['alternatif']->tb_zscore }}</div>

                    <div><strong>BB:</strong> {{ $detail_alternatif['alternatif']->bb }}</div>
                    <div><strong>Z-Score BB/U:</strong> {{ $detail_alternatif['alternatif']->bb_zscore }}</div>

                    <div><strong>ASI:</strong> {{ $detail_alternatif['alternatif']->asi }}</div>
                    <div><strong>MPASI:</strong> {{ $detail_alternatif['alternatif']->mpasi }}</div>
                    <div><strong>Sanitasi:</strong> {{ $detail_alternatif['alternatif']->sanitasi }}</div>
                </div>

                {{-- HASIL SMART --}}
                <div>
                    <h3 class="font-semibold">Hasil Perhitungan</h3>

                    <div><strong>Total SMART:</strong> {{ $detail_alternatif['total']['total'] ?? '-' }}</div>
                    <div><strong>Kategori:</strong> {{ $detail_alternatif['total']['ket'] ?? '-' }}</div>
                    <div><strong>Intervensi:</strong> {{ $detail_alternatif['total']['intervensi'] ?? '-' }}</div>
                </div>
            </div>
        @else
            <div class="text-center py-10">
                <p class="text-gray-500">Memuat data...</p>
            </div>
        @endif
    </flux:modal>

</div>