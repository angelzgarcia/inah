

{{-- componentes de blade --}}
<!DOCTYPE html>
<html lang="en">
<x-head {{-- HEAD --}}
    :title="$title ?? 'Zonas Arqueológicas de México | INAH'"
    {{-- :src-maps="$src_maps" --}}
/>
<body class="body-users">
    @if ($hiddenNav == false)
        <x-usuario.header /> {{-- HEADER --}}
    @endif

    @livewireScripts {{-- SCRIPTS DE LIVEWIRE --}}

    <main class="main-container">
        {{$slot}} {{-- SLOT O CONTENIDO PRINCIPAL --}}
    </main>

    @if ($hiddenFoot == false)
        <x-usuario.footer /> {{-- FOOTER --}}
    @endif

    @stack('js')
</body>
</html>


