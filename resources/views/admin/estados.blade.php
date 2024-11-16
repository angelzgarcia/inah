
<x-admin-main title="Estados de la República Mexicana | Admin | INAH">

    @livewire('admin.estado-wire')


    @push('js') {{-- STACK JS ESTADOS --}}

        <x-toast name_event="est-event"/> {{-- SWEET ALERT TOAST --}}

        <x-toast-confirm
            text="Todas las culturas relacionadas a este estado tambien serán elimiandas."
        /> {{-- SWEET ALERT CONMFIRM EVENT --}}

    @endpush

</x-admin-main>
