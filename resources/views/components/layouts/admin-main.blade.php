
<!DOCTYPE html>
<html lang="en">
<x-head {{-- HEAD --}}
    :title="$title ?? ''"
    :src-maps="$src_maps ?? ''"
/>
<body id="body-admin">

    <x-admin.sidebar /> {{-- SIDEBAR ADMIN --}}
    <x-admin.nav-bar {{-- NAVBAR ADMIN --}}
        :user="$user ?? null"
    />
    <x-admin.sideprofile {{-- SIDEBAR INFO ADMIN --}}
        :user="$user ?? null"
    />

    <main class="main-admin-container" id="main-admin-container">
        {{$slot}} {{-- CONTENIDO / SLOT PRINCIPAL --}}
    </main>

    @isset($js) {{$js}} @endisset {{-- SCRIPTS --}}
    @livewireScripts {{-- SCRIPTS DE LIVEWIRE --}}

</body>
</html>
