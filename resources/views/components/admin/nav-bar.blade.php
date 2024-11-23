

<div>
    <header class="header-admin">
        <nav class="navbar-admin bg-gray-300 shadow-sm shadow-gray-400">
            <div class="flex text-zinc-700">
                <x-strong>
                    @if ($usuario->genero)
                        @if ($usuario->genero == 'masculino')
                            Bienvenido
                        @elseif ($usuario->genero == 'femenino')
                            Bienvenida
                        @endif
                    @else
                        Bienvenid@
                    @endif
                </x-strong>
                <x-strong>
                    {{$usuario->nombre ?? 'Administrador'}}
                </x-strong>
            </div>
            <div id="avatar-admin" class="cursor-pointer mr-3 bg-zinc-400 shadow-md rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" width="30px" fill="#fff"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z"/></svg>
            </div>
        </nav>
    </header>

    @push('js')
        <script>
            var admin_avatar = document.getElementById('avatar-admin');
            var info_admin = document.getElementById('info-admin');
            var close_profile_info = document.getElementById('close-profile-info');

            info_admin.style.display = 'none';
            info_admin.style.visibility = 'hidden';

            admin_avatar.addEventListener('click', function(event) {
                event.stopPropagation();
                info_admin.style.display = 'flex';
                info_admin.style.visibility = 'visible';
                info_admin.style.opacity = 1;
            });

            close_profile_info.addEventListener('click', function() {
                info_admin.style.display = 'none';
                info_admin.style.visibility = 'hidden';
            });
        </script>
    @endpush

</div>
