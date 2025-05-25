<div>
    {{-- Form Data Balita --}}
    <div class="flex justify-start">
        <div class="w-full md:w-1/2 border border-gray-300 rounded-lg shadow-sm bg-white dark:bg-gray-800 p-6">
            <form wire:submit.prevent="updateBalita" class="space-y-4">
                <flux:input wire:model="nama_balita" label="Nama Balita" placeholder="Nama Balita" />
    
                <flux:radio.group wire:model="jenis_kelamin" label="Jenis Kelamin" variant="segmented">
                    <flux:radio value="L" label="Laki-Laki" />
                    <flux:radio value="P" label="Perempuan" />
                </flux:radio.group>
    
                <flux:input wire:model="tanggal_lahir" label="Tanggal Lahir" type="date" />
    
                <flux:textarea wire:model="alamat" label="Alamat" />
    
                <flux:input wire:model="nama_orangtua" label="Nama Orangtua" placeholder="Nama Orangtua" />
    
                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary">Ubah</flux:button>
                </div>
            </form>
        </div>
    </div>

    <div class="relative mt-6 w-full">
        <flux:separator variant="subtle" text="Pengukuran" />
    </div>
    
    {{-- Tabel Data Balita --}}
    <div class="overflow-x-auto mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">tgl Pengukuran</th>
                <th scope="col" class="px-6 py-3">tb</th>
                <th scope="col" class="px-6 py-3">bb</th>
                <th scope="col" class="px-6 py-3">asi</th>
                <th scope="col" class="px-6 py-3">mpasi</th>
                <th scope="col" class="px-6 py-3">sanitasi</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($alternatifs as $item)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item->tanggal_pengukuran }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item->tb }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item->bb }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item->asi }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item->mpasi }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $item->sanitasi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
