<div>
    <flux:modal.trigger name="edit-bobot">
        <flux:button>Edit Bobot</flux:button>
    </flux:modal.trigger>

    {{-- Tabel Data Kriteria --}}
    <div class="overflow-x-auto mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th colspan="4" class="px-6 py-3 text-center text-md font-semibold bg-gray-100 dark:bg-gray-800 dark:text-white">
                    Kriteria
                </th>
            </tr>
            <tr>
                <th scope="col" class="px-6 py-3">Nama Kriteria</th>
                <th scope="col" class="px-6 py-3">Bobot</th>
                <th scope="col" class="px-6 py-3">Bobot ternomalisasi</th>
                <th scope="col" class="px-6 py-3">Atribut</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($kriterias as $index => $kriteria)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $kriteria['kriteria_nama'] }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $kriteria['kriteria_bobot'] }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $kriteria['kriteria_bobot_normalisasi'] }}</td>
                <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $kriteria['kriteria_atribut'] }}</td>
            </tr>
            
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="relative mt-6 w-full">
        <flux:separator variant="subtle" text="Subkriteria" />
    </div>

    {{-- Tabel Data Subkriteria --}}
    <div class="grid grid-cols-2 gap-4">
        <div class="overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th colspan="2" class="px-6 py-3 text-center text-md font-semibold bg-gray-100 dark:bg-gray-800 dark:text-white">
                        TB/U
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">z-scores</th>
                    <th scope="col" class="px-6 py-3">Nilai</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> > -1 SD </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 5 </td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> > -1 SD s/d -2 SD </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 3 </td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> < -2 SD </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 1 </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th colspan="2" class="px-6 py-3 text-center text-md font-semibold bg-gray-100 dark:bg-gray-800 dark:text-white">
                        BB/U
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">z-scores</th>
                    <th scope="col" class="px-6 py-3">Nilai</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> > -1 SD </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 5 </td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> > -1 SD s/d -2 SD </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 3 </td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> < -2 SD </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 1 </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th colspan="2" class="px-6 py-3 text-center text-md font-semibold bg-gray-100 dark:bg-gray-800 dark:text-white">
                        ASI
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">Kondisi</th>
                    <th scope="col" class="px-6 py-3">Nilai</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> Eksklusif </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 5 </td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> Tidak Eksklusif </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 3 </td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> Tidak Diberikan </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 1 </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th colspan="2" class="px-6 py-3 text-center text-md font-semibold bg-gray-100 dark:bg-gray-800 dark:text-white">
                        MP-ASI
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">Kondisi</th>
                    <th scope="col" class="px-6 py-3">Nilai</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> Diberikan </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 5 </td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> Tidak Diberikan </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 1 </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th colspan="2" class="px-6 py-3 text-center text-md font-semibold bg-gray-100 dark:bg-gray-800 dark:text-white">
                        SANITASI
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">Kondisi</th>
                    <th scope="col" class="px-6 py-3">Nilai</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> Layak </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 5 </td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> Sebagian layak </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 3 </td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> Tidak layak </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 1 </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Ubah Bobot Kriteria --}}
    <flux:modal name="edit-bobot" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Bobot</flux:heading>
                <flux:text class="mt-2">Masukkan bobo yang sesuai.</flux:text>
            </div>
            <form wire:submit.prevent="updateBobot" class="space-y-4">
                @foreach ($kriterias as $index => $kriteria)
                    <flux:input wire:model.defer="kriterias.{{ $index }}.kriteria_bobot" label="{{ $kriteria['kriteria_nama'] }}" />                    
                @endforeach
                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Simpan</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
    
</div>
