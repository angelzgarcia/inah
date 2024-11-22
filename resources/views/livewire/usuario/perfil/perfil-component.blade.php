

<div class="flex justify-center items-center gap-6 flex-col text-center">

    <h1>PERFIL COMPONENT</h1>

    <h1>¡Haz iniciado sesión! Bienvenid@ <x-strong>{{$usuario->nombre ?? 'unknown'}}</x-strong> a tu perfil</h1>
    PERFIL DEL USUARIO
    <br>

    <div>
        <p>Email: <x-strong>{{$usuario->email ?? 'unknown'}}</x-strong> </p>
    </div>

    <h3>Pronto podrás realizar más acciones</h3>

    <div class="flex gap-6">
        <x-button tipo="back" wire:click="redirigir('/')">
            Inicio
        </x-button>
        <x-button wire:click="logout">
            Cerrar Sesión
        </x-button>
    </div>

</div>
