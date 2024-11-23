


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head
    :title="$title ?? 'Zonas Arqueológicas de México | INAH'"
/> {{-- HEAD --}}
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


