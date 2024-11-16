

@props(['text' => ''])

{{-- SWEET ALERT CONMFIRM EVENT --}}
<script>
    Livewire.on('conf-event', event => {
        Swal.fire({
            title: "¿Estás seguro? \n Esta acción no se podrá revertir.",
            text: @json($text),
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
</script>
