
{{-- componentes de blade --}}

<!DOCTYPE html>
<html lang="en">
<x-head /> {{-- HEAD --}}
<body class="body-users">
    <x-usuario.partials.header /> {{-- HEADER --}}

    <main class="main-container">
        {{$slot}} {{-- SLOT O CONTENIDO PRINCIPAL --}}
    </main>

    <x-usuario.partials.footer /> {{-- FOOTER --}}
</body>
</html>


