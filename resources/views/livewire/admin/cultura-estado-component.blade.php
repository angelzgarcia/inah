



<div>
    <div class="w-full h-full">

        <div class="py-5">

            <div class="w-full h-fullitems-center justify-center flex flex-col gap-14 px-7">

                {{-- volver --}}
                <div class="w-full flex justify-between">
                    <x-button tipo="back" wire:click="redirigir('database')">Volver</x-button>
                </div>

                {{-- lista de cultura_estadoes --}}
                <div class="flex flex-col w-full h-full justify-between rounded-xl">
                    {{-- table-name, filtro y buscador --}}
                    <div class="flex my-8 items-center gap-4 px-4 justify-between flex-wrap">

                        {{-- nombre de la tabla --}}
                        <h1 class="text-4xl text-zinc-300 font-black tracking-widest uppercase">
                            Culturas Estados
                        </h1>

                        {{-- buscador --}}
                        <x-searcher />

                        {{-- filtro de no.registros por pagina --}}
                        <x-filter />

                        <x-ordenable :keys="$keys" />

                    </div>

                    {{-- thead --}}
                    <div class=" w-full">
                        <div class="w-2/3 px-2 flex flex-row justify-start gap-9 items-center mb-4 italic text-gray-400 text-start font-thin">
                            <x-strong class="text-xs border-gray-200 px-4 shadow-md !rounded-3xl border">
                                ID
                            </x-strong>
                            <x-strong class="text-xs border-gray-200 min-w-36 px-4 shadow-md !rounded-3xl border">
                                ID Cultura
                            </x-strong>
                            <x-strong class="text-xs border-gray-200 min-w-36 px-4 shadow-md !rounded-3xl border">
                                ID Estado
                            </x-strong>
                        </div>
                    </div>

                    {{-- grid de registros y operaciones crud --}}
                    <div class="flex flex-col mb-10 justify-between">
                        {{-- tbody --}}
                        <div class="flex flex-col gap-6">
                            {{-- registros --}}
                            @if ($culturas_estados->isEmpty())
                                <x-not-found>
                                    No se encontraron resultados para
                                    " <input class="!min-w-24 bg-white text-center font-black tracking-widest" type="text" disabled readonly wire:model="query">. "
                                </x-not-found>
                            @else
                                @foreach ($culturas_estados as $cultura_estado)
                                    {{-- tr / registro --}}
                                    <div wire:key="cultura_estado-{{ $cultura_estado->idCulturaEstado }}" class="hover:bg-slate-100 grid-registro shadow-md p-4 rounded-lg bg-slate-50">
                                        {{-- td --}}
                                        <div class="flex">
                                            <div class="flex flex-row justify-start items-center w-full gap-14">
                                                <x-p class="!max-w-max !min-w-max text-xs p-1.5 shadow-md bg-white rounded-full">{{ $cultura_estado->idCulturaEstado }}</x-p>
                                                <x-p class="!max-w-max">{{ $cultura_estado->idCultura }}</x-p>
                                                <x-p class="!max-w-max">{{ $cultura_estado->idEstadoRepublica }}</x-p>
                                            </div>
                                        </div>

                                        {{-- operaciones crud --}}
                                        <div class="flex gap-3 flex-row justify-self-end">
                                            {{-- ver mas --}}
                                            <x-button tipo="show" class="btn-btn" wire:click="show({{ $cultura_estado->idCulturaEstado }})">
                                                Ver más
                                            </x-button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- paginador --}}
                    <x-paginador :table="$culturas_estados" />
                </div>


                {{-- modal ver más detalles --}}
                @if ($openShow)
                    <x-modal openPropiety="openShow">
                        {{-- fecha de registro --}}
                        <div class="w-full flex flex-row mb-5 justify-between items-center">
                            <x-strong class="!text-xl">Detalles del cultura_estado</x-strong>
                        </div>

                        {{-- datos del registro --}}
                        <div class="flex flex-col !min-h-72 justify-between">
                            {{-- id --}}
                            <div>
                                <x-legend>ID: </x-legend>
                                <x-strong>{{$this->cultura_estado->idCulturaEstado}}</x-strong>
                            </div>

                            {{-- cultura_estado --}}
                            <div>
                                <x-legend>ID Cultura: </x-legend>
                                <x-strong>{{$this->cultura_estado->idCultura}}</x-strong>
                            </div>

                            {{-- batch --}}
                            <div>
                                <x-legend>ID Estado: </x-legend>
                                <x-strong>{{$this->cultura_estado->idEstadoRepublica}}</x-strong>
                            </div>
                        </div>

                        {{-- fecha de actualizacion y boton cerrar --}}
                        <div class="flex flex-row justify-between self-end items-center">
                            <x-button tipo="close" wire:click="$set('openShow', false)">
                                Cerrar
                            </x-button>
                        </div>
                    </x-modal>
                @endif
            </div>
        </div>
    </div>
</div>
