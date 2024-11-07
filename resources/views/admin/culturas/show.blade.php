

<x-layouts.admin-main title="Cultura {{$culture->nombre}} | INAH">
    <x-button>
        <a href="{{route('admin.culturas.index')}}">
            Volver a las culturas
        </a>
    </x-button>
    <x-button tipo="edit">
        <a href="{{route('admin.culturas.edit', $culture)}}">
            Editar
        </a>
    </x-button>
    <form action="{{route("admin.culturas.destroy", $culture)}}" method="POST">
        @csrf
        @method('delete')
        <x-button type="submit" tipo="destroy">
            Eliminar
        </x-button>
    </form>
    {{-- {{phpinfo()}} --}}
    <h1>HAZ BUSCADO LA CULTURA <em><big>{{$culture->idCultura}} | "{{$culture->nombre}}"</big></em></h1>
    <p>{{$culture->descripcion}}</p>
    @foreach ($culture->fotos as $foto)
        <br>
        <img src="{{ img_u_url($foto->foto)}}" width="300px" alt="cultura">
    @endforeach
</x-layouts.admin-main>
