
@props(['openPropiety'])

{{-- ventana modal --}}
<div class="modal-container modal-show-container modal-edit-container">
    <div class="modal"
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
            <div class="form-edit-container flex flex-col gap-4 relative ">
                {{-- boton cerrar --}}
                <div class="flex flex-row justify-end sticky mb-4 z-10 top-2 right-0">
                    <x-button class="hover:rotate-180" tipo="x" wire:click="$set('{{$openPropiety}}', false)"></x-button>
                </div>

                {{$slot}}

            </div>
        </div>
    </div>
</div>
