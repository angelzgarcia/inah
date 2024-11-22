


<div class="flex !min-h-screen max-w-md mx-auto">
    <div class=" flex flex-col mb-14 justify-start my-auto gap-2">
        {{-- logo --}}
        <div class="opacity-80">
            <a href="{{route('home')}}">
                <img src="{{img_d_url('logo_85.png')}}" alt="inah_logo">
            </a>
        </div>

        <form wire:submit="register" autocomplete="off" class="bg-white rounded-lg shadow-md shadow-gray-300 py-5 px-6">
            @csrf

            <div class="mb-4">
                <x-label for="nombre" class="block mb-2 text-sm font-medium">Nombre</x-label>
                <x-input type="text" wire:model.live="nombre" class="!text-lg border-2 focus:border-blue-800 focus:border-2 focus:bg-white" autofocus />
                <x-error-message for="nombre" />
            </div>

            <div class="mb-4">
                <x-label for="email" class="block mb-2 text-sm font-medium">Correo electrónico</x-label>
                <x-input type="email" id="email" wire:model.live="email" class="!text-lg border-2 focus:border-blue-800 focus:border-2 focus:bg-white" />
                <x-error-message for="email" />
            </div>

            <div class="mb-4">
                <x-label for="password" class="block mb-2 text-sm font-medium">Contraseña</x-label>
                <x-input type="password" id="password" wire:model.live="password" class="!text-lg border-2 focus:border-blue-800 focus:border-2 focus:bg-white" />
                <x-error-message for="password" />
            </div>

            <div class="mb-4">
                <x-label for="password_confirmation" class="block mb-2 text-sm font-medium">Confirmar contraseña</x-label>
                <x-input type="password" id="password_confirmation" wire:model.live="password_confirmation" class="!text-lg border-2 focus:border-blue-800 focus:border-2 focus:bg-white" />
                <x-error-message for="password_confirmation" />
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="" class="form-checkbox">
                    <span class="ml-2 text-xs">Acepto los <a href="" class="underline">Términos del servicio</a> y la <a href="" class="underline">Política de Privacidad</a></span>
                </label>
            </div>

            <div class="flex gap-4 items-center">
                <x-button type="submit" class="py-2 !px-6 rounded tracking-widest">Registrarse</x-button>
                <a href="{{route('login')}}" class="text-sm underline text-gray-600">¿Ya se registró?</a>
            </div>
        </form>

        @if (session()->has('message'))
            <div class="text-green-500 mt-4">{{ session('message') }}</div>
        @endif
    </div>
</div>
