<x-layouts.app :title="__('Balita')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Balita') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manajemen Data Balita') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <livewire:balita.balita />
</x-layouts.app>
