
<!DOCTYPE html>
<html lang="en">
<x-head {{-- HEAD --}}
    :title="$title"
    :src-maps="$src_maps"
/>
<body id="body-admin">
    <x-admin.sidebar /> {{-- SIDEBAR ADMIN --}}
    <x-admin.nav-bar {{-- NAVBAR ADMIN --}}
        :user="$user"
    />
    <x-admin.sideprofile {{-- SIDEBAR INFO ADMIN --}}
        :user="$user"
    />

    @livewireScripts {{-- SCRIPTS DE LIVEWIRE --}}

    <main class="main-admin-container my-8" id="main-admin-container">
        {{$slot}} {{-- CONTENIDO / SLOT PRINCIPAL --}}
    </main>

    @stack('js') {{-- SCRIPTS --}}
</body>
</html>
