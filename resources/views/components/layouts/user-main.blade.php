


<!DOCTYPE html>
<html lang="en">
<x-head
    :title="$title ?? 'Zonas Arqueológicas de México | INAH'"
/> {{-- HEAD --}}
<body class="body-users">
    @if ($hiddenNav == false)
        <x-usuario.header /> {{-- HEADER --}}
    @endif

    @livewireScripts {{-- SCRIPTS DE LIVEWIRE --}}

    <main class="main-container " style="width:{{$mainW}}%">
        {{$slot}} {{-- SLOT O CONTENIDO PRINCIPAL --}}
    </main>

    @if ($hiddenFoot == false)
        <x-usuario.footer /> {{-- FOOTER --}}
    @endif

    @stack('js')

    @if ($usarMapa)
        <x-src-maps /> {{-- GOOGLE SCRIPTS --}}
    @endif
</body>
</html>


