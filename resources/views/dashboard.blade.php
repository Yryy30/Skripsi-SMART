<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <flux:callout class="relative aspect-4/1 overflow-hidden">
                <flux:callout.heading>Balita</flux:callout.heading>
                <flux:callout.text>4</flux:callout.text>
            </flux:callout>
            <div class="relative aspect-4/1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-3/1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <flux:callout icon="sparkles" color="purple">
            <flux:callout.heading>Have a question?</flux:callout.heading>

            <flux:callout.text>
                Try our new AI assistant, Jeffrey. Let him handle tasks and answer questions for you.
                <flux:callout.link href="#">Learn more</flux:callout.link>
            </flux:callout.text>
        </flux:callout>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        </div>
    </div>
</x-layouts.app>
