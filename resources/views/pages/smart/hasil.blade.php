<x-layouts.app :title="__('Hasil')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Hasil') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Perhitungan dengan metode SMART') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <livewire:smart.hasil />
</x-layouts.app>