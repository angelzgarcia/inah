

<x-admin-main title="Zonas Arqueológicas de México | Admin | INAH">

    @livewire('admin.zona-component')

    @push('js')

        {{-- buscador de direcciones de google --}}
        <script>
            Livewire.on('address', event => {
                setTimeout(() => {
                    const input = document.querySelector('#address');
                    if (input instanceof HTMLInputElement) {
                        const autocomplete = new google.maps.places.Autocomplete(input, {
                            types: ['address'],
                            componentRestrictions: { country: 'mx' },
                        });

                        autocomplete.addListener('place_changed', () => {
                            const place = autocomplete.getPlace();
                            const address = place.formatted_address;
                            event = [address];

                            if (address) {
                                console.log('Direccion a enviar:', address);  // Verifica que es una cadena
                                Livewire.dispatch('updateDireccion', event);
                                console.log('Lugar seleccionado:', address);
                            }
                        });
                    }
                }, 200);
            });
        </script>

        <x-toast name_event="zona-event" />  {{-- SWEET ALERTS CRUD --}}

        <x-toast-confirm /> {{-- SWEET ALERT CONFIRMAR ELIMIANCION --}}

        <script>
            function disabled_input(idImg) {
                var fileInput = document.querySelector(`input[name="imgs_update.${idImg}"]`);
                var checkbox = document.querySelector(`input[name="to_eliminate_imgs.${idImg}"]`);

                checkbox.checked ? fileInput.disabled = true : fileInput.disabled = false;
            }
        </script> {{-- CHECKBOXES ELIMINAR IMAGENES --}}

    @endpush

</x-admin-main>
