

@props(['table', 'keys' => [], 'key' => 'Table Name Unknown', 'ver_mas' => true, 'editar' => true, 'ocultarEliminar' => false, 'attribute2' => true, 'attribute3' => false,  'attribute4' => false, 'attribute5' => false, 'attribute6' => false])


{{-- contenedor del crud --}}
<div class="flex flex-col w-full h-full justify-between rounded-xl">

    {{-- table-name, filtro y buscador --}}
    <div class="flex my-8 items-center gap-4 px-4 justify-between flex-wrap">

        {{-- nombre de la tabla --}}
        <h1 class="text-4xl text-zinc-300 font-black tracking-widest uppercase">
            {{$key}}
        </h1>

        {{-- filtro de no.registros por pagina --}}
        <x-filter />

        {{$ordenable ?? ''}}

        {{-- buscador --}}
        <x-searcher />

    </div>

    {{-- thead --}}
    {{$slot}}

    {{-- grid de registros y operaciones crud --}}
    <div class="flex flex-col mb-10 justify-between">
        {{-- tbody --}}
        <div class="flex flex-col gap-6">
            {{-- registros --}}
            @if ($table->isEmpty())
                <x-not-found>
                    No se encontraron resultados para
                    " <input class="!min-w-24 bg-white text-center font-black tracking-widest" type="text" disabled readonly wire:model="query">. "
                </x-not-found>
            @else
                @foreach ($table as $register)
                    {{-- tr / registro --}}
                    <div wire:key="{{$key}}-{{ $register->{$keys[0]} }}" class="hover:bg-slate-100 grid-registro shadow-md p-4 rounded-lg bg-slate-50">
                        {{-- td --}}
                        <div class="flex">
                            <div class="flex flex-row justify-start items-center w-full gap-14">
                                <x-p class="!max-w-max !min-w-max text-xs p-1.5 shadow-md bg-white rounded-full">{{ $register->{$keys[0]} }}</x-p>
                                @if ($attribute2)
                                    @if ($register->{$keys[1]})
                                        <x-p>{{ $register->{$keys[1]} }}</x-p>
                                    @else
                                        <x-p class="text-gray-500">NULL</x-p>
                                    @endif
                                @endif
                                @if ($attribute3)
                                    <x-p>{{ $register->{$keys[2]} }}</x-p>
                                @endif
                                @if ($attribute4)
                                    <x-p>{{ $register->{$keys[3]} }}</x-p>
                                @endif
                                @if ($attribute5)
                                    <x-p>{{ $register->{$keys[5]} }}</x-p>
                                @endif
                            </div>
                        </div>

                        {{-- operaciones crud --}}
                        <div class="flex gap-3 flex-row justify-self-end">
                            {{-- ver mas --}}
                            @if ($ver_mas)
                                <x-button tipo="show" class="btn-btn" wire:click="show({{ $register->{$keys[0]} }})">
                                    Ver más
                                </x-button>
                            @endif

                            {{-- editar --}}
                            @if ($editar)
                                <x-button tipo="edit" wire:click="edit({{ $register->{$keys[0]} }})">
                                    Editar
                                </x-button>
                            @endif

                            {{-- eliminar --}}
                            @if (!$ocultarEliminar)
                                <x-button tipo="destroy" wire:click="confirmDestroy({{ $register->{$keys[0]} }})">
                                    Eliminar
                                </x-button>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    {{-- paginador --}}
    <x-paginador :table="$table" />

</div>
