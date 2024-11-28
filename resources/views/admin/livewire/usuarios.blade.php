

<x-admin-main title="Usuarios | INAH">

    @livewire('admin.usuario-component')

    @push('js')
        <x-toast name_event="user-event" />  {{-- SWEET ALERTS USUARIO --}}

        <script>
            function formatearTelefono(input) {
                let numero = input.value.replace(/\D/g, '');

                if (numero.length > 3 && numero.length <= 6) {
                    numero = numero.slice(0, 3) + '-' + numero.slice(3);
                } else if (numero.length > 6) {
                    numero = numero.slice(0, 3) + '-' + numero.slice(3, 6) + '-' + numero.slice(6, 10);
                }

                input.value = numero;
            }
        </script> 
    @endpush

</x-admin-main>
