


    <div>

        {{-- banner --}}
        <div class="w-full h-[515px] text-center flex justify-center items-center bg-cover bg-fixed rounded-lg bg-center"
            style="background-image: linear-gradient(rgba(0, 0, 0, 0.300), rgba(0, 0, 0, 0.237)), url({{img_u_url($estado->foto)}})"
        >
            <h1 class="text-4xl uppercase font-black tracking-widest underline text-white [text-shadow:_0_1px_5px_rgb(0_0_0_/_40%)] decoration-[goldenrod]">{{$estado->nombre}}</h1>
        </div>

        <div class="mt-10 flex flex-col gap-2">
            {{-- clima --}}
            @if(isset($clima['error']))
                <p class="text-red-500">Error: {{ $clima['error'] }}</p>
            @else
                <section class="weather-card flex justify-between items-center px-10 py-2">
                    {{-- temperatura y descripcion --}}
                    <div id="caja1">
                        <h1 id="temperatura-valor" class="text-4xl tracking-wider font-black">{{ $clima['main']['temp'] ?? 'N/A' }}°C</h1>
                    </div>
                    {{-- nombre del estado e icono representatibo del clima --}}
                    <div id="caja2">
                        <h2 id="ubicacion">{{ $estado->nombre }}</h2>
                        <img id="icono-animado" src="http://openweathermap.org/img/wn/{{ $clima['weather'][0]['icon'] ?? '01d' }}@2x.png" alt="Icono clima" height="128" width="128">
                        <h2 id="temperatura-descripcion">{{ $clima['weather'][0]['description'] ?? 'Sin información' }}</h2>
                    </div>
                    {{-- medicion del viento --}}
                    <div id="caja3">
                        <h3>Velocidad del viento</h3>
                        <h1 id="viento-velocidad">{{ $clima['wind']['speed'] ?? 'N/A' }} km/h</h1>
                    </div>
                </section>
            @endif

            {{-- mapa --}}
            <div id="map" class="rounded-xl w-full h-[600px]"></div>
        </div>

        {{-- culturas, zonas y detalles --}}
        <div class="flex justify-around mt-10">
            {{-- zonas --}}
            <div class="w-56 h-56 bg-cover cursor-pointer rounded-full bg-center flex justify-center items-end overflow-hidden group shadow-lg hover:hue-rotate-180"
                style="background-image: url({{img_d_url('julie-sd-Ae3iebFg524-unsplash.jpg')}})"
                wire:click="mostrarCulturas()"
            >
                <h2 class="text-white font-bold tracking-wider bg-[#3c3c3e83] p-4 pt-2 uppercase w-full rounded-lg text-center h-1/3 flex items-center justify-center group-hover:bg-[#3c3c3e9e]">Culturas</h2>
            </div>

            {{-- culturas --}}
            <div class="w-56 h-56 bg-cover cursor-pointer rounded-full bg-center flex justify-center items-end overflow-hidden group shadow-lg hover:hue-rotate-180"
                style="background-image: url({{img_d_url('marv-watson-UfK0P6WygEE-unsplash.jpg')}})"
                wire:click="mostrarZonas()"
            >
                <h2 class="text-white font-bold tracking-wider bg-[#3c3c3e83] p-4 pt-2 uppercase w-full rounded-lg text-center h-2/5  group-hover:bg-[#3c3c3e9e]">Zonas arqueológicas</h2>
            </div>

            {{-- conocer más del estado --}}
            <div class="w-56 h-56 bg-cover cursor-pointer rounded-full bg-center flex justify-center items-end overflow-hidden group shadow-lg hover:hue-rotate-180"
                style="background-image: url({{img_d_url('mexico-icon-512x384-tng9bcfk.png')}})"
                wire:click="mostrarDetalles()"
            >
                <h2 class="text-white font-bold tracking-wider bg-[#3c3c3e83] p-4 pt-2 uppercase w-full rounded-lg text-center h-1/3 flex items-center justify-center group-hover:bg-[#3c3c3e9e]">Conocer más</h2>
            </div>
        </div>

    </div>
