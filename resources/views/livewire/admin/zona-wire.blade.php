

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
                                <div class="flex flex-col justify-between gap-4">
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

                                {{-- direccion --}}
                                <x-fieldset>
                                    <x-legend>Dirección*</x-legend>
                                    <x-input wire:model.live="zonaCreate.direccion" id="address" placeholder="Busca una dirección" />
                                    <x-error-message for="zonaCreate.direccion" />
                                </x-fieldset>

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
                {{-- CRUD ZONAS --}}
                <div class="flex flex-col w-full h-full justify-between rounded-xl">
                    {{-- titulo, buscador y filtro --}}
                    <div class="flex my-8 items-center justify-around">
                        <h1 class="text-4xl text-gray-900 tracking-wider uppercase">
                            zonas
                        </h1>

                        {{-- filtro no.registros --}}
                        <div class="">
                            <h2>FILTRO</h2>
                        </div>

                        {{-- BUSCADOR --}}
                        <div class="searcher-container flex flex-row">
                            <form action="" method="post" autocomplete="off">
                                {{-- <fieldset> --}}
                                    {{-- <legend> --}}
                                        {{-- </legend> --}}
                                <input type="text" placeholder="¿Qúe buscabas?">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                                </button>
                                {{-- </fieldset> --}}
                            </form>
                        </div>
                    </div>

                    {{-- lista, grid de zonas --}}
                    <div class="flex flex-col mb-5 justify-between">
                        {{-- thead --}}
                        <div class="flex flex-row justify-between pl-8 items-center w-1/2 text-center">
                            <x-strong class="focus:shadow-md border-gray-200 shadow-sm border text-gray-400 mb-4 italic">ID</x-strong>
                            <x-strong class="focus:shadow-md border-gray-200 shadow-sm border text-gray-400 mb-4 italic">Nombre de la zona</x-strong>
                        </div>

                        {{-- tbody --}}
                        <div class="flex flex-col gap-6">
                            @foreach ($zonas as $zona)
                                {{-- registro --}}
                                <div wire:key="zona-{{$zona->idzona}}" class="grid-registro shadow-md p-4 rounded-lg bg-slate-50">
                                    {{-- BLOQUE con datos id y nombre --}}
                                    <ul class="flex flex-row justify-between px-8 items-center">
                                        <li class="italic tracking-widest">{{$zona->idZonaArqueologica}}</li>
                                        <li class="italic tracking-widest">{{$zona->nombre}}</li>
                                    </ul>

                                    {{-- BLOQUE botones acciones --}}
                                    <div class="flex gap-3 flex-row justify-end">
                                        {{-- ver mas --}}
                                        <x-button tipo="show" class="btn-btn" wire:click="show({{$zona->idzona}})">
                                            Ver más
                                        </x-button>

                                        {{-- editar --}}
                                        <x-button tipo="edit" wire:click="edit({{$zona}})">
                                            Editar
                                        </x-button>

                                        {{-- eliminar --}}
                                        <x-button tipo="destroy" wire:click="confirmDestroy({{$zona->idzona}})">
                                            Eliminar
                                        </x-button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- paginador --}}
                    <div class="paginador w-full">
                        {{$zonas->links()}}
                    </div>
                </div>
            @endif

            {{-- modal ver más detalles --}}
            @if ($openShow)
                <div class="modal-container modal-show-container">
                    <div class="modal ">
                        <div class="flex flex-col overflow-y-auto gap-4 justify-center">
                            <div class="form-edit-container flex flex-col gap-4">
                                {{-- boton cerrar --}}
                                <div class="flex flex-row justify-end">
                                    <x-button tipo="x" wire:click="$set('openShow', false)"></x-button>
                                </div>
                                {{-- fecha de registro --}}
                                <div class="w-full flex flex-row justify-between items-center">
                                    <x-strong>Detalles de la zona</x-strong>
                                    {{-- created_at --}}
                                    <div class="text-end">
                                        <x-strong>Fecha de regstro: </x-strong>
                                        <span>{{$this->zona->created_at}}</span>
                                    </div>
                                </div>
                                {{-- datos del registro --}}
                                <div class="show-grid">
                                    {{-- nombre --}}
                                    <div class="nombre-zona">
                                        <x-legend>Nombre: </x-legend>
                                        <h3 class="tracking-wider">{{$this->zona->nombre}}</h3>
                                    </div>
                                    {{-- periodo --}}
                                    <div>
                                        <x-legend>Periodo: </x-legend>
                                        <x-textarea readonly disabled>
                                            {{$this->zona->periodo}}
                                        </x-textarea>
                                    </div>
                                    {{-- significado --}}
                                    <div>
                                        <x-legend>significado: </x-legend>
                                        <x-textarea readonly disabled>
                                            {{$this->zona->significado}}
                                        </x-textarea>
                                    </div>
                                    {{-- aportaciones --}}
                                    <div>
                                        <x-legend>aportaciones: </x-legend>
                                        <x-textarea readonly disabled>
                                            {{$this->zona->aportaciones}}
                                        </x-textarea>
                                    </div>
                                    {{-- relevancia cultural --}}
                                    <div>
                                        <x-legend>relevancia cultural: </x-legend>
                                        <x-textarea readonly disabled>
                                            {{$this->zona->relevancia}}
                                        </x-textarea>
                                    </div>
                                </div>

                                <x-strong>Imagenes:</x-strong>
                                {{-- imagenes --}}
                                <div class="flex flex-row flex-wrap w-full justify-between mb-5">
                                    @foreach ($this->zona->fotos as $foto)
                                        <div wire:key="zona-foto-{{$foto->foto}}" class="rounded-md">
                                            <img src="{{img_u_url($foto->foto)}}" width="250px"  alt="img-zona" class="shadow-lg border border-slate-950 rounded-md">
                                        </div>
                                    @endforeach
                                </div>

                                {{-- fecha de actualizacion y boton cerrar --}}
                                <div class="flex flex-row justify-between items-center">
                                    {{-- updated_at --}}
                                    <div>
                                        <x-strong>Ultima actualización: </x-strong>
                                        <span>{{$this->zona->updated_at}}</span>
                                    </div>
                                    <x-button tipo="close" wire:click="$set('openShow', false)">
                                        Cerrar
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- formulario modal editar y actualizar --}}
            @if ($zonaUpdate->openEdit)
                <div class="modal-container modal-edit-container">
                    <div class="modal">
                        <div class="form-edit-container flex flex-col gap-4">
                            {{-- nombre zona y boton de cierre --}}
                            <h2 class="text-4xl text-center flex flex-row justify-between">
                                <x-strong>Editar Registro</x-strong>
                                <x-button tipo="x" wire:click="$set('zonaUpdate.openEdit', false)"></x-button>
                            </h2>
                            {{-- formulario editar --}}
                            <form wire:submit="update" enctype="multipart/form-data" class="py-3 flex flex-col gap-6 text-sm">
                                @csrf
                                {{-- nombre --}}
                                <x-fieldset>
                                    <x-legend>Nombre</x-legend>
                                    <x-input wire:model.live="zonaUpdate.nombre" value="{{old('nombre')}}" />
                                    <x-error-message for="zonaUpdate.nombre" />
                                </x-fieldset>

                                {{-- periodo --}}
                                <x-fieldset>
                                    <x-legend>Periodo</x-legend>
                                    <x-textarea wire:model.live="zonaUpdate.periodo">{{old('periodo')}}</x-textarea>
                                    <x-error-message for="zonaUpdate.periodo" />
                                </x-fieldset>

                                {{-- significado --}}
                                <x-fieldset>
                                    <x-legend>Significado</x-legend>
                                    <x-textarea wire:model.live="zonaUpdate.significado">{{old('significado')}}</x-textarea>
                                    <x-error-message for="zonaUpdate.significado" />
                                </x-fieldset>

                                {{-- descripcion y aportaciones --}}
                                <div class="flex flex-row w-full justify-between gap-6">
                                    {{-- descripcion --}}
                                    <x-fieldset>
                                        <x-legend>Descripcion</x-legend>
                                        <x-textarea wire:model.live="zonaUpdate.descripcion">{{old('descripcion')}}</x-textarea>
                                        <x-error-message for="zonaUpdate.descripcion" />
                                    </x-fieldset>

                                    {{-- aportaciones --}}
                                    <x-fieldset>
                                        <x-legend>Aportaciones</x-legend>
                                        <x-textarea wire:model.live="zonaUpdate.aportaciones">{{old('aportaciones')}}</x-textarea>
                                        <x-error-message for="zonaUpdate.aportaciones" />
                                    </x-fieldset>
                                </div>

                                {{-- fotos --}}
                                <x-fieldset>
                                    <x-legend>Imagenes actuales</x-legend>
                                    @foreach ($this->zona->fotos as $foto)
                                        <div class="my-5 w-full" wire:key="{{$foto->idzonaFoto}}">
                                            {{-- actualizar y / o borrar imagen actual --}}
                                            <div class="flex flex-row justify-between items-center">
                                                {{-- actualizar imagen --}}
                                                <div class="flex flex-col">
                                                    <x-label><x-strong>Subir nueva imagen</x-strong></x-label>
                                                    <input
                                                        type="file"
                                                        wire:model="zonaUpdate.imgs_update.{{$foto->idzonaFoto}}"
                                                        wire:key="{{$zonaUpdate->fotoKey}}"
                                                        name="imgs_update.{{$foto->idzonaFoto}}"
                                                        accept="image/*"
                                                    >
                                                    <x-error-message for="zonaUpdate.imgs_update.{{$foto->idzonaFoto}}" />
                                                </div>
                                                {{-- eliminar imagen --}}
                                                <div class="flex flex-row gap-5 items-center justify-center">
                                                    <x-label><x-strong>Eliminar imagen</x-strong></x-label>
                                                    <x-checkbox
                                                        wire:model="zonaUpdate.to_eliminate_imgs.{{$foto->idzonaFoto}}"
                                                        name="to_eliminate_imgs.{{$foto->idzonaFoto}}"
                                                        onchange="disabled_input('{{$foto->idzonaFoto}}')"
                                                    />
                                                    <x-error-message for="zonaUpdate.to_eliminate_imgs.{{$foto->idzonaFoto}}" />
                                                </div>
                                            </div>

                                            {{-- imagen actual --}}
                                            <div class="mt-2">
                                                <img src="{{img_u_url($foto->foto)}}" class="shadow-md rounded-md" width="150px" alt="img-zona">
                                            </div>
                                        </div>
                                    @endforeach
                                </x-fieldset>

                                {{-- agregar fotos --}}
                                @if ($zonaUpdate->imgs_count < 4)
                                    <x-fieldset>
                                        <x-legend><x-strong>Agregar imagenes</x-strong></x-legend>
                                        <input type="file" wire:model="zonaUpdate.imgs_nuevas" wire:key="{{$zonaUpdate->fotoKey}}" accept="image/*" multiple max="4">
                                        <x-error-message for="zonaUpdate.imgs_nuevas" />
                                    </x-fieldset>
                                @endif

                                {{-- botones de actualizar y cancelar --}}
                                <div class="flex flex-row justify-end gap-4">
                                    {{-- actualizar --}}
                                    <x-button type="submit" tipo="update">
                                        Actualizar
                                    </x-button>

                                    {{-- cancelar --}}
                                    <x-button tipo="cancel" wire:click="$set('zonaUpdate.openEdit', false)">
                                        Cancelar
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>

</div>
