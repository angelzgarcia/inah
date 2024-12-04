


<x-user-main :title="'Zonas Arqueológicas de ' . $estado->nombre . ' | INAH'" :usarMapa="true">

    @livewire('usuario.zonas-estados-component', ['idEstado' => $estado->idEstadoRepublica], key($estado->idEstadoRepublica))


</x-user-main>
