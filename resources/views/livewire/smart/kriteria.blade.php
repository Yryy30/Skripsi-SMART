<div>
    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <flux:modal.trigger name="edit-bobot">
            <flux:button>Edit Bobot</flux:button>
        </flux:modal.trigger>

        <div class="flex gap-2">
            <x-action-message on="saved" class="text-green-600 text-sm">
                ✔ Bobot berhasil diubah
            </x-action-message>
        </div>
    </div>

    {{-- Tabel Kriteria --}}
    <div class="overflow-x-auto mt-5 border rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-400">
                <tr>
                    <th colspan="4" class="px-6 py-3 text-center text-sm font-semibold bg-gray-100 dark:bg-gray-800 dark:text-white">
                        Data Kriteria
                    </th>
                </tr>
                <tr>
                    <th class="px-6 py-3">Nama Kriteria</th>
                    <th class="px-6 py-3">Bobot</th>
                    <th class="px-6 py-3">Normalisasi</th>
                    <th class="px-6 py-3">Atribut</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($kriterias as $kriteria)
                    <tr class="border-b dark:border-gray-700 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                        <td class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                            {{ $kriteria['kriteria_nama'] }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $kriteria['kriteria_bobot'] }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $kriteria['kriteria_bobot_normalisasi'] }}
                        </td>
                        <td class="px-6 py-3">
                            <span class="px-2 py-1 text-xs rounded 
                                {{ $kriteria['kriteria_atribut'] == 'Benefit' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($kriteria['kriteria_atribut']) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Separator --}}
    <div class="relative mt-8 w-full">
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
        <div class="overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th colspan="2" class="px-6 py-3 text-center text-md font-semibold bg-gray-100 dark:bg-gray-800 dark:text-white">
                        RIWAYAT PENYAKIT INFEKSI (3 bulan terakhir)
                        <p>(diare, batuk, pilek/ISPA)</p>
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">Kondisi</th>
                    <th scope="col" class="px-6 py-3">Nilai</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> ≥ 3 kali</td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 5 </td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 1-2 kali </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 3 </td>
                    </tr>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 0 (tidak pernah) </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300"> 1 </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Edit Bobot --}}
    <flux:modal name="edit-bobot" class="md:w-[500px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Bobot</flux:heading>
                <x-action-message on="error" class="text-red-600 text-sm">
                    Bobot maksimal harus 100%!
                </x-action-message>
            </div>

            <form wire:submit.prevent="updateBobot" class="space-y-4">

                {{-- GRID 2 KOLOM --}}
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($kriterias as $index => $kriteria)
                        <flux:input 
                            wire:model.defer="kriterias.{{ $index }}.kriteria_bobot" 
                            label="{{ $kriteria['kriteria_nama'] }}" />
                    @endforeach
                </div>

                {{-- VALIDASI TOTAL --}}
                @php
                    $currentTotal = array_sum(array_column($kriterias, 'kriteria_bobot'));
                @endphp

                <div class="p-2 rounded-lg text-sm 
                    {{ $currentTotal == 100 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    Total Bobot: {{ $currentTotal }}
                </div>

                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">
                        Simpan
                    </flux:button>
                </div>

            </form>
        </div>
    </flux:modal>
    
</div>
