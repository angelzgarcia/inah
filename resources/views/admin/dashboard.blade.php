
<x-admin-main title="Dashboard | INAH">

    @isset($user)
        <x-slot name="user">
            @php
                $user
            @endphp
        </x-slot>
    @endisset

    <section class="dashboard-container">
        ¿K conio pongo akii?
        {{-- <div class="registers-tables-card">
            <h3>usuarios </h3>
            <h4>23 <span>registros</span></h4>
        </div>
        <div class="registers-tables-card">
            <h3>reseñas </h3>
            <h4>23 <span>registros</span></h4>
        </div>
        <div class="registers-tables-card">
            <h3>estados de la republica </h3>
            <h4>23 <span>registros</span></h4>
        </div>
        <div class="registers-tables-card">
            <h3>zonas arqueológicas </h3>
            <h4>23 <span>registros</span></h4>
        </div>
        <div class="registers-tables-card">
            <h3>culturas </h3>
            <h4>23 <span>registros</span></h4>
        </div> --}}
    </section>

</x-admin-main>
