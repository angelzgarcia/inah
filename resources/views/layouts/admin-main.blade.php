

@auth
    @if (Auth::user()->idRol == 2)
        @php $usuario = Auth::user() @endphp

        <!DOCTYPE html>
        <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <x-head {{-- HEAD --}}
            :title="$title ?? 'Dashboard Admin | INAH'"
        />
        <body id="body-admin">
            <x-admin.sidebar /> {{-- SIDEBAR ADMIN --}}

            <x-admin.nav-bar {{-- NAVBAR ADMIN --}}
                :usuario="$usuario"
            />

            <x-admin.sideprofile {{-- SIDEBAR INFO ADMIN --}}
                :usuario="$usuario"
            />

            @livewireScripts {{-- SCRIPTS DE LIVEWIRE --}}

            <main class="main-admin-container my-8" id="main-admin-container">
                {{$slot}} {{-- CONTENIDO / SLOT PRINCIPAL --}}
            </main>

            @stack('js') {{-- SCRIPTS --}}
        </body>
        </html>
    @endif
@endauth
