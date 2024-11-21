@php
    $first = $zonas -> first();
    $keys = $first ? array_keys($first -> getAttributes()) : [];
@endphp

{{-- VISTA DEL COMPONENTE zonas --}}
<div class="w-full h-full">

    <div class="py-5">

        <div class="w-full h-fullitems-center justify-center flex flex-col gap-14 px-7">

            {{-- botones volver y mostrar create form --}}
            <x-crud-buttons-header :form_object="$zonaCreate" name_form="zonaCreate" />

            {{-- formularo crear zona --}}
            @if ($zonaCreate->openCreate)
                <div class="sbw-thin w-full flex flex-col justify-between gap-8 rounded-xl">
                    @if ($nCulturas < 1 && $nEstados < 1)
                        <x-not-found>
                            ¡Aún no existen registros de Culturas y Estados de la Republica Mexicana! <br>
                            Ingresa algunos para continuar.
                            <x-button class="w-full mt-4" wire:click="redirigir('database')" tipo="go" />
                        </x-not-found>
                    @elseif($nCulturas < 1)
                        <x-not-found>
                            ¡Aún no existen registros de Culturas! <br>
                            Ingresa algunas para continuar.
                            <x-button class="w-full mt-4" wire:click="redirigir('culturas')" tipo="go" />
                        </x-not-found>
                    @elseif($nEstados < 1)
                        <x-not-found>
                            ¡Aún no existen registros de Estados de la República Mexicana! <br>
                            Ingresa algunos para continuar.
                            <x-button class="w-full mt-4" wire:click="redirigir('estados')" tipo="go" />
                        </x-not-found>
                    @else
                        {{-- titulo --}}
                        <h1 class="text-3xl">
                            <x-strong>Agregar zona arqueológica</x-strong>
                        </h1>
                        {{-- formulario --}}
                        <form wire:submit="save" enctype="multipart/form-data" class="w-full italic flex flex-col gap-7">
                            @csrf
                            <div class="grid grid-cols-auto-fit-400 gap-10 items-end">
                                {{-- nombre --}}
                                <x-fieldset>
                                    <x-legend>Nombre*</x-legend>
                                    <x-input class="!text-gray-500" wire:model.live="zonaCreate.nombre" />
                                    <x-error-message for="zonaCreate.nombre" />
                                </x-fieldset>

                                {{-- costo de entrada --}}
                                <x-fieldset>
                                    <x-legend>Costo de entrada*</x-legend>
                                    <x-input wire:model.live="zonaCreate.costoEntrada" class="!w-1/3" placeholder="$ 00.00 MXN" />
                                    <x-error-message for="zonaCreate.costoEntrada" />
                                </x-fieldset>

                                {{-- significado --}}
                                <x-fieldset>
                                    <x-legend>Significado*</x-legend>
                                    <x-textarea wire:model.live="zonaCreate.significado"></x-textarea>
                                    <x-error-message for="zonaCreate.significado" />
                                </x-fieldset>

                                {{-- relevancia cultural --}}
                                <x-fieldset>
                                    <x-legend>Relevancia cultural*</x-legend>
                                    <x-textarea wire:model.live="zonaCreate.relevancia"></x-textarea>
                                    <x-error-message for="zonaCreate.relevancia" />
                                </x-fieldset>

                                {{-- acceso --}}
                                <x-fieldset>
                                    <x-legend>Acceso*</x-legend>
                                    <x-textarea wire:model.live="zonaCreate.acceso"></x-textarea>
                                    <x-error-message for="zonaCreate.acceso" />
                                </x-fieldset>

                                {{-- contacto --}}
                                <x-fieldset>
                                    <x-legend>Información de contacto*</x-legend>
                                    <x-textarea wire:model.live="zonaCreate.contacto"></x-textarea>
                                    <x-error-message for="zonaCreate.contacto" />
                                </x-fieldset>

                                {{-- horario --}}
                                <div class="flex flex-col justify-between col-start-1 -col-end-1 gap-4">
                                    <x-label>Horario*</x-label>
                                    <div class="flex flex-row text-xs justify-between gap-12">
                                        {{-- de dia --}}
                                        <x-fieldset>
                                            <x-legend>De</x-legend>
                                            <x-select wire:model.live="zonaCreate.deDia">
                                                <option value="lunes">Lunes</option>
                                                <option value="martes">Martes</option>
                                                <option value="miercoles">Miercoles</option>
                                                <option value="jueves">Jueves</option>
                                                <option value="viernes">Viernes</option>
                                                <option value="sabado">Sabado</option>
                                                <option value="domingo">Domingo</option>
                                            </x-select>
                                            <x-error-message for="zonaCreate.deDia" />
                                        </x-fieldset>
                                        {{-- a dia --}}
                                        <x-fieldset>
                                            <x-legend>a</x-legend>
                                            <x-select wire:model.live="zonaCreate.aDia">
                                                <option value="domingo">Domingo</option>
                                                <option value="lunes">Lunes</option>
                                                <option value="martes">Martes</option>
                                                <option value="miercoles">Miercoles</option>
                                                <option value="jueves">Jueves</option>
                                                <option value="viernes">Viernes</option>
                                                <option value="sabado">Sabado</option>
                                            </x-select>
                                            <x-error-message for="zonaCreate.aDia" />
                                        </x-fieldset>

                                        {{-- de hora --}}
                                        <x-fieldset>
                                            <x-legend>De las</x-legend>
                                            <x-input type="time" wire:model.live="zonaCreate.deHora" />
                                            <x-error-message for="zonaCreate.deHora" />
                                        </x-fieldset>
                                        {{-- a hora --}}
                                        <x-fieldset>
                                            <x-legend>a las</x-legend>
                                            <x-input type="time" wire:model.live="zonaCreate.aHora" />
                                            <x-error-message for="zonaCreate.aHora" />
                                        </x-fieldset>
                                    </div>
                                </div>

                                {{-- relacion con estados --}}
                                <x-fieldset>
                                    <x-legend class="!normal-case">¿En qué estado de la República Mexicana se encuentra esta Zona Arqueológica?*</x-legend>
                                    <x-select wire:model.live="zonaCreate.estadoRelacionado">
                                        <option value="" disabled>Selecciona un Estado</option>
                                        @foreach ($estados as $estado)
                                            <option
                                                value="{{$estado->idEstadoRepublica}}"
                                                {{$zonaCreate->estadoRelacionado == $estado->idEstadoRepublica ? 'selected' : ''}}
                                            >
                                                {{$estado->nombre}}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    <x-error-message for="zonaCreate.estado" />
                                </x-fieldset>

                                {{-- relacion con culturas --}}
                                <x-fieldset>
                                    <x-legend class="normal-case">¿A qué cultura de Mexico pertenece esta Zona Arqueológica?*</x-legend>
                                    <x-select wire:model.live="zonaCreate.culturaRelacionada">
                                        <option value="" disabled>Selecciona una Cultura</option>
                                        @foreach ($culturas as $cultura)
                                            <option
                                                value="{{$cultura->idCultura}}"
                                                {{$zonaCreate->culturaRelacionada == $cultura->idCultura ? 'selected' : ''}}
                                            >
                                                {{$cultura->nombre}}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    <x-error-message for="zonaCreate.cultura" />
                                </x-fieldset>

                                {{-- condicion o status --}}
                                <x-fieldset>
                                    <x-legend>Condición*</x-legend>
                                    <x-select wire:model.live="zonaCreate.condicion">
                                        <option
                                            disabled
                                            value=""
                                            {{$zonaCreate->condicion == '' ? 'selected' : ''}}
                                        >
                                            Selecciona un estatus
                                        </option>
                                        <option value="abierta">
                                            Abierta
                                        </option>
                                        <option value="no abierta">
                                            No abierta
                                        </option>
                                    </x-select>
                                    <x-error-message for="zonaCreate.condicion" />
                                </x-fieldset>

                                {{-- direccion --}}
                                <x-fieldset>
                                    <x-legend>Dirección*</x-legend>
                                    <x-input wire:model.live="zonaCreate.direccion" id="address" placeholder="Busca una dirección" />
                                    <x-error-message for="zonaCreate.direccion" />
                                </x-fieldset>

                                {{-- fotos --}}
                                <x-fieldset>
                                    <x-legend>Fotos* <small class="text-xs font-bold"> Min 2. Max. 4</small></x-legend>
                                    <input type="file" wire:model.live="zonaCreate.imagenes" wire:key="{{$fotoKey}}" accept="image/*" multiple>
                                    <x-error-message for="zonaCreate.imagenes" />
                                </x-fieldset>
                            </div>
                            {{-- boton guardar --}}
                            <div class="col-start-2 flex justify-end self-end justify-self-end gap-2">
                                {{-- agregar --}}
                                <x-button type="submit" tipo="create">
                                    Guardar
                                </x-button>
                            </div>
                        </form>
                    @endif
                </div>
            @endif

            {{-- CRUD ZONAS --}}
            @if ($nCulturas < 1 || $nEstados < 1)
                @if (!$zonaCreate->openCreate)
                    <x-not-found class="rounded-2xl !items-center">
                        <div class="flex gap-9 items-center">
                            ¡Hay 0 zonas arqueologicas!
                            <span>Ingresa algunas:</span>
                            <x-button tipo="up" wire:click="$set('zonaCreate.openCreate', true)" />
                        </div>
                    </x-not-found>
                @endif
            @else
                <x-table-grid :table="$zonas" :keys="$keys" key="Zonas">

                    {{-- slot -> thead --}}
                    <div class=" w-full">
                        <div class="w-2/3 px-2 flex flex-row justify-start gap-9 items-center mb-4 italic text-gray-400 text-start font-thin">
                            <x-strong class="text-xs border-gray-200 px-4 shadow-md !rounded-3xl border">
                                ID
                            </x-strong>
                            <x-strong class="text-xs border-gray-200 px-4 shadow-md !rounded-3xl border">
                                Nombre de la Zona Arqueológica
                            </x-strong>
                        </div>
                    </div>

                </x-table-grid>
            @endif

            {{-- modal ver más detalles --}}
            @if ($openShow)
                <x-modal openPropiety="openShow" :registerUpdateAt="$this->zona">

                    {{-- fecha de registro --}}
                    <div class="w-full flex flex-row justify-between items-center">
                        <x-strong class="!text-xl">Detalles de la zona</x-strong>
                        {{-- created_at --}}
                        <div class="text-end">
                            <x-strong>Fecha de regstro: </x-strong>
                            <span>{{$this->zona->created_at}}</span>
                        </div>
                    </div>

                    {{-- datos del registro --}}
                    <div class="grid grid-cols-auto-fill-200 gap-8">
                        {{-- nombre y slug --}}
                        <div class="nombre-zona mb-2">
                            {{-- nombre --}}
                            <div class="flex items-center">
                                <x-legend>Nombre: </x-legend>
                                <x-strong class="h1u">{{$this->zona->nombre}}</x-strong>
                            </div>
                            {{-- slug --}}
                            <div class="flex items-center">
                                <x-legend>Slug: </x-legend>
                                <x-strong class="!normal-case">{{$this->zona->slug}}</x-strong>
                            </div>
                        </div>
                        {{-- condicion y csoto --}}
                        <div class="nombre-zona mb-2">
                            {{-- condicion --}}
                            <div class="flex items-center">
                                <x-legend>Condición: </x-legend>
                                <x-strong class="!normal-case">{{$this->zona->condicion}}</x-strong>
                            </div>
                            {{-- costo entrada --}}
                            <div class="flex items-center">
                                <x-legend>Costo de entrada: </x-legend>
                                <x-strong>{{$this->zona->costoEntrada}}</x-strong>
                            </div>
                        </div>

                        {{-- significado --}}
                        <div>
                            <x-legend>Significado: </x-legend>
                            <x-textarea readonly disabled>
                                {{$this->zona->significado}}
                            </x-textarea>
                        </div>
                        {{-- relevancia cultural --}}
                        <div>
                            <x-legend>Relevancia cultural: </x-legend>
                            <x-textarea readonly disabled>
                                {{$this->zona->relevancia}}
                            </x-textarea>
                        </div>
                        {{-- acceso --}}
                        <div>
                            <x-legend>Acceso: </x-legend>
                            <x-textarea readonly disabled>
                                {{$this->zona->acceso}}
                            </x-textarea>
                        </div>
                        {{-- contacto --}}
                        <div>
                            <x-legend>Contacto: </x-legend>
                            <x-textarea readonly disabled>
                                {{$this->zona->contacto}}
                            </x-textarea>
                        </div>
                        {{-- horario --}}
                        <div class="nombre-zona">
                            <x-legend>Horario: </x-legend>
                            <x-strong class="!capitalize">{{$this->zona->horario}}</x-strong>
                        </div>
                    </div>

                    {{-- cultura y estado relacionados --}}
                    <div class="flex justify-between">
                        {{-- estado relacionado--}}
                        <div>
                            <x-legend>Esta zona se encuentra en el estado de:</x-legend>
                            <div class="flex items-center flex-wrap justify-start mt-2 gap-6">
                                <div class="flex items-center min-w-40 bg-zinc-100 shadow-md px-3 py-1 rounded-md gap-4 justify-between">
                                    <x-strong>{{$this->estado->nombre}}</x-strong>
                                    <x-checkbox checked disabled class="!bg-green-300 !cursor-default" />
                                </div>
                            </div>
                        </div>

                        {{-- cultura relacionada--}}
                        <div>
                            <x-legend>Esta zona perteneció a la cultura:</x-legend>
                            <div class="flex items-center flex-wrap justify-start mt-2 gap-6">
                                <div class="flex items-center min-w-40 bg-zinc-100 shadow-md px-3 py-1 rounded-md gap-4 justify-between">
                                    <x-strong>{{$this->cultura->nombre}}</x-strong>
                                    <x-checkbox checked disabled class="!bg-green-300 !cursor-default" />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- imagenes --}}
                    <x-legend>Imagenes:</x-legend>
                    <div class="flex flex-row flex-wrap w-full gap-4 justify-between">
                        @foreach ($this->zona->fotos as $foto)
                            <div wire:key="zona-foto-{{$foto->foto}}" class="rounded-md">
                                <img src="{{img_u_url($foto->foto)}}" width="200px" alt="img-cultura" class="shadow-lg rounded-md">
                            </div>
                        @endforeach
                    </div>

                </x-modal>
            @endif

            {{-- formulario modal editar y actualizar --}}
            @if ($zonaUpdate->openEdit)
                <x-modal openPropiety="zonaUpdate.openEdit">

                    {{-- nombre zona --}}
                    <h2 class="text-4xl text-center flex flex-row justify-between">
                        <x-strong class="!text-xl">Editar Registro</x-strong>
                    </h2>

                    {{-- formulario editar slot start --}}
                        <div class="grid grid-cols-auto-fit-400 gap-10 items-end">
                            {{-- nombre --}}
                            <x-fieldset>
                                <x-legend>Nombre*</x-legend>
                                <x-input class="!text-gray-500" wire:model.live="zonaUpdate.nombre" />
                                <x-error-message for="zonaUpdate.nombre" />
                            </x-fieldset>

                            {{-- costo de entrada --}}
                            <x-fieldset>
                                <x-legend>Costo de entrada*</x-legend>
                                <x-input class="!text-gray-500" wire:model.live="zonaUpdate.costoEntrada" class="!w-1/3" placeholder="$ 00.00 MXN" />
                                <x-error-message for="zonaUpdate.costoEntrada" />
                            </x-fieldset>

                            {{-- significado --}}
                            <x-fieldset>
                                <x-legend>Significado*</x-legend>
                                <x-textarea wire:model.live="zonaUpdate.significado"></x-textarea>
                                <x-error-message for="zonaUpdate.significado" />
                            </x-fieldset>

                            {{-- relevancia cultural --}}
                            <x-fieldset>
                                <x-legend>Relevancia cultural*</x-legend>
                                <x-textarea wire:model.live="zonaUpdate.relevancia"></x-textarea>
                                <x-error-message for="zonaUpdate.relevancia" />
                            </x-fieldset>

                            {{-- acceso --}}
                            <x-fieldset>
                                <x-legend>Acceso*</x-legend>
                                <x-textarea wire:model.live="zonaUpdate.acceso"></x-textarea>
                                <x-error-message for="zonaUpdate.acceso" />
                            </x-fieldset>

                            {{-- contacto --}}
                            <x-fieldset>
                                <x-legend>Información de contacto*</x-legend>
                                <x-textarea wire:model.live="zonaUpdate.contacto"></x-textarea>
                                <x-error-message for="zonaUpdate.contacto" />
                            </x-fieldset>

                            {{-- horario --}}
                            <div class="flex flex-col justify-between col-start-1 -col-end-1 gap-4">
                                <x-label>Horario*</x-label>
                                <div class="flex flex-row text-xs justify-between gap-12">
                                    {{-- de dia --}}
                                    <x-fieldset>
                                        <x-legend>De</x-legend>
                                        <x-select wire:model.live="zonaUpdate.deDia">
                                            <option value="lunes">Lunes</option>
                                            <option value="martes">Martes</option>
                                            <option value="miercoles">Miercoles</option>
                                            <option value="jueves">Jueves</option>
                                            <option value="viernes">Viernes</option>
                                            <option value="sabado">Sabado</option>
                                            <option value="domingo">Domingo</option>
                                        </x-select>
                                        <x-error-message for="zonaUpdate.deDia" />
                                    </x-fieldset>
                                    {{-- a dia --}}
                                    <x-fieldset>
                                        <x-legend>a</x-legend>
                                        <x-select wire:model.live="zonaUpdate.aDia">
                                            <option value="domingo">Domingo</option>
                                            <option value="lunes">Lunes</option>
                                            <option value="martes">Martes</option>
                                            <option value="miercoles">Miercoles</option>
                                            <option value="jueves">Jueves</option>
                                            <option value="viernes">Viernes</option>
                                            <option value="sabado">Sabado</option>
                                        </x-select>
                                        <x-error-message for="zonaUpdate.aDia" />
                                    </x-fieldset>

                                    {{-- de hora --}}
                                    <x-fieldset>
                                        <x-legend>De las</x-legend>
                                        <x-input type="time" wire:model.live="zonaUpdate.deHora" />
                                        <x-error-message for="zonaUpdate.deHora" />
                                    </x-fieldset>
                                    {{-- a hora --}}
                                    <x-fieldset>
                                        <x-legend>a las</x-legend>
                                        <x-input type="time" wire:model.live="zonaUpdate.aHora" />
                                        <x-error-message for="zonaUpdate.aHora" />
                                    </x-fieldset>
                                </div>
                            </div>

                            {{-- relacion con estados --}}
                            <x-fieldset>
                                <x-legend class="!normal-case">¿En qué estado de la República Mexicana se encuentra esta Zona Arqueológica?*</x-legend>
                                <x-select wire:model.live="zonaUpdate.estadoRelacionado">
                                    <option value="" disabled>Selecciona un Estado</option>
                                    @foreach ($estados as $estado)
                                        <option
                                            value="{{$estado->idEstadoRepublica}}"
                                            {{$zonaUpdate->estadoRelacionado == $estado->idEstadoRepublica ? 'selected' : ''}}
                                        >
                                            {{$estado->nombre}}
                                        </option>
                                    @endforeach
                                </x-select>
                                <x-error-message for="zonaUpdate.estado" />
                            </x-fieldset>

                            {{-- relacion con culturas --}}
                            <x-fieldset>
                                <x-legend class="normal-case">¿A qué cultura de Mexico pertenece esta Zona Arqueológica?*</x-legend>
                                <x-select wire:model.live="zonaUpdate.culturaRelacionada">
                                    <option value="" disabled>Selecciona una Cultura</option>
                                    @foreach ($culturas as $cultura)
                                        <option
                                            value="{{$cultura->idCultura}}"
                                            {{$zonaUpdate->culturaRelacionada == $cultura->idCultura ? 'selected' : ''}}
                                        >
                                            {{$cultura->nombre}}
                                        </option>
                                    @endforeach
                                </x-select>
                                <x-error-message for="zonaUpdate.cultura" />
                            </x-fieldset>

                            {{-- condicion o status --}}
                            <x-fieldset>
                                <x-legend>Condición*</x-legend>
                                <x-select wire:model.live="zonaUpdate.condicion">
                                    <option
                                        value="Abierta"
                                    >
                                        Abierta
                                    </option>
                                    <option
                                        value="No abierta"
                                    >
                                        No abierta
                                    </option>
                                </x-select>
                                <x-error-message for="zonaUpdate.condicion" />
                            </x-fieldset>

                            {{-- direccion --}}
                            <x-fieldset>
                                <x-legend>Dirección*</x-legend>
                                <x-input wire:model.live="zonaUpdate.direccion" id="address" placeholder="Busca una dirección" />
                                <x-error-message for="zonaUpdate.direccion" />
                            </x-fieldset>
                        </div>

                        {{-- fotos actuales --}}
                        <x-fieldset class="mb-4 text-center">
                            <x-legend>Imagenes actuales</x-legend>
                            <div class="grid grid-cols-auto-fill-250 text-start mt-6 justify-between content-between gap-x-10 gap-y-14">
                                @foreach ($this->zona->fotos as $foto)
                                    <div wire:key="Zonas-Foto-{{$foto->idZonaFoto}}" class="flex flex-col gap-3 justify-between p-6 relative overflow-hidden text-ellipsis rounded-md break-all text-nowrap bg-slate-100 items-start w-full" wire:key="{{$foto->idCulturaFoto}}">
                                        {{-- imagen actual --}}
                                        <div class="w-full flex justify-center">
                                            <img src="{{img_u_url($foto->foto)}}" class="bg-white shadow-md rounded-md" width="200px" alt="img-cultura">
                                        </div>

                                        {{-- actualizar y / o borrar imagen actual --}}
                                        <div class="flex flex-col justify-between gap-3 !text-xs text-gray-400 items-start align-items-start">
                                            {{-- eliminar imagen --}}
                                            <div class="flex absolute top-2 right-3 flex-row gap-5 items-center justify-center">
                                                <div class="relative flex justify-center items-center">
                                                    <x-checkbox
                                                        wire:model="zonaUpdate.to_eliminate_imgs.{{$foto->idZonaFoto}}"
                                                        name="to_eliminate_imgs.{{$foto->idZonaFoto}}"
                                                        onchange="disabled_input('{{$foto->idZonaFoto}}')"
                                                        class="peer bg-white"
                                                    />
                                                    <span class="absolute text-center peer-checked:bg-slate-300 peer-checked:rounded-md pointer-events-none p-1 top-0 right-0 left-0 bottom-0">
                                                        <svg width="100%" fill="#e82721" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304L80 128zm80 64l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
                                                    </span>
                                                </div>
                                                {{-- <x-label><x-strong>Eliminar imagen</x-strong></x-label> --}}
                                                <x-error-message for="zonaUpdate.to_eliminate_imgs.{{$foto->idZonaFoto}}" />
                                            </div>
                                            {{-- actualizar imagen --}}
                                            <div class="flex text-start gap-2 flex-col">
                                                <x-label>Actualizar imagen</x-label>
                                                <input
                                                    type="file"
                                                    wire:model="zonaUpdate.imgs_update.{{$foto->idZonaFoto}}"
                                                    wire:key="{{$zonaUpdate->fotoKey}}"
                                                    name="imgs_update.{{$foto->idZonaFoto}}"
                                                    accept="image/*"
                                                    class="text-xs bg-white rounded-sm"
                                                >
                                                <x-error-message for="zonaUpdate.imgs_update.{{$foto->idZonaFoto}}" />
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </x-fieldset>

                        {{-- agregar fotos --}}
                        <x-fieldset>
                            <x-legend>Fotos* <small class="text-xs font-bold"> Min 2. Max. 4</small></x-legend>
                            <input type="file" wire:model.live="zonaUpdate.imagenes" wire:key="{{$fotoKey}}" accept="image/*" multiple>
                            <x-error-message for="zonaUpdate.imagenes" />
                        </x-fieldset>
                    {{-- formulario editar slot end --}}

                </x-modal>
            @endif

        </div>

    </div>

</div>
