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

                            {{-- relacion con tabla estados --}}
                            <x-fieldset class="mb-5 mt-2">
                                <x-legend class="normal-case">Estados a los que pertenece esta cultura*</x-legend>
                                <x-button wire:click="$set('culturaCreate.openStatesSelect', true)">
                                    Seleccionar
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M40 48C26.7 48 16 58.7 16 72l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24L40 48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM16 232l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0z"/></svg>
                                </x-button>
                                <x-error-message for="culturaCreate.estadosID" />
                            </x-fieldset>

                            {{-- fotos --}}
                            <x-fieldset>
                                <x-legend>Fotos* <small class="text-xs font-bold"> Min 2. Max. 4</small></x-legend>
                                <input type="file" wire:model.live="culturaCreate.imagenes" wire:key="{{$fotoKey}}" accept="image/*" multiple max="4">
                                <x-error-message for="culturaCreate.imagenes" />
                            </x-fieldset>

                            @if ($culturaCreate->openStatesSelect)
                                <x-modal openPropiety="culturaCreate.openStatesSelect">
                                    <x-strong class="!text-xl text-end">Selecciona los estados a los que pertenece esta cultura</x-strong>
                                    <div class="grid grid-cols-4 gap-x-10 gap-y-8 grid-flow-row w-full">
                                        @foreach ($estados as $estado)
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
                                    <x-paginador :table="$estados"/>

                                    <x-button tipo="check" class="self-end" wire:click="$set('culturaCreate.openStatesSelect', false)">
                                        Confirmar
                                    </x-button>
                                </x-modal>
                            @endif
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
                            <x-strong>{{$this->cultura->nombre}}</x-strong>
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

                    <x-legend>Imagenes:</x-legend>
                    {{-- imagenes --}}
                    <div class="flex flex-row flex-wrap w-full justify-between mb-5">
                        @foreach ($this->cultura->fotos as $foto)
                            <div wire:key="cultura-foto-{{$foto->foto}}" class="rounded-md">
                                <img src="{{img_u_url($foto->foto)}}" width="200px" alt="img-cultura" class="shadow-lg rounded-md">
                            </div>
                        @endforeach
                    </div>

                    {{-- fecha de actualizacion y boton cerrar --}}
                    <div class="flex flex-row justify-between items-center">
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
                            <x-input wire:model.live="culturaUpdate.nombre" value="{{old('nombre')}}" />
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

                        {{-- fotos --}}
                        <x-fieldset>
                            <x-legend>Imagenes actuales</x-legend>
                            @foreach ($this->cultura->fotos as $foto)
                                <div class="my-5 w-full" wire:key="{{$foto->idCulturaFoto}}">
                                    {{-- actualizar y / o borrar imagen actual --}}
                                    <div class="flex flex-row justify-between items-center">
                                        {{-- actualizar imagen --}}
                                        <div class="flex flex-col">
                                            <x-label><x-strong>Subir nueva imagen</x-strong></x-label>
                                            <input
                                                type="file"
                                                wire:model="culturaUpdate.imgs_update.{{$foto->idCulturaFoto}}"
                                                wire:key="{{$culturaUpdate->fotoKey}}"
                                                name="imgs_update.{{$foto->idCulturaFoto}}"
                                                accept="image/*"
                                            >
                                            <x-error-message for="culturaUpdate.imgs_update.{{$foto->idCulturaFoto}}" />
                                        </div>
                                        {{-- eliminar imagen --}}
                                        <div class="flex flex-row gap-5 items-center justify-center">
                                            <x-label><x-strong>Eliminar imagen</x-strong></x-label>
                                            <x-checkbox
                                                wire:model="culturaUpdate.to_eliminate_imgs.{{$foto->idCulturaFoto}}"
                                                name="to_eliminate_imgs.{{$foto->idCulturaFoto}}"
                                                onchange="disabled_input('{{$foto->idCulturaFoto}}')"
                                            />
                                            <x-error-message for="culturaUpdate.to_eliminate_imgs.{{$foto->idCulturaFoto}}" />
                                        </div>
                                    </div>

                                    {{-- imagen actual --}}
                                    <div class="mt-2">
                                        <img src="{{img_u_url($foto->foto)}}" class="shadow-md rounded-md" width="150px" alt="img-cultura">
                                    </div>
                                </div>
                            @endforeach
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
                        <div class="flex flex-row justify-end gap-4">
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
