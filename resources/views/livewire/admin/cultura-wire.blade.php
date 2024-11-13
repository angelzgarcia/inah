

<div class="w-full h-full">

    <div class="py-5">

        <div class="w-full h-fullitems-center justify-center flex flex-col gap-14 px-7">

            {{-- botones volver y mostrar create form --}}
            <div class="w-full flex justify-between">
                {{-- volver --}}
                <x-button tipo="back">
                    <a href="{{route('database.index')}}"> Volver </a>
                </x-button>

                {{-- crear --}}
                @if (!$culturaCreate->openCreate)
                    <x-button tipo="aggregate" wire:click="$set('culturaCreate.openCreate', true)">
                        Agregar Cultura
                    </x-button>
                @else
                    {{-- cancelar --}}
                    <x-button tipo="cancel" wire:click="$set('culturaCreate.openCreate', false)">
                        Cancelar
                    </x-button>
                @endif
            </div>

            {{-- formularo crear cultura --}}
            @if ($culturaCreate->openCreate)
                <div class="sbw-thin w-full flex flex-col justify-between gap-8 rounded-xl">
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
                            <x-input wire:model="culturaCreate.nombre" value="{{old('nombre')}}" />
                            <x-error-message for="culturaCreate.nombre" />
                        </x-fieldset>

                        {{-- periodo y significado --}}
                        <div class="flex flex-row justify-between gap-12">
                            {{-- periodo --}}
                            <x-fieldset>
                                <x-legend>Periodo*</x-legend>
                                <x-textarea wire:model="culturaCreate.periodo">{{old('periodo')}}</x-textarea>
                                <x-error-message for="culturaCreate.periodo" />
                            </x-fieldset>

                            {{-- significado --}}
                            <x-fieldset>
                                <x-legend>Significado*</x-legend>
                                <x-textarea wire:model="culturaCreate.significado">{{old('significado')}}</x-textarea>
                                <x-error-message for="culturaCreate.significado" />
                            </x-fieldset>
                        </div>

                        {{-- descripcion --}}
                        <x-fieldset>
                            <x-legend>Descripcion*</x-legend>
                            <x-textarea wire:model="culturaCreate.descripcion">{{old('descripcion')}}</x-textarea>
                            <x-error-message for="culturaCreate.descripcion" />
                        </x-fieldset>

                        {{-- aportaciones --}}
                        <x-fieldset>
                            <x-legend>Aportaciones*</x-legend>
                            <x-textarea wire:model="culturaCreate.aportaciones">{{old('aportaciones')}}</x-textarea>
                            <x-error-message for="culturaCreate.aportaciones" />
                        </x-fieldset>

                        {{-- fotos --}}
                        <x-fieldset>
                            <x-legend>Fotos*</x-legend>
                            <input type="file" wire:model="culturaCreate.imagenes" wire:key="{{$fotoKey}}" accept="image/*" multiple max="4">
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
                </div>
            @endif

            {{-- lista de registros --}}
            <div class="flex flex-col w-full h-full justify-between rounded-xl">
                {{-- titulo, buscador y filtro --}}
                <div class="flex flex-row items-center justify-around">
                    <h1 class="mb-5 text-4xl text-gray-900 tracking-wider">
                        Culturas
                    </h1>

                    {{-- filtro no.registros --}}
                    <div>
                        FILTRO
                    </div>
                    {{-- BUSCADOR --}}
                    <div>
                        BUSCADOR
                    </div>
                </div>

                {{-- lista, grid de culturas --}}
                <div class="flex flex-col mb-5 justify-between">
                    {{-- thead --}}
                    <div class="flex flex-row justify-between pl-8 items-center w-1/2 text-center">
                        <x-strong class="focus:shadow-md border-gray-200 shadow-sm border text-gray-400 mb-4 italic">ID</x-strong>
                        <x-strong class="focus:shadow-md border-gray-200 shadow-sm border text-gray-400 mb-4 italic">Nombre de la cultura</x-strong>
                    </div>

                    {{-- tbody --}}
                    <div class="flex flex-col gap-6">
                        @foreach ($culturas as $cultura)
                            {{-- registro --}}
                            <div wire:key="cultura-{{$cultura->idCultura}}" class="grid-registro shadow-md p-4 rounded-lg bg-slate-50">
                                {{-- BLOQUE con datos id y nombre --}}
                                <ul class="flex flex-row justify-between px-8 items-center">
                                    <li class="italic tracking-widest">{{$cultura->idCultura}}</li>
                                    <li class="italic tracking-widest">{{$cultura->nombre}}</li>
                                </ul>

                                {{-- BLOQUE botones acciones --}}
                                <div class="flex gap-3 flex-row justify-end">
                                    {{-- ver mas --}}
                                    <x-button tipo="show" class="btn-btn" wire:click="show({{$cultura->idCultura}})">
                                        Ver más
                                    </x-button>

                                    {{-- editar --}}
                                    <x-button tipo="edit" wire:click="edit({{$cultura}})">
                                        Editar
                                    </x-button>

                                    {{-- eliminar --}}
                                    <x-button tipo="destroy" wire:click="destroy({{$cultura}})">
                                        Eliminar
                                    </x-button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- paginador --}}
                <div class="paginador w-full">
                    {{$culturas->links()}}
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
                                    <x-strong>Detalles de la cultura</x-strong>
                                    {{-- created_at --}}
                                    <div class="text-end">
                                        <x-strong>Fecha de regstro: </x-strong>
                                        <span>{{$this->cultura->created_at}}</span>
                                    </div>
                                </div>
                                {{-- datos del registro --}}
                                <div class="show-grid">
                                    {{-- nombre --}}
                                    <div class="nombre-cultura">
                                        <x-legend>Nombre: </x-legend>
                                        <h3>{{$this->cultura->nombre}}</h3>
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

                                <x-strong>Imagenes:</x-strong>
                                {{-- imagenes --}}
                                <div class="flex flex-row flex-wrap w-full justify-between mb-5">
                                    @foreach ($this->cultura->fotos as $foto)
                                        <div wire:key="cultura-foto-{{$foto->foto}}" class="rounded-md">
                                            <img src="{{img_u_url($foto->foto)}}" width="250px"  alt="img-cultura" class="shadow-lg border border-slate-950 rounded-md">
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
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- formulario modal editar y actualizar --}}
            @if ($culturaUpdate->openEdit)
                <div class="modal-container modal-edit-container">
                    <div class="modal">
                        <div class="form-edit-container flex flex-col gap-4">
                            {{-- nombre cultura y boton de cierre --}}
                            <h2 class="text-4xl text-center flex flex-row justify-between">
                                <x-strong>Editar Registro</x-strong>
                                <x-button tipo="x" wire:click="$set('culturaUpdate.openEdit', false)"></x-button>
                            </h2>
                            {{-- formulario editar --}}
                            <form wire:submit="update" enctype="multipart/form-data" class="py-3 flex flex-col gap-6 text-sm">
                                @csrf
                                {{-- nombre --}}
                                <x-fieldset>
                                    <x-legend>Nombre</x-legend>
                                    <x-input wire:model="culturaUpdate.nombre" value="{{old('nombre')}}" />
                                    <x-error-message for="culturaUpdate.nombre" />
                                </x-fieldset>

                                {{-- periodo --}}
                                <x-fieldset>
                                    <x-legend>Periodo</x-legend>
                                    <x-textarea wire:model="culturaUpdate.periodo">{{old('periodo')}}</x-textarea>
                                    <x-error-message for="culturaUpdate.periodo" />
                                </x-fieldset>

                                {{-- significado --}}
                                <x-fieldset>
                                    <x-legend>Significado</x-legend>
                                    <x-textarea wire:model="culturaUpdate.significado">{{old('significado')}}</x-textarea>
                                    <x-error-message for="culturaUpdate.significado" />
                                </x-fieldset>

                                {{-- descripcion y aportaciones --}}
                                <div class="flex flex-row w-full justify-between gap-6">
                                    {{-- descripcion --}}
                                    <x-fieldset>
                                        <x-legend>Descripcion</x-legend>
                                        <x-textarea wire:model="culturaUpdate.descripcion">{{old('descripcion')}}</x-textarea>
                                        <x-error-message for="culturaUpdate.descripcion" />
                                    </x-fieldset>

                                    {{-- aportaciones --}}
                                    <x-fieldset>
                                        <x-legend>Aportaciones</x-legend>
                                        <x-textarea wire:model="culturaUpdate.aportaciones">{{old('aportaciones')}}</x-textarea>
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
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>

</div>
