

@props(['form_object', 'name_form', 'model'])

{{-- botones volver, agregar y cancelar --}}
<div class="w-full flex justify-between">
    {{-- volver --}}
    <x-button tipo="back" wire:click="redirigir('database')">
        Volver
    </x-button>

    {{-- agregar --}}
    @if (!$form_object->openCreate)
        <x-button tipo="aggregate" wire:click="$set('{{$name_form}}.openCreate', true)">
            Agregar {{strtoupper(str_replace('Create', '', $name_form))}}
        </x-button>
    @else
        {{-- cancelar --}}
        <x-button tipo="cancel" wire:click="$set('{{$name_form}}.openCreate', false)">
            Cancelar
        </x-button>
    @endif
</div>
