<div>
    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <flux:modal.trigger name="tambah-balita">
            <flux:button>Tambah Data</flux:button>
        </flux:modal.trigger>

        <div class="flex gap-2">
            <x-action-message on="saved" class="text-green-600 text-sm">
                ✔ Data berhasil disimpan
            </x-action-message>
            <x-action-message on="deleted" class="text-green-600 text-sm">
                ✔ Data berhasil dihapus
            </x-action-message>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto mt-5 border rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            
            {{-- Head --}}
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">Nama Balita</th>
                    <th class="px-6 py-3">Jenis Kelamin</th>
                    <th class="px-6 py-3">Tgl Lahir</th>
                    <th class="px-6 py-3">Alamat</th>
                    <th class="px-6 py-3">Orangtua</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            {{-- Body --}}
            <tbody>
                @forelse ($balitas as $balita)
                    <tr wire:key="balita-{{ $balita->balita_id }}"
                        class="border-b dark:border-gray-700 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">

                        <td class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                            {{ $balita->nama_balita }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $balita->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $balita->alamat }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $balita->nama_orangtua }}
                        </td>

                        <td class="px-6 py-3">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('balita.detail', $balita->balita_id) }}">
                                    <flux:button size="sm">Detail</flux:button>
                                </a>

                                <flux:button 
                                    wire:click="confirmHapus({{ $balita->balita_id }})" 
                                    size="sm" 
                                    variant="danger">
                                    Hapus
                                </flux:button>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="py-10">
                            <x-empty-state message="Belum ada data balita" />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Tambah Balita --}}
    <flux:modal name="tambah-balita" @close="resetInputField" class="md:w-1/2">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Data</flux:heading>
                <flux:text class="mt-2">Masukkan data balita dengan benar.</flux:text>
            </div>
            <form wire:submit.prevent="tambahBalita" class="space-y-4">
                <flux:input wire:model="nama_balita" label="Nama Balita" placeholder="Nama Balita" />
                
                <flux:radio.group wire:model="jenis_kelamin" label="Jenis Kelamin" variant="segmented">
                    <flux:radio value="L" label="Laki-Laki" />
                    <flux:radio value="P" label="Perempuan" />
                </flux:radio.group>

                <flux:input wire:model="tanggal_lahir" label="Tanggal Lahir" type="date" />

                <flux:textarea wire:model="alamat" label="Alamat" />

                <flux:input wire:model="nama_orangtua" label="Nama Orangtua" placeholder="Nama Orangtua" />

                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Simpan</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    {{-- Modal Hapus Balita --}}
    <flux:modal name="konfirmasi-hapus" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Hapus data balita?</flux:heading>
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

                <form wire:submit.prevent="hapusBalita">
                    <flux:button type="submit" variant="danger">Hapus</flux:button>
                </form>
            </div>
        </div>
    </flux:modal>
</div>
