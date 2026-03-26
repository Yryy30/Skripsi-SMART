<div class="space-y-6">

    {{-- ATAS: FORM + PANEL --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- FORM --}}
        <div class="md:col-span-2">
            <div class="border border-gray-300 rounded-lg shadow-sm bg-white dark:bg-gray-800 p-6">
                <form wire:submit.prevent="updateBalita" class="space-y-4">

                    <flux:input wire:model="nama_balita" label="Nama Balita" />

                    <flux:radio.group wire:model="jenis_kelamin" label="Jenis Kelamin" variant="segmented">
                        <flux:radio value="L" label="Laki-Laki" />
                        <flux:radio value="P" label="Perempuan" />
                    </flux:radio.group>

                    <flux:input wire:model="tanggal_lahir" label="Tanggal Lahir" type="date" />

                    <flux:textarea wire:model="alamat" label="Alamat" />

                    <flux:input wire:model="nama_orangtua" label="Nama Orangtua" />

                    <div class="flex justify-end">
                        <flux:button type="submit" variant="primary">Ubah</flux:button>
                    </div>

                </form>
            </div>
        </div>

        {{-- PANEL KANAN --}}
        <div class="space-y-4">

            @php
                $last = $alternatifs->last();
                $count = $alternatifs->count();
                $tgl = \Carbon\Carbon::parse($tanggal_lahir);
                $umurBulan = $tgl->diffInMonths(now());
                $umurTahun = floor($umurBulan / 12);
                $sisaBulan = $umurBulan % 12;
            @endphp

            {{-- RINGKASAN --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                <h3 class="font-semibold text-lg mb-3">Ringkasan</h3>

                <div class="text-sm space-y-1">
                    <p>Umur: <b>{{ $umurTahun }} th {{ $sisaBulan }} bln</b></p>
                    <p>Total Data: <b>{{ $count }}</b></p>

                    @if($last)
                        <p>Terakhir: <b>{{ $last->tanggal_pengukuran }}</b></p>
                        <p>TB: <b>{{ $last->tb }} cm</b></p>
                        <p>BB: <b>{{ $last->bb }} kg</b></p>
                    @endif
                </div>
            </div>

            {{-- MINI DOCS --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                <h3 class="font-semibold text-lg mb-3">Petunjuk</h3>

                <div class="text-sm space-y-2 text-gray-600 dark:text-gray-300">
                    <p>
                        Data ini digunakan untuk memantau pertumbuhan balita.
                    </p>

                    <ul class="list-disc ml-4 space-y-1">
                        <li>Lakukan pengukuran secara rutin (minimal 1 bulan sekali)</li>
                        <li>Pastikan pengukuran akurat</li>
                        <li>ASI eksklusif hingga 6 bulan</li>
                        <li>MPASI setelah 6 bulan</li>
                        <li>Perhatikan sanitasi</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <flux:separator variant="subtle" text="Pengukuran" />

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