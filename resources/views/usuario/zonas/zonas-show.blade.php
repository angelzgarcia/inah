


<x-user-main title="Zona Arqueológica {{$zona->nombre}} | INAH">

    @livewire('usuario.zonas.zonas-show-component', ['idZona' => $zona->idZonaArqueologica], key($zona->idZonaArqueologica))

</x-user-main>
