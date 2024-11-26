

<x-admin-main title="Culturas | Admin | INAH">

    @livewire('admin.cultura-component')

    @push('js') {{-- STACK JS CULTURAS --}}

        <x-toast name_event="cult-event" /> {{-- SWEET ALERT TOAST --}}

        <x-toast-confirm /> {{-- SWEET ALERT CONMFIRM EVENT --}}

        <script>
            function disabled_input(idImg) {
                var fileInput = document.querySelector(`input[name="imgs_update.${idImg}"]`);
                var checkbox = document.querySelector(`input[name="to_eliminate_imgs.${idImg}"]`);

                checkbox.checked ? fileInput.disabled = true : fileInput.disabled = false;
            }
        </script> {{-- CHECKBOXES ELIMINAR IMAGENES --}}

    @endpush

</x-admin-main>
