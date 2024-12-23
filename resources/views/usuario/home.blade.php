

<x-user-main title="Bienvenidos al INAH | Pagina principal">
    <div class="home-container">
        <div class="zonas-home">
            <h2>
                <a href="{{route('zonas')}}" wire:navigate>
                    Zonas arqueológicas
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
            </h2>
        </div>
        <div class="estados-home">
            <h2>
                <a href="{{route('estados')}}" wire:navigate>
                    Estados de la república
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
            </h2>
        </div>
        <div class="culturas-home">
            <h2>
                <a href="{{route('culturas')}}" wire:navigate>
                    Culturas de México
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
            </h2>
        </div>
    </div>
</x-user-main>
