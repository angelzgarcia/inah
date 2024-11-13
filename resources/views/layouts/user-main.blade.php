

{{-- componentes de blade --}}
<!DOCTYPE html>
<html lang="en">
<x-head /> {{-- HEAD --}}
<body class="body-users">
    <x-usuario.header /> {{-- HEADER --}}

    <main class="main-container">
        {{$slot}} {{-- SLOT O CONTENIDO PRINCIPAL --}}
    </main>

    <x-usuario.footer /> {{-- FOOTER --}}
    @livewireScripts {{-- SCRIPTS DE LIVEWIRE --}}
</body>
</html>


