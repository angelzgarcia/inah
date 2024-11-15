

{{-- componentes de blade --}}
<!DOCTYPE html>
<html lang="en">
<x-head {{-- HEAD --}}
    :title="$title"
    :src-maps="$src_maps"
/>
<body class="body-users">
    <x-usuario.header /> {{-- HEADER --}}

    <main class="main-container">
        {{$slot}} {{-- SLOT O CONTENIDO PRINCIPAL --}}
    </main>

    <x-usuario.footer /> {{-- FOOTER --}}
    @livewireScripts {{-- SCRIPTS DE LIVEWIRE --}}
    @stack('js')
</body>
</html>


