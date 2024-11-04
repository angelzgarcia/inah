
<x-layouts.admin-main :title="'Culturas de México | INAH'">

    <livewire-button>
        <a href="{{route('database.index')}}">Volver</a>
    </livewire-button>

    <livewire-button>
        <a href="{{route('admin.culturas.create')}}">Agregar cultura</a>
    </livewire-button>

    @foreach ($culturas as $cultura)
        <h1>
            <span>{{$cultura->idCultura}}</span>
            _
            <a href="{{route('admin.culturas.show', $cultura->idCultura)}}">{{$cultura->nombre}}</a>
            {{-- query strings son los parametros que tiene el metodo route --}}
            <span><small><a href="{{route('admin.culturas.edit', $cultura, 'edit')}}">Editar</a></small></span>
            <form action="{{route('admin.culturas.destroy', $cultura)}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit">Eliminar</button>
            </form>
        </h1>

    @endforeach

    <div class="paginador">
        {{$culturas->links()}}
    </div>

</x-layouts.admin-main>
