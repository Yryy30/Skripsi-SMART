{{-- resources/views/components/empty-state.blade.php --}}
<div class="flex flex-col items-center justify-center h-full gap-2 p-6 text-center">
    <svg class="w-12 h-12 text-neutral-300 dark:text-neutral-600" 
         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
              d="M9 17v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6m14 0v-6a2 2 0 00-2-2h-2a2 2 0 00-2 2v6m-7 0h14" />
    </svg>
    <p class="text-sm font-medium text-neutral-400 dark:text-neutral-500">
        {{ $message ?? 'Belum ada data' }}
    </p>
</div>