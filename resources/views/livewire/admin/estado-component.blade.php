@php
    $first = $estados -> first();
    $keys = $first ? array_keys($first->getAttributes()) : [];
@endphp

{{-- VISTA DEL COMPONENTE ESTADOS --}}
<div class="w-full h-full">

    <div class="py-5">

        <div class="w-full h-fullitems-center justify-center flex flex-col gap-14 px-7">

            {{-- botones volver, agreagar y cancelar form --}}
            <x-crud-buttons-header :form_object="$estadoCreate" name_form="estadoCreate" />

            {{-- formularo crear estado --}}
            @if ($estadoCreate->openCreate)
                <div class="sbw-thin w-full flex flex-col justify-between gap-8 rounded-xl">
                    {{-- titulo --}}
                    <h1 class="text-3xl">
                        <x-strong>Agregar estado</x-strong>
                    </h1>
                    {{-- formulario --}}
                    <form wire:submit="save" enctype="multipart/form-data" class="w-full italic flex flex-col gap-2">
                        @csrf

                        <div class="grid gap-12 overflow-hidden" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                            {{-- nombre, capital y url de video --}}
                            <div class="flex flex-col justify-between gap-12">
                                {{-- nombre --}}
                                <x-fieldset>
                                    <x-legend>Nombre*</x-legend>
                                    <x-input wire:model.live="estadoCreate.nombre" value="{{old('nombre')}}" />
                                    <x-error-message for="estadoCreate.nombre" />
                                </x-fieldset>
                                {{-- capital --}}
                                <x-fieldset>
                                    <x-legend>Capital*</x-legend>
                                    <x-input wire:model.live="estadoCreate.capital" value="{{old('capital')}}" />
                                    <x-error-message for="estadoCreate.capital" />
                                </x-fieldset>
                                {{-- video --}}
                                <x-fieldset>
                                    <x-legend class="normal-case">URL del video*</x-legend>
                                    <x-input wire:model.live="estadoCreate.video" placeholder="https://www.youtube.com/watch?v=" value="{{old('video')}}" />
                                    <x-error-message for="estadoCreate.video" />
                                </x-fieldset>

                                {{-- boton lista de culturas --}}
                                @if ($nCulturas > 0)
                                    <x-fieldset class="mb-5 mt-2">
                                        <x-legend class="normal-case">Culturas que pertenecen a este estado</x-legend>
                                        <div class="flex w-full mt-2 justify-between">
                                            <x-button wire:click="$set('estadoCreate.openCulturasCheck', true)">
                                                Seleccionar
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M40 48C26.7 48 16 58.7 16 72l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24L40 48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM16 232l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0z"/></svg>
                                            </x-button>
                                            <x-strong>
                                                {{count($estadoCreate->culturasID)}} culturas relacionadas
                                            </x-strong>
                                        </div>
                                        <x-error-message for="estadoCreate.culturasID" />
                                    </x-fieldset>
                                @endif
                            </div>

                            {{-- modal checkboxes CULTURAS --}}
                            @if ($estadoCreate->openCulturasCheck)
                                <x-modal openPropiety="estadoCreate.openCulturasCheck">
                                    <x-strong class="!text-xl text-end">Selecciona las culturas que han conformado a este estado</x-strong>
                                    <div class="grid grid-cols-auto-fill-200 gap-x-10 my-3 gap-y-6 content-between grid-flow-row w-full">
                                        @foreach ($culturasRegistradas as $cultura)
                                            <div wire:key="Estado-Cultura-{{$cultura->idCultura}}" class="flex justify-between bg-zinc-100 hover:bg-stone-200 hover:shadow-lg shadow-md rounded-lg px-4 py-2">
                                                <x-legend class="text-start">{{$cultura->nombre}}</x-legend>
                                                <x-checkbox
                                                    class="bg-white"
                                                    wire:click="saveCultura({{$cultura->idCultura}})"
                                                    :checked="in_array($cultura->idCultura, $estadoCreate->culturasID)"
                                                />
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- paginador de estados --}}
                                    <div class="">
                                        <x-paginador :table="$culturasRegistradas" />
                                    </div>

                                    <x-button tipo="check" class="self-end mt-3" wire:click="$set('estadoCreate.openCulturasCheck', false)">
                                        Confirmar
                                    </x-button>
                                </x-modal>
                            @endif

                            {{-- foto, triptcio y guia --}}
                            <div class="flex flex-col gap-12">
                                {{-- foto --}}
                                <x-fieldset>
                                    <x-legend>Portada*</x-legend>
                                    <input type="file" wire:model.live="estadoCreate.foto" wire:key="{{$fotoKey}}" accept="image/*">
                                    <x-error-message for="estadoCreate.foto" />
                                </x-fieldset>
                                {{-- triptico --}}
                                <x-fieldset>
                                    <x-legend>Triptico* <small class="text-xs font-bold lowercase"> solo archivos pdf</small></x-legend>
                                    <input type="file" wire:model.live="estadoCreate.triptico" wire:key="{{$tripticoKey}}" accept=".pdf">
                                    <x-error-message for="estadoCreate.triptico" />
                                </x-fieldset>
                                {{-- guia --}}
                                <x-fieldset>
                                    <x-legend>Guia informativa* <small class="text-xs font-bold lowercase"> Solo archivos PDF</small></x-legend>
                                    <input type="file" wire:model.live="estadoCreate.guia" wire:key="{{$guiaKey}}" accept=".pdf">
                                    <x-error-message for="estadoCreate.guia" />
                                </x-fieldset>
                            </div>
                        </div>

                        {{-- boton guardar --}}
                        <div class="flex justify-end gap-2">
                            {{-- agregar --}}
                            <x-button type="submit" tipo="create">
                                Guardar
                            </x-button>
                        </div>
                    </form>
                </div>
            @endif

            {{-- CRUD ESTADOS --}}
            @if ($nEstados < 1)
                @if (!$estadoCreate->openCreate)
                    <x-not-found>
                        <div class="flex gap-9 items-center">
                            Hay 0 registros.
                            <span>¡Ingresa algunos!</span>
                            <x-button tipo="up" wire:click="$set('estadoCreate.openCreate', true)" />
                        </div>
                    </x-not-found>
                @endif
            @else
                <x-table-grid :table="$estados" :keys="$keys" key="Estados" attribute3="fd">

                    {{-- ordenador de registros --}}
                    <x-slot name="ordenable">
                        <x-ordenable :keys="$keys"  />
                    </x-slot>

                    {{-- slot -> thead --}}
                    <div class=" w-full">
                        <div class="w-2/3 px-2 flex flex-row justify-start gap-9 items-center mb-4 italic text-gray-400 text-start font-thin">
                            <x-strong class="text-xs bg-white border-gray-200 px-4 shadow-md !rounded-3xl border">
                                ID
                            </x-strong>
                            <x-strong class="text-xs bg-white border-gray-200 min-w-36 px-4 shadow-md !rounded-3xl border">
                                Nombre del estado
                            </x-strong>
                            <x-strong class="text-xs bg-white border-gray-200 px-4 min-w-36 shadow-md !rounded-3xl border">
                                Capital
                            </x-strong>
                        </div>
                    </div>

                </x-table-grid>
            @endif

            {{-- modal ver más detalles --}}
            @if ($openShow)
                <x-modal openPropiety="openShow">
                    {{-- fecha de registro --}}
                    <div class="w-full flex flex-row mb-5 justify-between items-center">
                        <x-strong class="!text-xl">Detalles del estado</x-strong>
                        {{-- created_at --}}
                        <div class="text-end">
                            <x-strong>Fecha de regstro: </x-strong>
                            <span>{{$this->estado->created_at}}</span>
                        </div>
                    </div>

                    {{-- datos del registro --}}
                    <div class="grid gap-12 text-center justify-center" style="grid-template-columns: repeat(auto-fiLL, minmax(350px, 1fr));">
                        {{-- nombre --}}
                        <div>
                            <x-legend>Nombre: </x-legend>
                            <x-strong>{{$this->estado->nombre}}</x-strong>
                        </div>

                        {{-- capital --}}
                        <div>
                            <x-legend>Capital: </x-legend>
                            <x-strong>{{$this->estado->capital}}</x-strong>
                        </div>

                        {{-- video --}}
                        <div>
                            <x-legend>Video:</x-legend>
                            <x-strong>{{$this->estado->video}}</x-strong>
                            <iframe width="100%" height="240"
                                src="{{ $this->estado->video }}"
                                frameborder="0"
                                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                class="rounded-md shadow-lg">
                            >
                                <p>No se puede mostrar el video. URL no válida.</p>
                            </iframe>
                        </div>

                        {{-- imagen --}}
                        <div>
                            <x-legend>Portada:</x-legend>
                            <img src="{{img_u_url($this->estado->foto)}}" class="rounded-md shadow-lg" alt="{{$this->estado->foto}}">
                        </div>

                        {{-- triptico --}}
                        <div>
                            <x-legend>Tríptico informativo:</x-legend>
                            <iframe src="{{ triptico_url($this->estado->triptico) }}" width="100%" height="500px" class="rounded-md shadow-lg"></iframe>
                        </div>

                        {{-- guia --}}
                        <div>
                            <x-legend>Guía informativa:</x-legend>
                            <iframe src="{{ guia_url($this->estado->guia) }}" width="100%" height="500px" class="rounded-md shadow-lg"></iframe>
                        </div>
                    </div>

                    {{-- culturas relacionados --}}
                    @if ($nCulturas > 0)
                        <div class="my-6">
                            <x-legend>Culturas relacionadas a este estado:</x-legend>
                            <div class="flex items-center flex-wrap justify-start mt-2 gap-6">
                                @foreach ($this->culturasActuales as $cultura)
                                    <div wire:key="Culturas-Seleccioandos{{$cultura->idCultura}}" class="flex items-center min-w-40 bg-zinc-100 shadow-md px-3 py-1 rounded-md gap-4 justify-between">
                                        <x-strong>{{$cultura->nombre}}</x-strong>
                                        <x-checkbox checked disabled class="!bg-green-300 !cursor-default" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- el jodido mapa --}}
                    <div class="w-full">
                        <div id="mapaEstado" class="w-full h-96 rounded-lg"></div>
                    </div>

                    {{-- fecha de actualizacion y boton cerrar --}}
                    <div class="flex flex-row justify-between items-center">
                        {{-- updated_at --}}
                        <div>
                            <x-strong>Ultima actualización: </x-strong>
                            <span>{{$this->estado->updated_at}}</span>
                        </div>
                        <x-button tipo="close" wire:click="$set('openShow', false)">
                            Cerrar
                        </x-button>
                    </div>
                </x-modal>
            @endif

            {{-- formulario modal editar y actualizar --}}
            @if ($estadoUpdate->openEdit)
                <x-modal openPropiety="estadoUpdate.openEdit">

                    {{-- nombre estado y boton de cierre --}}
                    <h2 class="text-4xl text-center flex flex-row justify-between">
                        <x-strong class="!text-xl">Editar Registro</x-strong>
                    </h2>
                    {{-- formulario editar --}}
                    <form wire:submit="update" enctype="multipart/form-data" class="py-3 flex flex-col gap-6 text-sm">
                        @csrf

                        <div class="grid gap-12 overflow-hidden" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                            {{-- nombre, capital y url de video --}}
                            <div class="flex flex-col justify-between gap-12">
                                {{-- nombre --}}
                                <x-fieldset>
                                    <x-legend>Nombre:</x-legend>
                                    <x-input wire:model.live="estadoUpdate.nombre" />
                                    <x-error-message for="estadoUpdate.nombre" />
                                </x-fieldset>
                                {{-- capital --}}
                                <x-fieldset>
                                    <x-legend>Capital:</x-legend>
                                    <x-input wire:model.live="estadoUpdate.capital" value="{{old('capital')}}" />
                                    <x-error-message for="estadoUpdate.capital" />
                                </x-fieldset>
                                {{-- video --}}
                                <x-fieldset>
                                    <x-legend class="normal-case">URL del video</x-legend>
                                    <x-input wire:model.live="estadoUpdate.video" value="{{old('video')}}" />
                                    <x-error-message for="estadoUpdate.video" />
                                </x-fieldset>

                                {{-- lista de relacion con tabla de estados --}}
                                @if ($nCulturas > 0)
                                    {{-- boton ver lista --}}
                                    <x-fieldset class="">
                                        <x-legend class="normal-case">Culturas relacionadas a este estado</x-legend>
                                        <div class="flex w-full mt-2 justify-between">
                                            {{-- abrir modal de checkboxes --}}
                                            <x-button wire:click="$set('estadoUpdate.openCulturasCheck', true)">
                                                Ver Lista
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M40 48C26.7 48 16 58.7 16 72l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24L40 48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM16 232l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0z"/></svg>
                                            </x-button>
                                            {{-- numero de estados seleccionados --}}
                                            <x-strong>
                                                {{count(array_diff(array_merge($this->estadoUpdate->culturasActualesID,
                                                $this->estadoUpdate->culturasUpdateID), $this->estadoUpdate->culturasRemoveID))}}
                                                culturas seleccionadas
                                            </x-strong>
                                        </div>
                                        <x-error-message for="culturaUpdate.estadosActualesID" />
                                    </x-fieldset>

                                    {{-- modal lsita checkboxes de estados --}}
                                    @if ($estadoUpdate->openCulturasCheck)
                                        <x-modal openPropiety="estadoUpdate.openCulturasCheck">
                                            <x-strong class="!text-xl text-end">
                                                Selecciona las culturas que que han conformado a este estado
                                            </x-strong>

                                            {{-- checboxes de estados totales y estados relacionados a la cultura actual --}}
                                            <div class="grid grid-cols-auto-fill-200 gap-x-10 my-3 gap-y-6 content-between grid-flow-row w-full">
                                                @foreach ($culturasRegistradas as $cultura)
                                                    {{-- estado y checkbox --}}
                                                    <div wire:key="Culturas-Actuales-{{$cultura->idCultura}}" class="flex justify-between bg-zinc-100 hover:bg-stone-200 hover:shadow-lg shadow-md rounded-lg px-4 py-2">
                                                        <x-legend class="text-start">{{$cultura->nombre}}</x-legend>
                                                        {{-- sincronizacion de los checkboxes con los estados relacionados actuales --}}
                                                        <x-checkbox
                                                            wire:click="updateCultura({{ $cultura->idCultura }})"
                                                            :checked="in_array($cultura->idCultura,
                                                                                array_merge(
                                                                                    array_diff($this->estadoUpdate->culturasActualesID, $this->estadoUpdate->culturasRemoveID),
                                                                                    $this->estadoUpdate->culturasUpdateID
                                                                                ))"
                                                            :class="in_array($cultura->idCultura, $this->estadoUpdate->culturasActualesID)
                                                                        ? (in_array($cultura->idCultura, $this->estadoUpdate->culturasRemoveID)
                                                                            ? 'bg-white border-gray-300'
                                                                            : '!bg-green-300')
                                                                        : 'bg-white border-gray-300'"
                                                        />
                                                    </div>
                                                @endforeach
                                            </div>

                                            {{-- paginador de estados --}}
                                            <div class="">
                                                <x-paginador :table="$culturasRegistradas" />
                                            </div>

                                            {{-- confirmar --}}
                                            <x-button tipo="check" class="self-end mt-3" wire:click="$set('estadoUpdate.openCulturasCheck', false)">
                                                Confirmar
                                            </x-button>
                                        </x-modal>
                                    @endif
                                @endif

                            </div>

                            {{-- foto, triptcio y guia --}}
                            <div class="flex flex-col gap-12">
                                {{-- foto --}}
                                <x-fieldset>
                                    <x-legend>Portada</x-legend>
                                    <input type="file" wire:model.live="estadoUpdate.foto" wire:key="{{$fotoKey}}" accept="image/*">
                                    <img src="{{img_u_url($this->estado->foto)}}" width="60%" class="rounded-md shadow-md shadow-slate-400 mt-2" alt="{{$this->estado->foto}}">
                                    <x-error-message for="estadoUpdate.foto" />
                                </x-fieldset>
                                {{-- triptico --}}
                                <x-fieldset>
                                    <x-legend>Triptico <small class="text-xs font-normal underline lowercase"> solo archivos pdf</small></x-legend>
                                    <input type="file" class="block" wire:model.live="estadoUpdate.triptico" wire:key="{{$tripticoKey}}" accept=".pdf">
                                    <x-label class="text-xs">
                                        Fichero actual:
                                        <em class="font-normal underline">{{$this->estado->triptico}}</em>
                                    </x-label>
                                    <x-error-message for="estadoUpdate.triptico" />
                                </x-fieldset>
                                {{-- guia --}}
                                <x-fieldset>
                                    <x-legend>Guia informativa <small class="text-xs font-normal underline lowercase"> Solo archivos PDF</small></x-legend>
                                    <input type="file" class="block"  wire:model.live="estadoUpdate.guia" wire:key="{{$guiaKey}}" accept=".pdf">
                                    <x-label class="text-xs">
                                        Fichero actual:
                                        <em class="font-normal underline">{{$this->estado->guia}}</em>
                                    </x-label>
                                    <x-error-message for="estadoUpdate.guia" />
                                </x-fieldset>
                            </div>
                        </div>

                        {{-- botones de actualizar y cancelar --}}
                        <div class="flex flex-row justify-end gap-4">
                            {{-- actualizar --}}
                            <x-button type="submit" tipo="update">
                                Actualizar
                            </x-button>

                            {{-- cancelar --}}
                            <x-button tipo="cancel" wire:click="$set('estadoUpdate.openEdit', false)">
                                Cancelar
                            </x-button>
                        </div>
                    </form>

                </x-modal>
            @endif

        </div>

    </div>

</div>
