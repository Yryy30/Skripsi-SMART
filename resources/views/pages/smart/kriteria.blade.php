<x-layouts.app :title="__('Kriteria')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Kriteria') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Data Kriteria dan Sub-kriteria') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <livewire:smart.kriteria />
</x-layouts.app>