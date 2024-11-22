

<div class="flex !min-h-screen max-w-md mx-auto">
    <div class=" flex flex-col justify-start my-auto gap-2">
        {{-- logo --}}
        <div class="opacity-80">
            <a href="{{route('home')}}">
                <img src="{{img_d_url('logo_85.png')}}" alt="inah_logo">
            </a>
        </div>

        <x-strong class="text-center tracking-widest">¡Bienvenido de nuevo!</x-strong>

        <div class="bg-white rounded-lg shadow-md shadow-gray-300 py-5 px-6">
            <form wire:submit="login" autocomplete="off">
                @csrf
                {{-- mensaje de confiramcion de registro exitoso --}}
                @if (session()->has('message'))
                    <div class="text-green-500 mb-4">{{ session('message') }}</div>
                @endif

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Correo electrónico</label>
                    <input type="email" id="email" wire:model.live="email" class="border px-4 py-2 w-full">
                    <x-error-message for="email" />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium">Contraseña</label>
                    <input type="password" id="password" wire:model.live="password" class="border px-4 py-2 w-full">
                    <x-error-message for="password" />
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model="remember" class="form-checkbox">
                        <span class="ml-2">Mantener sesión activa</span>
                    </label>
                </div>

                <div class="flex gap-4 flex-col items-center">
                    <x-button type="submit" class="py-2 !px-6 !w-full rounded tracking-widest">Iniciar Sesion</x-button>
                    <a href="{{route('register')}}" class="text-center text-xs hover:underline text-gray-500">¿NO TIENES CUENTA? <br> REGISTRATE</a>
                </div>
            </form>

            <div class="flex items-center justify-between mt-4">
                <span class="w-1/5 border-b border-gray-400 lg:w-1/4"></span>

                <a href="#" class="text-xs text-center text-gray-500 uppercase dark:text-gray-400 hover:underline">O inicia sesión con</a>

                <span class="w-1/5 border-b border-gray-400 lg:w-1/4"></span>
            </div>

            <a href="{{route('google-auth')}}" class="flex items-center justify-center mt-4 text-gray-700 border rounded-lg">
                <div class="px-4 py-2">
                    <svg class="w-6 h-6" viewBox="0 0 40 40">
                        <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.045 27.2142 24.3525 30 20 30C14.4775 30 10 25.5225 10 20C10 14.4775 14.4775 9.99999 20 9.99999C22.5492 9.99999 24.8683 10.9617 26.6342 12.5325L31.3483 7.81833C28.3717 5.04416 24.39 3.33333 20 3.33333C10.7958 3.33333 3.33335 10.7958 3.33335 20C3.33335 29.2042 10.7958 36.6667 20 36.6667C29.2042 36.6667 36.6667 29.2042 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#FFC107"/>
                        <path d="M5.25497 12.2425L10.7308 16.2583C12.2125 12.59 15.8008 9.99999 20 9.99999C22.5491 9.99999 24.8683 10.9617 26.6341 12.5325L31.3483 7.81833C28.3716 5.04416 24.39 3.33333 20 3.33333C13.5983 3.33333 8.04663 6.94749 5.25497 12.2425Z" fill="#FF3D00"/>
                        <path d="M20 36.6667C24.305 36.6667 28.2167 35.0192 31.1742 32.34L26.0159 27.975C24.3425 29.2425 22.2625 30 20 30C15.665 30 11.9842 27.2359 10.5975 23.3784L5.16254 27.5659C7.92087 32.9634 13.5225 36.6667 20 36.6667Z" fill="#4CAF50"/>
                        <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.7592 25.1975 27.56 26.805 26.0133 27.9758C26.0142 27.975 26.015 27.975 26.0158 27.9742L31.1742 32.3392C30.8092 32.6708 36.6667 28.3333 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#1976D2"/>
                    </svg>
                </div>

                <span class="w-5/6 px-4 py-3 font-semibold text-center">Inicia sesión con Google</span>
            </a>
        </div>

    </div>
</div>
