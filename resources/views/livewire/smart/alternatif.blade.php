<div>
    <div class="flex items-center justify-between mb-4">
        {{-- KIRI --}}
        <div class="flex items-center gap-3 w-1/2">
            <div class="flex-1">
                <flux:select
                    wire:model.live="filterTanggal"
                    placeholder="Pilih Tanggal..."
                >
                    <flux:select.option value="">
                        Semua Tanggal
                    </flux:select.option>

                    @foreach ($listTanggal as $tgl)
                        <flux:select.option value="{{ $tgl }}">
                            {{ \Carbon\Carbon::parse($tgl)->format('d M Y') }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            <flux:modal.trigger name="tambah-alternatif">
                <flux:button>Tambah Data</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    {{-- Tabel Data Alternatif --}}
    <div class="overflow-x-auto mt-5 border rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

            {{-- HEAD --}}
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Umur (bln)</th>
                    <th class="px-6 py-3">TB/U</th>
                    <th class="px-6 py-3">BB/U</th>
                    <th class="px-6 py-3">ASI</th>
                    <th class="px-6 py-3">MP-ASI</th>
                    <th class="px-6 py-3">Sanitasi</th>
                    <th class="px-6 py-3">R. Penyakit Infeksi <p>(3bln terakhir)</p></th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody>
                @forelse ($alternatifs as $alternatif)
                    <tr wire:key="alternatif-{{ $alternatif->alternatif_id }}"
                        class="border-b dark:border-gray-700 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">

                        <td class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                            {{ \Carbon\Carbon::parse($alternatif->tanggal_pengukuran)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $alternatif->balita->nama_balita }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $alternatif->umur_bulan }}
                        </td>

                        <td class="px-6 py-3">{{ $alternatif->tb }}</td>
                        <td class="px-6 py-3">{{ $alternatif->bb }}</td>

                        <td class="px-6 py-3">{{ $alternatif->asi }}</td>
                        <td class="px-6 py-3">{{ $alternatif->mpasi }}</td>
                        <td class="px-6 py-3">{{ $alternatif->sanitasi }}</td>
                        <td class="px-6 py-3">
                            {{ $alternatif->penyakit > 0 ? $alternatif->penyakit . ' kali' : 'Tidak Pernah' }}
                        </td>

                        <td class="px-6 py-3 text-center">
                            <flux:button 
                                wire:click="confirmHapus({{ $alternatif->alternatif_id }})" 
                                size="sm" 
                                variant="danger">
                                Hapus
                            </flux:button>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="10" class="py-10">
                            <x-empty-state message="Belum ada data alternatif" />
                        </td>
                    </tr>
                @endforelse
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

                <flux:input wire:model="tb" label="Tinggi Badan/Umur" placeholder="e.g., 90.3" />
                <flux:input wire:model="bb" label="Berat Badan/Umur" placeholder="e.g., 30.5" />
                
                <div class="md:col-span-2">
                    <flux:radio.group wire:model="asi" label="Asi Eksklusif" variant="segmented">
                        <flux:radio value="Eksklusif" label="Eksklusif" />
                        <flux:radio value="Tidak Eksklusif" label="Tidak Eksklusif" />
                        <flux:radio value="Tidak Diberikan" label="Tidak Diberikan" />
                    </flux:radio.group>
                </div>
                <div class="md:col-span-2">
                    <flux:radio.group wire:model="mpasi" label="Makanan Pendamping Asi" variant="segmented">
                        <flux:radio value="Diberikan" label="Diberikan" />
                        <flux:radio value="Tidak Diberikan" label="Tidak Diberikan" />
                    </flux:radio.group>
                </div>                
                <div class="md:col-span-2">
                    <flux:radio.group wire:model="sanitasi" label="Sanitasi" variant="segmented">
                        <flux:radio value="Layak" label="Layak" />
                        <flux:radio value="Sebagian Layak" label="Sebagian Layak" />
                        <flux:radio value="Tidak Layak" label="Tidak Layak" />
                    </flux:radio.group>
                </div>
                <div class="md:col-span-2">
                    <flux:input wire:model="penyakit" label="Riwayat Penyakit Infeksi (3bln terakhir)" placeholder="e.g., 2" />
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
