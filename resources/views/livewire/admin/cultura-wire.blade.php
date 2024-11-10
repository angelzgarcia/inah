

<div class="w-full h-full">

    <div class="w-full h-full items-center justify-around py-5 flex flex-col gap-8">

        {{-- botones volver y mostrar create form --}}
        <div class="w-11/12 px-5 flex justify-between">
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
            <div class="w-11/12 flex flex-col justify-between gap-8 shadow-md p-5 rounded-xl">
                {{-- titulo --}}
                <h1 class="text-3xl">
                    <strong>Agrear Cultura</strong>
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

        {{-- lista de culturas --}}
        <div class="flex flex-col w-11/12 shadow-md p-5 rounded-xl">
            {{-- titulo y buscador --}}
            <div class="flex flex-row items-center justify-between">
                <h1 class="mb-5 text-4xl">
                    <strong>Culturas</strong>
                </h1>
                {{-- BUSCADOR --}}
                <span>buscador</span>
            </div>

            <strong class="text-gray-400 mb-4">Nombre de la cultura</strong>
            {{-- listado --}}
            @foreach ($culturas as $cultura)
                <div wire:key="cultura-{{$cultura->idCultura}}" class="mb-6 flex justify-between">
                    <ul>
                        <li class="list-disc list-inside italic tracking-widest">{{$cultura->nombre}}</li>
                    </ul>

                    {{-- acciones --}}
                    <div class="flex gap-2">
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

            {{-- paginador --}}
            <div class="paginador">
                {{$culturas->links()}}
            </div>
        </div>

        {{-- modal ver más detalles --}}
        @if ($openShow)
            <div class="modal-container modal-show-container">
                <div class="modal">
                    <div class="show">
                        {{$this->cultura->nombre}}
                        @foreach ($this->cultura->fotos as $foto)
                            <div wire:key="cultura-foto-{{$foto->foto}}">
                                <img src="{{img_u_url($foto->foto)}}" width="150px" alt="img-cultura">
                            </div>
                        @endforeach
                    </div>
                    <x-button tipo="close" wire:click="$set('openShow', false)">
                        Cerrar
                    </x-button>
                </div>
            </div>
        @endif

        {{-- formulario modal editar y actualizar --}}
        @if ($culturaUpdate->openEdit)
            <x-sweet-alert :sweet="$culturaUpdate->sweet" />
            <div class="modal-container modal-edit-container">
                <div class="modal">
                    <div class="form-edit-container flex flex-col gap-4">
                        {{-- nombre cultura y boton de cierre --}}
                        <h2 class="text-4xl text-center flex flex-row justify-between">
                            <strong> Cultura {{$culturaUpdate->nombre}}</strong>
                            <x-button tipo="x" wire:click="$set('culturaUpdate.openEdit', false)"></x-button>
                        </h2>
                        {{-- formulario editar --}}
                        <form wire:submit="update" enctype="multipart/form-data" class="py-3 flex flex-col gap-6 text-sm">
                            @csrf
                            {{-- nombre --}}
                            <x-fieldset>
                                <x-legend>Nombre*</x-legend>
                                <x-input wire:model="culturaUpdate.nombre" value="{{old('nombre')}}" />
                                <x-error-message for="culturaUpdate.nombre" />
                            </x-fieldset>

                            {{-- periodo --}}
                            <x-fieldset>
                                <x-legend>Periodo*</x-legend>
                                <x-textarea wire:model="culturaUpdate.periodo">{{old('periodo')}}</x-textarea>
                                <x-error-message for="culturaUpdate.periodo" />
                            </x-fieldset>

                            {{-- significado --}}
                            <x-fieldset>
                                <x-legend>Significado*</x-legend>
                                <x-textarea wire:model="culturaUpdate.significado">{{old('significado')}}</x-textarea>
                                <x-error-message for="culturaUpdate.significado" />
                            </x-fieldset>

                            {{-- descripcion y aportaciones --}}
                            <div class="flex flex-row w-full justify-between gap-6">
                                {{-- descripcion --}}
                                <x-fieldset>
                                    <x-legend>Descripcion*</x-legend>
                                    <x-textarea wire:model="culturaUpdate.descripcion">{{old('descripcion')}}</x-textarea>
                                    <x-error-message for="culturaUpdate.descripcion" />
                                </x-fieldset>

                                {{-- aportaciones --}}
                                <x-fieldset>
                                    <x-legend>Aportaciones*</x-legend>
                                    <x-textarea wire:model="culturaUpdate.aportaciones">{{old('aportaciones')}}</x-textarea>
                                    <x-error-message for="culturaUpdate.aportaciones" />
                                </x-fieldset>
                            </div>

                            {{-- fotos --}}
                            <x-fieldset>
                                <x-legend>Imagenes actuales</x-legend>
                                @foreach ($this->cultura->fotos as $foto)
                                    <div class="my-5 w-full">
                                        {{-- actualizar y / o borrar imagen actual --}}
                                        <div class="flex flex-row justify-between items-center">
                                            {{-- actualizar imagen --}}
                                            <div class="flex flex-col">
                                                <x-label><strong>Subir nueva imagen</strong></x-label>
                                                <input
                                                    type="file"
                                                    wire:model="culturaUpdate.imgs_update.{{$foto->idCulturaFoto}}"
                                                    name="imgs_update.{{$foto->idCulturaFoto}}"
                                                    accept="image/*"
                                                >
                                                <x-error-message for="culturaUpdate.imgs_update.{{$foto->idCulturaFoto}}" />
                                            </div>
                                            {{-- eliminar imagen --}}
                                            <div class="flex flex-row gap-5 items-center justify-center">
                                                <x-label><strong>Eliminar imagen</strong></x-label>
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
                                    <x-legend><strong>Agregar imagenes</strong></x-legend>
                                    <input type="file" wire:model="culturaUpdate.imgs_nuevas" wire:key="{{$fotoKey}}" accept="image/*" multiple max="4">
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
