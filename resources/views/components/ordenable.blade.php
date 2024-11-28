
@props(['keys' => [], 'nK' => [0,1]])

@if (!empty($keys))
    <div class="flex gap-8 justify-between bg-slate-300 rounded-full items-center">

        @for ($i = 0; $i < count($nK); $i++)
            <x-button
                tipo="{{$this->sortColumn == $keys[$nK[$i]] ? ($this->sortDirection == 'asc' ? 'asc' : 'desc') : 'default'}}"
                wire:click="sortBy('{{ $keys[$nK[$i]] }}')"
                class="!rounded-full !min-w-10"
            >
                {{$keys[$i] == $keys[0] ? 'ID' : $keys[$nK[$i]]}}
            </x-button>
        @endfor

    </div>
@endif
