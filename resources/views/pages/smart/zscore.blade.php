<x-layouts.app :title="__('z-scores')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('z-scores') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Data z-scores TB/U dan BB/U WHO') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <livewire:smart.zscore />
</x-layouts.app>
