
@props(['keys' => [], 'nKeys' => 2])

@if (!empty($keys))
    <div class="flex gap-8 justify-between bg-slate-300 rounded-full items-center">

        @for ($i = 0; $i < $nKeys; $i++)
            <x-button
                tipo="{{$this->sortColumn == $keys[$i] ? ($this->sortDirection == 'asc' ? 'asc' : 'desc') : 'default'}}"
                wire:click="sortBy('{{$keys[$i]}}')"
                class="!rounded-full !min-w-10"
            >
                {{$keys[$i] == $keys[0] ? 'ID' : $keys[$i]}}
            </x-button>
        @endfor

    </div>
@endif
