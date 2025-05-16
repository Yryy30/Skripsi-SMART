<x-layouts.app :title="__('Balita')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Balita') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Detail Data Balita') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <livewire:balita.balita-detail :id="$id"/>
</x-layouts.app>
