
@props(['openPropiety'])

{{-- ventana modal --}}
<div class="modal-container modal-show-container modal-edit-container">
    <div class="modal ">
        <div class="flex flex-col overflow-y-auto gap-4 justify-center">
            <div class="form-edit-container flex flex-col gap-4 relative ">
                {{-- boton cerrar --}}
                <div class="flex flex-row justify-end sticky top-0 right-0">
                    <x-button tipo="x" wire:click="$set('{{$openPropiety}}', false)"></x-button>
                </div>

                {{$slot}}

            </div>
        </div>
    </div>
</div>
