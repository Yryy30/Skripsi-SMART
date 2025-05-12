<div>
    <div class="flex">
        <flux:input type="file" wire:model="tb/u" />
        <flux:button>Upload TB/U</flux:button>
    </div>

    {{-- Tabel Data TB/U --}}
    <div class="overflow-x-auto mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th colspan="11" class="px-6 py-3 text-center text-md font-semibold bg-gray-100 dark:bg-gray-800 dark:text-white">
                    Length-for-age: Birth to 2 years
                </th>
            </tr>
            <tr>
                <th scope="col" class="px-6 py-3">Month</th>
                <th scope="col" class="px-6 py-3">Gender</th>
                <th scope="col" class="px-6 py-3">Mean</th>
                <th scope="col" class="px-6 py-3">SD</th>
                <th scope="col" class="px-6 py-3">-3SD</th>
                <th scope="col" class="px-6 py-3">-2SD</th>
                <th scope="col" class="px-6 py-3">-1SD</th>
                <th scope="col" class="px-6 py-3">Median</th>
                <th scope="col" class="px-6 py-3">+1SD</th>
                <th scope="col" class="px-6 py-3">+2SD</th>
                <th scope="col" class="px-6 py-3">+3SD</th>
            </tr>
            </thead>
            <tbody>
            {{-- @foreach ($balitas as $balita)
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
            
            @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
