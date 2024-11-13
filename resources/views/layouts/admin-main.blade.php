
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

    <main class="main-admin-container" id="main-admin-container">
        {{$slot}} {{-- CONTENIDO / SLOT PRINCIPAL --}}
    </main>

    {{$js}} {{-- SCRIPTS --}}
    @livewireScripts {{-- SCRIPTS DE LIVEWIRE --}}
    <script>
        window.addEventListener('cult-event', event => {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
                });
                Toast.fire({
                icon: event.detail.icon,
                title: event.detail.title
            });
        });
    </script>
</body>
</html>
