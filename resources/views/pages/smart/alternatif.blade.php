<x-layouts.app :title="__('Alternatif')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Alternatif') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manajemen Data Alternatif') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <livewire:smart.alternatif />
</x-layouts.app>