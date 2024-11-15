
<x-admin-main title="Estados de la República Mexicana | Admin | INAH">

    @livewire('admin.estado-wire')


    @push('js') {{-- STACK JS ESTADOS --}}

        <script>
            window.addEventListener('est-event', event => {
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
                    title: "¿Estás seguro? \n Esta acción no se puede revertir.",
                    text: "Todas las culturas relacionadas a este estado tambien serán elimiandas",
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

    @endpush

</x-admin-main>
