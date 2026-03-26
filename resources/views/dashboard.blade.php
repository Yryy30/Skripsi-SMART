<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:callout icon="sparkles" color="purple">
            <flux:callout.heading>Hallo!</flux:callout.heading>

            <flux:callout.text>
                Selamat datang di dashboard aplikasi <strong>Stunting</strong>. 
                Di sini Anda dapat melihat ringkasan data terkait stunting, termasuk jumlah balita, data altarnatif, dan grafik perkembangan stunting.
            </flux:callout.text>
        </flux:callout>

        <livewire:dashboard />
    </div>
    
</x-layouts.app>
