


<div class="flex !min-h-screen max-w-md mx-auto">
    <div class=" flex flex-col mb-14 justify-start my-auto gap-4">
        {{-- logo --}}
        <div class="opacity-80 bg-white rounded-lg shadow-md shadow-gray-300 ">
            <a href="{{route('home')}}">
                <img src="{{img_d_url('logo_85.png')}}" alt="inah_logo ">
            </a>
        </div>

        <form wire:submit="register" autocomplete="off" class="bg-white rounded-lg shadow-md shadow-gray-300 py-5 px-6">
            @csrf

            <div class="mb-4">
                <x-label for="nombre" class="block mb-2 text-sm font-medium text-gray-800">Nombre</x-label>
                <x-input type="text" wire:model.live="nombre" class="!text-lg border-2 focus:border-blue-800 focus:border-2 focus:bg-white" autofocus />
                <x-error-message for="nombre" />
            </div>

            <div class="mb-4">
                <x-label for="email" class="block mb-2 text-sm font-medium text-gray-800">Correo electrónico</x-label>
                <x-input type="text" wire:model.live="email" autocomplete="off" class="!text-lg border-2 focus:border-blue-800 focus:border-2 focus:bg-white" />
                <x-error-message for="email" />
            </div>

            <div class="mb-4">
                <x-label for="password" class="block mb-2 text-sm font-medium text-gray-800">Contraseña</x-label>
                <x-input type="text" wire:model.live="password" autocomplete="off" class="!text-lg border-2 focus:border-blue-800 focus:border-2 focus:bg-white" />
                <x-error-message for="password" />
            </div>

            <div class="mb-4">
                <x-label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-800">Confirmar contraseña</x-label>
                <x-input type="text" wire:model.live="password_confirmation" class="!text-lg border-2 focus:border-blue-800 focus:border-2 focus:bg-white" />
                <x-error-message for="password_confirmation" />
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="terminos" class="form-checkbox">
                    <span class="ml-2 text-xs">Acepto los <a href="" class="underline text-gray-800">Términos del servicio</a> y la <a href="" class="underline text-gray-800">Política de Privacidad</a></span>
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
