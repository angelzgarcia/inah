

<x-admin-main title="Culturas | Admin | INAH">

    @livewire('admin.cultura-wire')

    @push('js') {{-- STACK JS CULTURAS --}}

        <script>
            window.addEventListener('cult-event', event => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: event.detail.icon,
                    title: event.detail.title
                });
            });
        </script> {{-- SWEET ALERT TOAST --}}

        <script>
            Livewire.on('conf-event', event => {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "Esta acción no se puede revertir.",
                    icon: "warning",
                    toast: true,
                    position: 'center-end',
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // alert(event);
                        Livewire.dispatch('destroy', event);
                    }
                });
            });
        </script> {{-- SWEET ALERT CONMFIRM EVENT --}}

        <script>
            function disabled_input(idImg) {
                var fileInput = document.querySelector(`input[name="imgs_update.${idImg}"]`);
                var checkbox = document.querySelector(`input[name="to_eliminate_imgs.${idImg}"]`);

                checkbox.checked ? fileInput.disabled = true : fileInput.disabled = false;
            }
        </script> {{-- CHECKBOXES ELIMINAR IMAGENES --}}

    @endpush

</x-admin-main>
