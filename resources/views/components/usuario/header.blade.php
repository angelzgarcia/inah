

<header class="header-users">
    <nav class="nav-users">
        <a href="{{route('home')}}"  wire:navigate>
            <img src="{{ img_d_url('logo_85.png') }}" alt="logo-85">
        </a>
        <div class="links-nav">
            <ul>
                <li>
                    <a href="{{route('mapa_estados.index')}}" wire:navigate class="{{request() -> routeIs('mapa_estados.index') ? 'active' : ''}}">
                        Mapa de Estados
                    </a>
                </li>
                <li>
                    <a href="{{route('mapa_zonas.index')}}" wire:navigate class="{{request() -> routeIs('mapa_zonas.index') ? 'active' : ''}}">
                        Mapa de Zonas
                    </a>
                </li>
                <li>
                    <a href="{{route('quizz')}}" wire:navigate class="{{request() -> routeIs('quizz') ? 'active' : ''}}">
                        Quizz
                    </a>
                </li>
                <li>
                    <a href="{{route('foro')}}" wire:navigate class="{{request() -> routeIs('foro') ? 'active' : ''}}">
                        Foro
                    </a>
                </li>
                <li>
                    <a href="{{route('nosotros.index')}}" wire:navigate class="{{request()->routeIs('nosotros.index') ? 'active' : ''}}">
                        Nosotros
                    </a>
                </li>
                <li>
                    <a href="{{route('contactanos')}}" wire:navigate class="{{request()->routeIs('contactanos') ? 'active' : ''}}">
                        Contactanos
                    </a>
                </li>
                <div class="circle-sesion-icon">
                    @auth
                        <a href="{{route('perfil')}}" wire:navigate class="shadow-sm shadow-black hover:shadow-md hover:shadow-zinc-700 hover:opacity-90 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
                        </a>
                    @endauth

                    @guest
                        <a href="{{route('login')}}" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z"/></svg>
                        </a>
                    @endguest
                </div>
            </ul>
        </div>
    </nav>
</header>
