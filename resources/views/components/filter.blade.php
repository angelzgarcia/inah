

{{-- numero de registros por el paginador --}}
<div class="flex items-center justify-between gap-2">

    <x-input type="number" min="1" wire:model.live="perPage"
        class="max-w-16 font-black !rounded-full text-zinc-300 text-center"
    />
    <span class="text-sm font-light italic tracking-widest">resultados</span>

</div>
