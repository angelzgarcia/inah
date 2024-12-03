



<div
    {!!
        $attributes -> merge([
            'class'
                =>
            'searcher-container flex flex-row'
        ])
    !!}
>

    <div
        {!!
            $attributes -> merge([
                'class'
                    =>
                'relative'
            ])
        !!}
        {{-- class="relative " --}}
    >
        <input type="text" wire:model.live.debounce.100ms="query" placeholder="¿Qúe buscabas.....?">
        <x-button tipo="x" wire:click="$set('query', '')" class="absolute right-20 !bg-gray-300 !cursor-pointer !w-1" />
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
        </button>
    </div>
</div>
