

@props(['openPropiety', 'registerUpdateAt' => null, 'formEdit' => false])

{{-- ventana modal --}}
<div class="modal-container modal-show-container modal-edit-container">
    <div
    {!!
        $attributes -> merge([
            'class'
                =>
            'modal'
        ])
    !!}
        x-data="{ showModal: @entangle($openPropiety) }"
        x-show="showModal"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-full"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-full"
    >
        <div class="flex flex-col rounded-md bg-white py-4 px-10 overflow-y-auto gap-4 justify-center">
            <div class="form-container overflow-y-scroll px-6 overflow-x-hidden flex flex-col gap-4 relative">

                {{-- boton cerrar --}}
                <div class="flex flex-row justify-end sticky mb-4 z-10 top-2 right-0">
                    <x-button class="hover:rotate-180" tipo="x" wire:click="$set('{{$openPropiety}}', false)"></x-button>
                </div>

                {{-- slot --}}
                <div>
                    @if ($registerUpdateAt)

                        <div class="flex flex-col gap-6">

                            {{$slot}}

                            {{-- fecha de actualizacion y boton cerrar --}}
                            <div class="flex flex-row mt-8 justify-between items-center">
                                {{-- updated_at --}}
                                <div>
                                    <x-strong>Ultima actualización: </x-strong>
                                    <span>{{$registerUpdateAt->updated_at}}</span>
                                </div>
                                {{-- cerrar --}}
                                <x-button tipo="close" wire:click="$set('{{$openPropiety}}', false)">
                                    Cerrar
                                </x-button>
                            </div>

                        </div>

                    @elseif($formEdit)

                        {{-- formulario editar --}}
                        <form wire:submit="update" enctype="multipart/form-data" class="py-3 flex flex-col gap-6 text-sm">
                            @csrf

                            {{$slot}}

                            {{-- botones de actualizar y cancelar --}}
                            <div class="flex flex-row justify-end gap-6">
                                {{-- actualizar --}}
                                <x-button type="submit" tipo="update">
                                    Actualizar
                                </x-button>

                                {{-- cancelar --}}
                                <x-button tipo="cancel" wire:click="$set('{{$openPropiety}}', false)">
                                    Cancelar
                                </x-button>
                            </div>
                        </form>

                    @else

                        <div class="flex flex-col gap-6">

                            {{$slot}}

                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
