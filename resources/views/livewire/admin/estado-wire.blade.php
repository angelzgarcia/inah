

{{-- VISTA DEL COMPONENTE estados --}}
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
                            </div>

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

            {{-- lista de registros --}}
            <div class="flex flex-col w-full h-full justify-between rounded-xl">
                {{-- titulo, buscador y filtro --}}
                <div class="flex my-8 items-center justify-around">
                    <h1 class="text-4xl text-gray-900 tracking-wider uppercase">
                        estados
                    </h1>

                    {{-- filtro no.registros --}}
                    <div class="">
                        <h2>FILTRO</h2>
                    </div>

                    {{-- BUSCADOR --}}
                    <div class="searcher-container flex flex-row">
                        <form action="" method="post" autocomplete="off">
                            <input type="text" placeholder="¿Qúe buscabas?">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- lista, grid de estados --}}
                <div class="flex flex-col mb-5 justify-between">
                    {{-- thead --}}
                    <div class="flex flex-row justify-between pl-8 items-center w-1/2 text-center">
                        <x-strong class="focus:shadow-md border-gray-200 shadow-sm border text-gray-400 mb-4 italic">ID</x-strong>
                        <x-strong class="focus:shadow-md border-gray-200 shadow-sm border text-gray-400 mb-4 italic">Nombre del estado</x-strong>
                    </div>

                    {{-- tbody --}}
                    <div class="flex flex-col gap-6">
                        @foreach ($estados as $estado)
                            {{-- registro --}}
                            <div wire:key="estado-{{$estado->idEstadoRepublica}}" class="grid-registro shadow-md p-4 rounded-lg bg-slate-50">
                                {{-- BLOQUE con datos id y nombre --}}
                                <ul class="flex flex-row justify-between px-8 items-center">
                                    <li class="italic tracking-widest">{{$estado->idEstadoRepublica}}</li>
                                    <li class="italic tracking-widest">{{$estado->nombre}}</li>
                                </ul>

                                {{-- BLOQUE botones acciones --}}
                                <div class="flex gap-3 flex-row justify-end">
                                    {{-- ver mas --}}
                                    <x-button tipo="show" class="btn-btn" wire:click="show({{$estado->idEstadoRepublica}})">
                                        Ver más
                                    </x-button>

                                    {{-- editar --}}
                                    <x-button tipo="edit" wire:click="edit({{$estado}})">
                                        Editar
                                    </x-button>

                                    {{-- eliminar --}}
                                    <x-button tipo="destroy" wire:click="confirmDestroy({{$estado->idEstadoRepublica}})">
                                        Eliminar
                                    </x-button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- paginador --}}
                <div class="paginador w-full">
                    {{$estados->links()}}
                </div>
            </div>

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
                                    <x-strong>Detalles del estado</x-strong>
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
                                        <h3>{{$this->estado->nombre}}</h3>
                                    </div>

                                    {{-- capital --}}
                                    <div>
                                        <x-legend>Capital: </x-legend>
                                        <h3>{{$this->estado->capital}}</h3>
                                    </div>

                                    {{-- video --}}
                                    <div>
                                        <x-legend>Video</x-legend>
                                        <small class="text-xs">{{$this->estado->video}}</small>
                                        <iframe width="100%" height="240"
                                            src="{{ $this->estado->video }}"
                                            frameborder="0"
                                            allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen
                                            class="rounded-md">
                                        >
                                            <p>No se puede mostrar el video. URL no válida.</p>
                                        </iframe>
                                    </div>

                                    {{-- imagen --}}
                                    <div>
                                        <x-legend>Portada</x-legend>
                                        <img src="{{img_u_url($this->estado->foto)}}" class="rounded-md" alt="{{$this->estado->foto}}">
                                    </div>

                                    {{-- triptico --}}
                                    <div>
                                        <x-legend>Tríptico informativo</x-legend>
                                        <iframe src="{{ triptico_url($this->estado->triptico) }}" width="100%" height="500px" class="rounded-md"></iframe>
                                    </div>

                                    {{-- guia --}}
                                    <div>
                                        <x-legend>Guía informativa</x-legend>
                                        <iframe src="{{ guia_url($this->estado->guia) }}" width="100%" height="500px" class="rounded-md"></iframe>
                                    </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- formulario modal editar y actualizar --}}
            @if ($estadoUpdate->openEdit)
                <div class="modal-container modal-edit-container">
                    <div class="modal">
                        <div class="form-edit-container flex flex-col gap-4">
                            {{-- nombre estado y boton de cierre --}}
                            <h2 class="text-4xl text-center flex flex-row justify-between">
                                <x-strong>Editar Registro</x-strong>
                                <x-button tipo="x" wire:click="$set('estadoUpdate.openEdit', false)"></x-button>
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
                                            <x-input wire:model.defer="estadoUpdate.nombre" />
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
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>

</div>
