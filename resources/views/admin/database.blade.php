
<x-layouts.admin-main :title="'Database | INAH'">
    {{-- BUSCADOR --}}
    {{-- @include('partials.searcher-admin') --}}

    <section class="database-section">
        <h1>database <span>{{$database_name}}</span></h1>

        <h2>{{$tables_count}} tablas</h2>
        <div class="tables-preview-container">
            {{-- TABLA --}}
            @foreach($tables_and_counts as $table)
                <x-admin.table-preview>
                    <x-slot name="examinar">
                        <a href="{{route("admin.{$table['name']}.index")}}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 256l0-96 160 0 0 96L64 256zm0 64l160 0 0 96L64 416l0-96zm224 96l0-96 160 0 0 96-160 0zM448 256l-160 0 0-96 160 0 0 96zM64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32z"/></svg>
                            <span>Examinar</span>
                        </a>
                    </x-slot>

                    <x-slot name="eliminar">
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM184 232l144 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-144 0c-13.3 0-24-10.7-24-24s10.7-24 24-24z"/></svg>
                            <span>Eliminar</span>
                        </a>
                    </x-slot>

                    <x-slot name="count_registers">
                        <span>
                            <strong>{{$table['count']}} registros</strong>
                        </span>
                    </x-slot>

                    <h3><a href="{{route("admin.{$table['name']}.index")}}">{{$table['name']}}</a></h3>
                </x-admin.table-preview>
            @endforeach
        </div>

    </section>

</x-layouts.admin-main>
