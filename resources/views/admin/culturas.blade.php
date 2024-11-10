

<x-admin-main title="Culturas | Admin | INAH">

    @livewire('admin.cultura-wire')

    <x-slot name="js">
        <script>
            function disabled_input(idImg) {
                var fileInput = document.querySelector(`input[name="imgs_update.${idImg}"]`);
                var checkbox = document.querySelector(`input[name="to_eliminate_imgs.${idImg}"]`);

                checkbox.checked ? fileInput.disabled = true : fileInput.disabled = false;
            }
        </script>
    </x-slot>

</x-admin-main>
