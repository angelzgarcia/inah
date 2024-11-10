
<div>

    {{-- volver --}}
    <x-button>
        <a href="{{route('database.index')}}">Volver</a>
    </x-button>

    {{-- crear --}}
    <x-button tipo="aggregate" wire:click="$set('openCreate', true)">
        Agregar Cultura
    </x-button>

    {{-- formularo crear cultura --}}
    @if ($openCreate)
        <h1>AGREGAR CULTURAS</h1>

        <form wire:submit="save" enctype="multipart/form-data">
            @csrf

            {{-- nombre --}}
            <x-fieldset>
                <x-legend>Nombre</x-legend>
                <x-input wire:model="nombre" value="{{old('nombre')}}" />
                @error('nombre')
                    {{$message}}
                @enderror
            </x-fieldset>

            {{-- periodo --}}
            <x-fieldset>
                <x-legend>Periodo</x-legend>
                <x-textarea wire:model="periodo">{{old('periodo')}}</x-textarea>
                @error('periodo')
                    {{$message}}
                @enderror
            </x-fieldset>

            {{-- significado --}}
            <x-fieldset>
                <x-legend>Significado</x-legend>
                <x-textarea wire:model="significado">{{old('significado')}}</x-textarea>
                @error('significado')
                    {{$message}}
                @enderror
            </x-fieldset>

            {{-- descripcion --}}
            <x-fieldset>
                <x-legend>Descripcion</x-legend>
                <x-textarea wire:model="descripcion">{{old('descripcion')}}</x-textarea>
                @error ('descripcion')
                    <div class="error">{{$message}}</div>
                @enderror
            </x-fieldset>

            {{-- aportaciones --}}
            <x-fieldset>
                <x-legend>Aportaciones</x-legend>
                <x-textarea wire:model="aportaciones">{{old('aportaciones')}}</x-textarea>
                @error ('aportaciones')
                    <div class="error">{{$message}}</div>
                @enderror
            </x-fieldset>

            {{-- fotos --}}
            <x-fieldset>
                <x-legend>Foto</x-legend>
                <input type="file" wire:model="fotos" wire:key="{{$fotoKey}}" accept="image/*" multiple max="4">
                @error('fotos')
                    <div>{{$message}}</div>
                @enderror
            </x-fieldset>

            {{-- agregar --}}
            <x-button type="submit" tipo="create">
                Guardar
            </x-button>
            {{-- cancelar --}}
            <x-button tipo="cancel" wire:click="$set('openCreate', false)">
                Cancelar
            </x-button>
        </form>
    @endif

    {{-- lista de culturas --}}
    <h1>Culturas</h1>
    @foreach ($culturas as $cultura)
        <div wire:key="cultura-{{$cultura->idCultura}}">
            <span>{{$cultura->idCultura}}:</span>
            <br>
            <strong>Nombre</strong>
            <h1>{{$cultura->nombre}}</h1>
            <strong>Descripcion</strong>
            <h1>{{$cultura->descripcion}}</h1>
            @foreach ($cultura->fotos as $foto)
                <img src="{{img_u_url($foto->foto)}}" width="100px" alt="img-cultura">
            @endforeach

            {{-- acciones --}}
            <div>
                {{-- ver mas --}}
                <x-button wire:click="show({{$cultura->idCultura}})">
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
                <x-button tipo="back" wire:click="$set('openShow', false)">
                    Salir
                </x-button>
            </div>
        </div>
    @endif

    {{-- paginador --}}
    <div class="paginador">
        {{$culturas->links()}}
    </div>

    {{-- formulario modal editar y actualizar --}}
    @if ($openEdit)
        <div class="modal-container modal-edit-container">
            <div class="modal">
                <form wire:submit="update" enctype="multipart/form-data">
                    @csrf
                    {{-- nombre --}}
                    <x-fieldset>
                        <x-legend>Nombre</x-legend>
                        <x-input wire:model="culturaEdit.nombre" value="{{old('nombre')}}" />
                        @error('nombre')
                            {{$message}}
                        @enderror
                    </x-fieldset>

                    {{-- periodo --}}
                    <x-fieldset>
                        <x-legend>Periodo</x-legend>
                        <x-textarea wire:model="culturaEdit.periodo">{{old('periodo')}}</x-textarea>
                        @error('periodo')
                            {{$message}}
                        @enderror
                    </x-fieldset>

                    {{-- significado --}}
                    <x-fieldset>
                        <x-legend>Significado</x-legend>
                        <x-textarea wire:model="culturaEdit.significado">{{old('significado')}}</x-textarea>
                        @error('significado')
                            {{$message}}
                        @enderror
                    </x-fieldset>

                    {{-- descripcion --}}
                    <x-fieldset>
                        <x-legend>Descripcion</x-legend>
                        <x-textarea wire:model="culturaEdit.descripcion">{{old('descripcion')}}</x-textarea>
                        @error ('descripcion')
                            <div class="error">{{$message}}</div>
                        @enderror
                    </x-fieldset>

                    {{-- aportaciones --}}
                    <x-fieldset>
                        <x-legend>Aportaciones</x-legend>
                        <x-textarea wire:model="culturaEdit.aportaciones">{{old('aportaciones')}}</x-textarea>
                        @error ('aportaciones')
                            <div class="error">{{$message}}</div>
                        @enderror
                    </x-fieldset>

                    <x-fieldset>
                        <x-legend>Imagenes</x-legend>
                        @foreach ($this->cultura->fotos as $foto)
                            <div>
                                <img src="{{img_u_url($foto->foto)}}" width="150px" alt="cultura">
                            </div>
                        @endforeach
                    </x-fieldset>

                    {{-- fotos --}}
                    <x-fieldset>
                        <x-legend>Foto</x-legend>
                        <input type="file" wire:model="culturaEdit.fotos" wire:key="{{$fotoKey}}" accept="image/*" multiple max="4">
                        @error('fotos')
                            <div>{{$message}}</div>
                        @enderror
                    </x-fieldset>

                    {{-- actualizar --}}
                    <x-button type="submit" tipo="update">
                        Actualizar
                    </x-button>

                    {{-- cancelar --}}
                    <x-button tipo="cancel" wire:click="$set('openEdit', false)">
                        Cancelar
                    </x-button>
                </form>
            </div>
        </div>
    @endif

</div>
