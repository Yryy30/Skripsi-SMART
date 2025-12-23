<div>
    <div class="flex items-center gap-2">
        <flux:select
            wire:model.lazy="filterTanggal"
            placeholder="Pilih Tanggal..."
            class="flex-1"
        >
            <flux:select.option value="">
                Semua Tanggal
            </flux:select.option>

            @foreach ($listTanggal as $tgl)
                <flux:select.option value="{{ $tgl }}">
                    {{ \Carbon\Carbon::parse($tgl)->format('Y-m-d') }}
                </flux:select.option>
            @endforeach
        </flux:select>
        <flux:modal.trigger name="tambah-alternatif">
            <flux:button>Tambah Data</flux:button>
        </flux:modal.trigger>
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
                <th scope="col" class="px-6 py-3">bb/u</th>
                <th scope="col" class="px-6 py-3">asi</th>
                <th scope="col" class="px-6 py-3">mpasi</th>
                <th scope="col" class="px-6 py-3">sanitasi</th>
                <th scope="col" class="px-6 py-3">actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($alternatifs as $alternatif)
            <tr wire:key="alternatif-{{ $alternatif->alternatif_id }}" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <td class="px-6 py-2 text-gray-900 dark:text-white">{{ $alternatif->tanggal_pengukuran }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->balita->nama_balita }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->umur_bulan }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->tb }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->bb }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->asi }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->mpasi }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $alternatif->sanitasi }}</td>
                <td class="px-6 py-2">
                    {{-- <a href="{{ route('balita.detail', $balita->balita_id) }}">
                        <flux:button size="sm">Detail</flux:button>
                    </a> --}}
                    <flux:button wire:click="confirmHapus({{ $alternatif->alternatif_id }})" size="sm" variant="danger">Hapus</flux:button>
                </td>
            </tr>
            
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal Tambah Data --}}
    <flux:modal name="tambah-alternatif" @close="resetInputField" class="md:w-1/2">
        <form wire:submit.prevent="tambahAlternatif" class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Data</flux:heading>
                <flux:text class="mt-2">Masukkan data alternatif dengan benar.</flux:text>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <flux:input wire:model="tanggal_pengukuran" label="Tgl Pengukuran" type="date" />
                </div>
                <div class="md:col-span-2">
                    <flux:select label="Nama" wire:model="balita_id" placeholder="Pilih Balita...">
                        @forelse ($balitas as $balita)
                        <flux:select.option value="{{ $balita->balita_id }}" wire:key="{{ $balita->balita_id }}">
                            {{ $balita->nama_balita }}
                        </flux:select.option>
                        @empty
                        <flux:select.option disabled>Tidak ada data balita</flux:select.option>
                        @endforelse
                    </flux:select>
                </div>

                <flux:input wire:model="tb" label="TB/U" placeholder="e.g., 90.3" />
                <flux:input wire:model="bb" label="BB/U" placeholder="e.g., 30.5" />
                
                <div class="md:col-span-2">
                    <flux:radio.group wire:model="asi" label="ASI" variant="segmented">
                        <flux:radio value="Eksklusif" label="Eksklusif" />
                        <flux:radio value="Tidak Eksklusif" label="Tidak Eksklusif" />
                        <flux:radio value="Tidak Diberikan" label="Tidak Diberikan" />
                    </flux:radio.group>
                </div>
                <div class="md:col-span-2">
                    <flux:radio.group wire:model="mpasi" label="MP-ASI" variant="segmented">
                        <flux:radio value="Diberikan" label="Diberikan" />
                        <flux:radio value="Tidak Diberikan" label="Tidak Diberikan" />
                    </flux:radio.group>
                </div>                
                <div class="md:col-span-2">
                    <flux:radio.group wire:model="sanitasi" label="SANITASI" variant="segmented">
                        <flux:radio value="Layak" label="Layak" />
                        <flux:radio value="Sebagian Layak" label="Sebagian Layak" />
                        <flux:radio value="Tidak Layak" label="Tidak Layak" />
                    </flux:radio.group>
                </div>
            </div>
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Modal Hapus Alternatif --}}
    <flux:modal name="konfirmasi-hapus" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Hapus data Alternatif?</flux:heading>
                <flux:text class="mt-2">
                    <p>Yakin ingin menghapus data ini?</p>
                    <p>Tindakan tidak dapat dibatalkan.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>

                <form wire:submit.prevent="hapusAlternatif">
                    <flux:button type="submit" variant="danger">Hapus</flux:button>
                </form>
            </div>
        </div>
    </flux:modal>
</div>
