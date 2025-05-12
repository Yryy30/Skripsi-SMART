<div>
    <flux:modal.trigger name="tambah-balita">
        <flux:button>Tambah Data</flux:button>
    </flux:modal.trigger>

    {{-- Tabel Data Balita --}}
    <div class="overflow-x-auto mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Nama Balita</th>
                <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                <th scope="col" class="px-6 py-3">Tgl Lahir</th>
                <th scope="col" class="px-6 py-3">Alamat</th>
                <th scope="col" class="px-6 py-3">Nama Orangtua</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($balitas as $balita)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <td class="px-6 py-2 text-gray-900 dark:text-white">{{ $balita->nama_balita }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $balita->jenis_kelamin }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $balita->tanggal_lahir }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $balita->alamat }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $balita->nama_orangtua }}</td>
                <td class="px-6 py-2">
                    <flux:modal.trigger :name="'edit-balita-'.$balita->balita_id">
                        <flux:button size="sm" wire:click="editBalita({{ $balita->balita_id }})">Edit</flux:button>
                    </flux:modal.trigger>
                    <flux:button size="sm" variant="danger">Hapus</flux:button>
                </td>
            </tr>

            {{-- Modal Edit Balita --}}
            <flux:modal :name="'edit-balita-'.$balita->balita_id" @close="resetInputField" variant="flyout">
                <div class="space-y-6">
                    <div>
                        <flux:heading size="lg">Edit Data</flux:heading>
                        <flux:text class="mt-2">Masukkan data balita dengan benar.</flux:text>
                    </div>
                    <form wire:submit.prevent="updateBalita" class="space-y-4">
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
            
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal Tambah Balita --}}
    <flux:modal name="tambah-balita" @close="resetInputField" variant="flyout" position="left">
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
</div>
