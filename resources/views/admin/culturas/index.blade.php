
<x-layouts.admin-main title="Culturas de México | Tabla | INAH">

    <x-button>
        <a href="{{route('database.index')}}">Volver</a>
    </x-button>

    <x-button tipo="create">
        <a href="{{route('admin.culturas.create')}}">Agregar cultura</a>
    </x-button>

    <h1>Culturas</h1>
    @foreach ($culturas as $cultura)
            <span>{{$cultura->idCultura}}</span>
            _
            <a href="{{route('admin.culturas.show', $cultura->idCultura)}}">{{$cultura->nombre}}</a>
            {{-- query strings son los parametros que tiene el metodo route --}}
            <br>
            <x-button tipo="edit">
                <a href="{{route('admin.culturas.edit', $cultura, 'edit')}}">
                    Editar
                </a>
            </x-button>
            <form action="{{route('admin.culturas.destroy', $cultura)}}" method="POST">
                @csrf
                @method('delete')
                <x-button tipo="destroy">
                    Eliminar
                </x-button>
            </form>
            <br>
    @endforeach

    <div class="paginador">
        {{$culturas->links()}}
    </div>

</x-layouts.admin-main>
