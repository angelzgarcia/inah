@php
    $first = $usuarios -> first();
    $keys = $first ? array_keys($first->getAttributes()) : [];
@endphp

{{-- VISTA DEL COMPONENTE CULTURAS --}}
<div class="w-full h-full">

    <div class="py-5">

        <div class="w-full h-fullitems-center justify-center flex flex-col gap-7 px-7">

            {{-- botones volver, agregar y cancelar --}}
            <x-crud-buttons-header :form_object="$usuarioCreate" name_form="usuarioCreate" />

            {{-- formularo crear usuario --}}
            @if ($usuarioCreate->openCreate)
                <div class="sbw-thin w-full flex flex-col justify-between gap-8 rounded-xl">
                    @if ($nUsuarios < 1)
                        <x-not-found>
                            Aún no existen registros de Estados de la República Mexicana. <br>
                            Ingresa algunos para continuar.
                            <x-button class="w-full mt-4" route="admin.usuarios" tipo="go" />
                        </x-not-found>
                    @else
                        {{-- titulo --}}
                        <h1 class="text-3xl">
                            <x-strong>Agregar Administrador</x-strong>
                        </h1>
                        {{-- formulario --}}
                        <form wire:submit="save" enctype="multipart/form-data" class="w-full italic flex flex-col gap-6">
                            @csrf

                            {{-- nombre --}}
                            <x-fieldset>
                                <x-legend>Nombre*</x-legend>
                                <x-input wire:model.live="usuarioCreate.nombre" />
                                <x-error-message for="usuarioCreate.nombre" />
                            </x-fieldset>

                            {{-- email --}}
                            <x-fieldset>
                                <x-legend>Email*</x-legend>
                                <x-input wire:model.live="usuarioCreate.email" />
                                <x-error-message for="usuarioCreate.email" />
                            </x-fieldset>

                            {{-- numero celular y genero --}}
                            <div class="flex justify-between gap-9">
                                {{-- telefono --}}
                                <x-fieldset class="w-1/2">
                                    <x-legend>Número Celular*</x-legend>
                                    <div class="flex relative gap-2 items-center">
                                        <img src="{{img_d_url('mexico-icon-512x384-tng9bcfk.png')}}" width="30px" height="20px" alt="lada">
                                        <span class="absolute left-9 bg-gray-200 rounded-md px-2 flex items-center text-center h-full text-gray-500">+52</span>
                                        <x-input id="telefono" oninput="formatearTelefono(this)" wire:model.live="usuarioCreate.numero" class="pl-12" />
                                    </div>
                                    <x-error-message for="usuarioCreate.numero" />
                                </x-fieldset>

                                {{-- genero --}}
                                <div class="flex flex-row w-1/2 justify-between gap-12">
                                    <x-fieldset wire:model.live="usuarioCreate.genero">
                                        <x-legend>Género*</x-legend>
                                        <x-select>
                                            <option value="masculino">Masculino</option>
                                            <option value="femenino">Femenino</option>
                                        </x-select>
                                        <x-error-message for="usuarioCreate.genero" />
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
                    @endif
                </div>
            @endif

            {{-- CRUD CULTURAS --}}
            @if ($nUsuarios < 1)
                @if (!$usuarioCreate->openCreate)
                    <x-not-found class="rounded-2xl !items-center">
                        <div class="flex gap-9 items-center">
                            Hay 0 registros.
                            <span>¡Ingresa algunos!</span>
                            <x-button tipo="up" wire:click="$set('usuarioCreate.openCreate', true)" />
                        </div>
                    </x-not-found>
                @endif
            @else
                <x-table-grid :table="$usuarios" :keys="$keys" key="Usuarios" :ocultarEliminar="true" :attribute2="false" :attribute3="true" :attribute6="true" :attribute11="true">

                    {{-- ordenador de registros --}}
                    <x-slot name="ordenable">
                        <x-ordenable :keys="$keys" :nK=[0,2,10] />
                    </x-slot>

                    {{-- slot -> thead --}}
                    <div class=" w-full">
                        <div class="w-2/3 px-2 flex flex-row justify-start gap-9 items-center mb-4 italic text-gray-400 text-start font-thin">
                            <x-strong class="border-gray-200 text-xs bg-white px-4 shadow-md !rounded-3xl border">
                                ID
                            </x-strong>
                            <x-strong class="border-gray-200 !min-w-32 px-4 bg-white text-xs shadow-md !rounded-3xl border">
                                Nombre
                            </x-strong>
                            <x-strong class="border-gray-200 !min-w-32 px-4 text-xs bg-white shadow-md !rounded-3xl border">
                                Email
                            </x-strong>
                            <x-strong class="border-gray-200 !min-w-32 px-4 text-xs bg-white shadow-md !rounded-3xl border">
                                Stattus
                            </x-strong>
                        </div>
                    </div>

                </x-table-grid>
            @endif

            {{-- modal ver más detalles --}}
            @if ($openShow)
                <x-modal openPropiety="openShow" :registerUpdateAt="$this->usuario">

                    {{-- fecha de registro --}}
                    <div class="w-full flex flex-row justify-between items-center">
                        <x-strong class="!text-xl">Detalles del usuario</x-strong>
                        {{-- created_at --}}
                        <div class="text-end">
                            <x-strong>Fecha de regstro: </x-strong>
                            <span>{{$this->usuario->created_at}}</span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-10">
                        {{-- foto --}}
                        <div class="basis-1/5 flex justify-center items-center flex-col">
                            <x-legend>Avatar: </x-legend>
                            @if (img_u_url($this->usuario->foto))
                                {{-- <img src="{{ img_u_url($this->usuario->foto) }}" width="200px" height="200px" class="text-center flex justify-center shadow-lg border border-gray-300 items-center italic text-xs font-bold underline rounded-full bg-slate-200" alt="user-avatar"> --}}
                                <img src="{{ img_a_url('avatar-m5.jpg') }}" width="200px" height="200px" class="text-center flex justify-center shadow-lg border border-gray-300 items-center italic text-xs font-bold underline rounded-full bg-slate-200" alt="user-avatar">
                            @else
                            @endif
                        </div>

                        {{-- datos --}}
                        <div class="w-3/4 grid grid-cols-auto-fill-200 gap-11 justify-between items-center flex-wrap">
                            {{-- nombre --}}
                            <div class="nombre-usuario mb-2">
                                <x-legend>Nombre: </x-legend>
                                <x-strong class="h1u">{{$this->usuario->nombre}}</x-strong>
                            </div>

                            {{-- genero --}}
                            <div>
                                <x-legend>Género: </x-legend>
                                @if ($this->usuario->genero) <x-strong>{{$this->usuario->genero }}</x-strong>
                                @else <x-strong class="text-gray-500">NULL</x-strong>
                                @endif
                            </div>

                            {{-- numero --}}
                            <div>
                                <x-legend>Número: </x-legend>
                                @if ($this->usuario->numero) <x-strong><span class="italic">+52</span> {{$this->usuario->numero }}</x-strong>
                                @else <x-strong class="text-gray-500">NULL</x-strong>
                                @endif
                            </div>

                            {{-- email --}}
                            <div>
                                <x-legend>Email: </x-legend>
                                <x-strong>{{$this->usuario->email }}</x-strong>
                            </div>

                            {{-- google_id --}}
                            <div>
                                <x-legend>Google ID: </x-legend>
                                @if ($this->usuario->google_id) <x-strong>{{$this->usuario->google_id }}</x-strong>
                                @else <x-strong class="text-gray-500">NULL</x-strong>
                                @endif
                            </div>

                            {{-- token de confiramcion --}}
                            <div>
                                <x-legend>Toekn de confirmación: </x-legend>
                                @if ($this->usuario->token) <x-strong>{{$this->usuario->token }}</x-strong>
                                @else <x-strong class="text-gray-500">NULL</x-strong>
                                @endif
                            </div>

                            {{-- token de confiramcion --}}
                            <div>
                                <x-legend>Estatus de confirmación: </x-legend>
                                <x-strong>{{$this->usuario->confirmado == 1 ? 'Confirmado' : 'Pendiente' }}</x-strong>
                            </div>

                            {{-- token de confiramcion --}}
                            <div>
                                <x-legend>Estatus de la cuenta: </x-legend>
                                <x-strong>{{$this->usuario->status == 'activo' ? 'activa' : 'inactiva' }}</x-strong>
                            </div>

                            {{-- token de confiramcion --}}
                            <div>
                                <x-legend>Rol: </x-legend>
                                <x-strong>{{$this->usuario->idRol == 1 ? 'Usuario' : 'Administrador' }}</x-strong>
                            </div>
                        </div>
                    </div>

                </x-modal>
            @endif

            {{-- formulario modal editar y actualizar --}}
            @if ($usuarioUpdate->openEdit)
                <x-modal openPropiety="usuarioUpdate.openEdit" :formEdit="true">

                    {{-- nombre usuario  --}}
                    <h2 class="text-4xl text-center flex flex-row justify-between">
                        <x-strong class="!text-xl">Editar Registro</x-strong>
                    </h2>

                    {{-- datos del registro --}}
                    <div class="flex justify-between gap-20">

                        {{-- foto --}}
                        <div class="basis-3/12 flex justify-center items-center flex-col">
                            <x-legend>Avatar: </x-legend>
                            @if (img_u_url($this->usuarioUpdate->usuario->foto))
                                {{-- <img src="{{ img_u_url($this->usuario->foto) }}" width="200px" height="200px" class="text-center flex justify-center shadow-lg border border-gray-300 items-center italic text-xs font-bold underline rounded-full bg-slate-200" alt="user-avatar"> --}}
                                <img src="{{ img_a_url('avatar-m5.jpg') }}" width="200px" height="200px" class="text-center flex justify-center shadow-lg border border-gray-300 items-center italic text-xs font-bold underline rounded-full bg-slate-200" alt="user-avatar">
                            @else
                            @endif
                        </div>

                        <div class="flex basis-9/12 gap-11 justify-between items-center flex-wrap">
                            {{-- email --}}
                            <div>
                                <x-legend>Email: </x-legend>
                                <x-strong>{{$this->usuarioUpdate->usuario->email }}</x-strong>
                            </div>

                            {{-- token de confiramcion --}}
                            <div>
                                <x-legend>Rol: </x-legend>
                                <x-strong>{{$this->usuarioUpdate->usuario->idRol == 1 ? 'Usuario' : 'Administrador' }}</x-strong>
                            </div>

                            {{-- estatus de la cuenta --}}
                            <div>
                                <x-legend>Estatus de la cuenta: </x-legend>
                                <x-select wire:model="usuarioUpdate.statusCuenta">
                                    @foreach ($this->usuarioUpdate->enumValues as $value)
                                        <option value="{{ $value }}" {{ $this->usuarioUpdate->statusCuenta === $value ? 'selected' : '' }}>
                                            {{ $value == 'activo' ? 'A C T I V A' : 'I N A C T I V A' }}
                                        </option>
                                    @endforeach
                                </x-select>

                                {{-- {{$this->usuarioUpdate->enumValues[0]}} --}}
                                {{-- <x-strong>{{$this->usuarioUpdate->usuario->status == 'activo' ? 'activa' : 'inactiva' }}</x-strong> --}}
                            </div>
                        </div>

                    </div>
                </x-modal>
            @endif

        </div>

    </div>

</div>
