@php
    $first = $culturas -> first();
    $keys = $first ? array_keys($first->getAttributes()) : [];
@endphp

{{-- VISTA DEL COMPONENTE CULTURAS --}}
<div class="w-full h-full">

    <div class="py-5">

        <div class="w-full h-fullitems-center justify-center flex flex-col gap-7 px-7">

            {{-- botones volver, agregar y cancelar --}}
            <x-crud-buttons-header :form_object="$culturaCreate" name_form="culturaCreate" />

            {{-- formularo crear cultura --}}
            @if ($culturaCreate->openCreate)
                <div class="sbw-thin w-full flex flex-col justify-between gap-8 rounded-xl">
                    @if ($nEstados < 1)
                        <x-not-found>
                            Aún no existen registros de Estados de la República Mexicana. <br>
                            Ingresa algunos para continuar.
                            <x-button class="w-full mt-4" route="admin.estados" tipo="go" />
                        </x-not-found>
                    @else
                        {{-- titulo --}}
                        <h1 class="text-3xl">
                            <x-strong>Agregar Cultura</x-strong>
                        </h1>
                        {{-- formulario --}}
                        <form wire:submit="save" enctype="multipart/form-data" class="w-full italic flex flex-col gap-2">
                            @csrf
                            {{-- nombre --}}
                            <x-fieldset>
                                <x-legend>Nombre*</x-legend>
                                <x-input wire:model.live="culturaCreate.nombre" value="{{old('nombre')}}" />
                                <x-error-message for="culturaCreate.nombre" />
                            </x-fieldset>

                            {{-- periodo y significado --}}
                            <div class="flex flex-row justify-between gap-12">
                                {{-- periodo --}}
                                <x-fieldset>
                                    <x-legend>Periodo*</x-legend>
                                    <x-textarea wire:model.live="culturaCreate.periodo">{{old('periodo')}}</x-textarea>
                                    <x-error-message for="culturaCreate.periodo" />
                                </x-fieldset>

                                {{-- significado --}}
                                <x-fieldset>
                                    <x-legend>Significado*</x-legend>
                                    <x-textarea wire:model.live="culturaCreate.significado">{{old('significado')}}</x-textarea>
                                    <x-error-message for="culturaCreate.significado" />
                                </x-fieldset>
                            </div>

                            {{-- descripcion --}}
                            <x-fieldset>
                                <x-legend>Descripcion*</x-legend>
                                <x-textarea wire:model.live="culturaCreate.descripcion">{{old('descripcion')}}</x-textarea>
                                <x-error-message for="culturaCreate.descripcion" />
                            </x-fieldset>

                            {{-- aportaciones --}}
                            <x-fieldset>
                                <x-legend>Aportaciones*</x-legend>
                                <x-textarea wire:model.live="culturaCreate.aportaciones">{{old('aportaciones')}}</x-textarea>
                                <x-error-message for="culturaCreate.aportaciones" />
                            </x-fieldset>

                            {{-- boton de relacion con tabla de estados --}}
                            <x-fieldset class="mb-5 mt-2">
                                <x-legend class="normal-case">Estados a los que pertenece esta cultura*</x-legend>
                                <div class="flex w-full mt-2 justify-between">
                                    <x-button wire:click="$set('culturaCreate.openStatesSelect', true)">
                                        Seleccionar
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M40 48C26.7 48 16 58.7 16 72l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24L40 48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM16 232l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0z"/></svg>
                                    </x-button>
                                    <x-strong>
                                        {{count($culturaCreate->estadosID)}} estados seleccionados
                                    </x-strong>
                                </div>
                                <x-error-message for="culturaCreate.estadosID" />
                            </x-fieldset>

                            {{-- modal checkboxes estados --}}
                            @if ($culturaCreate->openStatesSelect)
                                <x-modal openPropiety="culturaCreate.openStatesSelect">
                                    <x-strong class="!text-xl text-end">Selecciona los estados a los que pertenece esta cultura</x-strong>
                                    <div class="grid grid-cols-auto-fill-200 gap-x-10 my-3 gap-y-6 content-between grid-flow-row w-full">
                                        @foreach ($estadosRegistrados as $estado)
                                            <div wire:key="Culturas-Estados-{{$estado->idEstadoRepublica}}" class="flex justify-between bg-zinc-100 hover:bg-stone-200 hover:shadow-lg shadow-md rounded-lg px-4 py-2">
                                                <x-legend class="text-start">{{$estado->nombre}}</x-legend>
                                                <x-checkbox
                                                    class="bg-white"
                                                    wire:click="saveEstado({{$estado->idEstadoRepublica}})"
                                                    :checked="in_array($estado->idEstadoRepublica, $culturaCreate->estadosID)"
                                                />
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- paginador de estados --}}
                                    <div class="">
                                        <x-paginador :table="$estadosRegistrados" />
                                    </div>

                                    <x-button tipo="check" class="self-end mt-3" wire:click="$set('culturaCreate.openStatesSelect', false)">
                                        Confirmar
                                    </x-button>
                                </x-modal>
                            @endif

                            {{-- fotos --}}
                            <x-fieldset>
                                <x-legend>Fotos* <small class="text-xs font-bold"> Min 2. Max. 4</small></x-legend>
                                <input type="file" wire:model.live="culturaCreate.imagenes" wire:key="{{$fotoKey}}" accept="image/*" multiple max="4">
                                <x-error-message for="culturaCreate.imagenes" />
                            </x-fieldset>

                            {{-- boton guardar --}}
                            <div class="flex justify-end gap-2">
                                {{-- agregar --}}
                                <x-button type="submit" tipo="create">
                                    Guardar
                                </x-button>
                            </div>
                        </form>
                    @endif
                </div>
            @endif

            {{-- CRUD CULTURAS --}}
            @if ($nEstados < 1)
                @if (!$culturaCreate->openCreate)
                    <x-not-found class="rounded-2xl !items-center">
                        <div class="flex gap-9 items-center">
                            Hay 0 registros.
                            <span>¡Ingresa algunos!</span>
                            <x-button tipo="up" wire:click="$set('culturaCreate.openCreate', true)" />
                        </div>
                    </x-not-found>
                @endif
            @else
                <x-table-grid :table="$culturas" :keys="$keys" key="Culturas">

                    {{-- slot -> thead --}}
                    <div class=" w-full">
                        <div class="w-2/3 px-2 flex flex-row justify-start gap-9 items-center mb-4 italic text-gray-400 text-start font-thin">
                            <x-strong class="border-gray-200 px-4 shadow-md !rounded-3xl border">
                                ID
                            </x-strong>
                            <x-strong class="border-gray-200 px-4 shadow-md !rounded-3xl border">
                                Nombre de la cultura
                            </x-strong>
                        </div>
                    </div>

                </x-table-grid>
            @endif

            {{-- modal ver más detalles --}}
            @if ($openShow)
                <x-modal openPropiety="openShow">
                    {{-- fecha de registro --}}
                    <div class="w-full flex flex-row justify-between items-center">
                        <x-strong class="!text-xl">Detalles de la cultura</x-strong>
                        {{-- created_at --}}
                        <div class="text-end">
                            <x-strong>Fecha de regstro: </x-strong>
                            <span>{{$this->cultura->created_at}}</span>
                        </div>
                    </div>
                    {{-- datos del registro --}}
                    <div class="show-grid">
                        {{-- nombre --}}
                        <div class="nombre-cultura mb-2">
                            <x-legend>Nombre: </x-legend>
                            <x-strong class="h1u">{{$this->cultura->nombre}}</x-strong>
                        </div>
                        {{-- periodo --}}
                        <div>
                            <x-legend>Periodo: </x-legend>
                            <x-textarea readonly disabled>
                                {{$this->cultura->periodo}}
                            </x-textarea>
                        </div>
                        {{-- significado --}}
                        <div>
                            <x-legend>significado: </x-legend>
                            <x-textarea readonly disabled>
                                {{$this->cultura->significado}}
                            </x-textarea>
                        </div>
                        {{-- aportaciones --}}
                        <div>
                            <x-legend>aportaciones: </x-legend>
                            <x-textarea readonly disabled>
                                {{$this->cultura->aportaciones}}
                            </x-textarea>
                        </div>
                        {{-- descripcion --}}
                        <div>
                            <x-legend>descripcion: </x-legend>
                            <x-textarea readonly disabled>
                                {{$this->cultura->descripcion}}
                            </x-textarea>
                        </div>
                    </div>

                    {{-- imagenes --}}
                    <x-legend>Imagenes:</x-legend>
                    <div class="flex flex-row flex-wrap w-full gap-4 justify-between mb-5">
                        @foreach ($this->cultura->fotos as $foto)
                            <div wire:key="cultura-foto-{{$foto->foto}}" class="rounded-md">
                                <img src="{{img_u_url($foto->foto)}}" width="200px" alt="img-cultura" class="shadow-lg rounded-md">
                            </div>
                        @endforeach
                    </div>

                    {{-- estados relacionados --}}
                    <div>
                        <x-legend>Estados relacionados a esta cultura:</x-legend>
                        <div class="flex items-center flex-wrap justify-start mt-2 gap-6">
                            @foreach ($this->estadosActuales as $estado)
                                <div wire:key="Estados-Seleccioandos{{$estado->idEstadoRepublica}}" class="flex items-center min-w-40 bg-zinc-100 shadow-md px-3 py-1 rounded-md gap-4 justify-between">
                                    <x-strong>{{$estado->nombre}}</x-strong>
                                    <x-checkbox checked disabled class="!bg-green-300 !cursor-default" />
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- fecha de actualizacion y boton cerrar --}}
                    <div class="flex flex-row justify-between mt-4 items-center">
                        {{-- updated_at --}}
                        <div>
                            <x-strong>Ultima actualización: </x-strong>
                            <span>{{$this->cultura->updated_at}}</span>
                        </div>
                        <x-button tipo="close" wire:click="$set('openShow', false)">
                            Cerrar
                        </x-button>
                    </div>
                </x-modal>
            @endif

            {{-- formulario modal editar y actualizar --}}
            @if ($culturaUpdate->openEdit)
                <x-modal openPropiety="culturaUpdate.openEdit">

                    {{-- nombre cultura y boton de cierre --}}
                    <h2 class="text-4xl text-center flex flex-row justify-between">
                        <x-strong class="!text-xl">Editar Registro</x-strong>
                    </h2>
                    {{-- formulario editar --}}
                    <form wire:submit="update" enctype="multipart/form-data" class="py-3 flex flex-col gap-6 text-sm">
                        @csrf
                        {{-- nombre --}}
                        <x-fieldset>
                            <x-legend>Nombre</x-legend>
                            <x-input class="text-gray-500" wire:model.live="culturaUpdate.nombre" value="{{old('nombre')}}" />
                            <x-error-message for="culturaUpdate.nombre" />
                        </x-fieldset>

                        {{-- periodo --}}
                        <x-fieldset>
                            <x-legend>Periodo</x-legend>
                            <x-textarea wire:model.live="culturaUpdate.periodo">{{old('periodo')}}</x-textarea>
                            <x-error-message for="culturaUpdate.periodo" />
                        </x-fieldset>

                        {{-- significado --}}
                        <x-fieldset>
                            <x-legend>Significado</x-legend>
                            <x-textarea wire:model.live="culturaUpdate.significado">{{old('significado')}}</x-textarea>
                            <x-error-message for="culturaUpdate.significado" />
                        </x-fieldset>

                        {{-- descripcion y aportaciones --}}
                        <div class="flex flex-row w-full justify-between gap-6">
                            {{-- descripcion --}}
                            <x-fieldset>
                                <x-legend>Descripcion</x-legend>
                                <x-textarea wire:model.live="culturaUpdate.descripcion">{{old('descripcion')}}</x-textarea>
                                <x-error-message for="culturaUpdate.descripcion" />
                            </x-fieldset>

                            {{-- aportaciones --}}
                            <x-fieldset>
                                <x-legend>Aportaciones</x-legend>
                                <x-textarea wire:model.live="culturaUpdate.aportaciones">{{old('aportaciones')}}</x-textarea>
                                <x-error-message for="culturaUpdate.aportaciones" />
                            </x-fieldset>
                        </div>

                        {{-- lista de relacion con tabla de estados --}}
                        <x-fieldset class="mb-5 mt-2">
                            <x-legend class="normal-case">Estados a los que pertenece esta cultura</x-legend>
                            <div class="flex w-full mt-2 justify-between">
                                {{-- abrir modal de checkboxes --}}
                                <x-button wire:click="$set('culturaUpdate.openStatesSelect', true)">
                                    Ver Lista
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M40 48C26.7 48 16 58.7 16 72l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24L40 48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM16 232l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0z"/></svg>
                                </x-button>
                                {{-- numero de estados seleccionados --}}
                                <x-strong>
                                    {{count(array_diff(array_merge($this->culturaUpdate->estadosActualesID,  $this->culturaUpdate->estadosUpdateID), $this->culturaUpdate->estadosRemovedID))}}
                                    estados seleccionados
                                </x-strong>
                            </div>
                            <x-error-message for="culturaUpdate.estadosActualesID" />
                        </x-fieldset>

                        {{-- modal lsita checkboxes de estados --}}
                        @if ($culturaUpdate->openStatesSelect)
                            <x-modal openPropiety="culturaUpdate.openStatesSelect">
                                <x-strong class="!text-xl text-end">
                                    Selecciona los estados a los que pertenece esta cultura
                                </x-strong>

                                {{-- checboxes de estados totales y estados relacionados a la cultura actual --}}
                                <div class="grid grid-cols-auto-fill-200 gap-x-10 my-3 gap-y-6 content-between grid-flow-row w-full">
                                    @foreach ($estadosRegistrados as $estado)
                                        {{-- estado y checkbox --}}
                                        <div wire:key="Estados-actuales-{{$estado->idEstadoRepublica}}" class="flex justify-between bg-zinc-100 hover:bg-stone-200 hover:shadow-lg shadow-md rounded-lg px-4 py-2">
                                            <x-legend class="text-start">{{$estado->nombre}}</x-legend>
                                            {{-- sincronizacion de los checkboxes con los estados relacionados actuales --}}
                                            <x-checkbox
                                                wire:click="updateEstado({{ $estado->idEstadoRepublica }})"
                                                :checked="in_array($estado->idEstadoRepublica,
                                                                    array_merge(
                                                                        array_diff($this->culturaUpdate->estadosActualesID, $this->culturaUpdate->estadosRemovedID),
                                                                        $this->culturaUpdate->estadosUpdateID
                                                                    ))"
                                                :class="in_array($estado->idEstadoRepublica, $this->culturaUpdate->estadosActualesID)
                                                            ? (in_array($estado->idEstadoRepublica, $this->culturaUpdate->estadosRemovedID)
                                                                ? 'bg-white border-gray-300'
                                                                : '!bg-green-300')
                                                            : 'bg-white border-gray-300'"
                                            />
                                        </div>
                                    @endforeach
                                </div>

                                {{-- paginador de estados --}}
                                <div class="">
                                    <x-paginador :table="$estadosRegistrados" />
                                </div>

                                {{-- confirmar --}}
                                <x-button tipo="check" class="self-end mt-3" wire:click="$set('culturaUpdate.openStatesSelect', false)">
                                    Confirmar
                                </x-button>
                            </x-modal>
                        @endif

                        {{-- fotos --}}
                        <x-fieldset class="mb-4 text-center">
                            <x-legend>Imagenes actuales</x-legend>
                            <div class="grid grid-cols-auto-fill-250 text-start mt-6 justify-between content-between gap-x-10 gap-y-14">
                                @foreach ($this->cultura->fotos as $foto)
                                    <div class="flex flex-col gap-3 justify-between p-6 relative overflow-hidden text-ellipsis rounded-md break-all text-nowrap bg-slate-100 items-start w-full" wire:key="{{$foto->idCulturaFoto}}">
                                        {{-- imagen actual --}}
                                        <div class="w-full flex justify-center">
                                            <img src="{{img_u_url($foto->foto)}}" class="shadow-md rounded-md" width="200px" alt="img-cultura">
                                        </div>

                                        {{-- actualizar y / o borrar imagen actual --}}
                                        <div class="flex flex-col justify-between gap-3 !text-xs text-gray-400 items-start align-items-start">
                                            {{-- eliminar imagen --}}
                                            <div class="flex absolute top-2 right-3 flex-row gap-5 items-center justify-center">
                                                <div class="relative flex justify-center items-center">
                                                    <x-checkbox
                                                        wire:model="culturaUpdate.to_eliminate_imgs.{{$foto->idCulturaFoto}}"
                                                        name="to_eliminate_imgs.{{$foto->idCulturaFoto}}"
                                                        onchange="disabled_input('{{$foto->idCulturaFoto}}')"
                                                        class="peer bg-white"
                                                    />
                                                    <span class="absolute text-center peer-checked:bg-slate-300 peer-checked:rounded-md pointer-events-none p-1 top-0 right-0 left-0 bottom-0">
                                                        <svg width="100%" fill="#e82721" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304L80 128zm80 64l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
                                                    </span>
                                                </div>
                                                {{-- <x-label><x-strong>Eliminar imagen</x-strong></x-label> --}}
                                                <x-error-message for="culturaUpdate.to_eliminate_imgs.{{$foto->idCulturaFoto}}" />
                                            </div>
                                            {{-- actualizar imagen --}}
                                            <div class="flex text-start gap-2 flex-col">
                                                <x-label>Actualizar imagen</x-label>
                                                <input
                                                    type="file"
                                                    wire:model="culturaUpdate.imgs_update.{{$foto->idCulturaFoto}}"
                                                    wire:key="{{$culturaUpdate->fotoKey}}"
                                                    name="imgs_update.{{$foto->idCulturaFoto}}"
                                                    accept="image/*"
                                                    class="text-xs bg-white rounded-sm"
                                                >
                                                <x-error-message for="culturaUpdate.imgs_update.{{$foto->idCulturaFoto}}" />
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </x-fieldset>

                        {{-- agregar fotos --}}
                        @if ($culturaUpdate->imgs_count < 4)
                            <x-fieldset>
                                <x-legend><x-strong>Agregar imagenes</x-strong></x-legend>
                                <input type="file" wire:model="culturaUpdate.imgs_nuevas" wire:key="{{$culturaUpdate->fotoKey}}" accept="image/*" multiple max="4">
                                <x-error-message for="culturaUpdate.imgs_nuevas" />
                            </x-fieldset>
                        @endif

                        {{-- botones de actualizar y cancelar --}}
                        <div class="flex flex-row justify-end gap-6">
                            {{-- actualizar --}}
                            <x-button type="submit" tipo="update">
                                Actualizar
                            </x-button>

                            {{-- cancelar --}}
                            <x-button tipo="cancel" wire:click="$set('culturaUpdate.openEdit', false)">
                                Cancelar
                            </x-button>
                        </div>
                    </form>

                </x-modal>
            @endif

        </div>

    </div>

</div>
