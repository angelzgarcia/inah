

<div>

    <div class="flex flex-col justify-center text-center gap-8">

        {{-- titulo --}}
        <h1 class="h1u text-4xl font-black uppercase tracking-wider">
            Estados de la República Mexicana
        </h1>

        {{-- mapa de estados --}}
        <section class="w-full flex my-2 justify-center items-center" style="height: 67vh">
            <div id="mapEstados" class="h-full rounded-xl shadow-lg" style="width: 95vw;"></div>
        </section>

        {{-- contenedor de estados --}}
        <div class="estados-container">
            <div class="grid-estados">
                {{-- listado de estados --}}
                @foreach ($estados as $estado)
                    <!-- tarjeta de estado -->
                    <div class="card-estado">
                        {{-- imagen --}}
                        <img src="{{img_u_url($estado->foto)}}" alt="{{$estado->foto}}" />
                        {{-- nombre, leyenda y acceso --}}
                        <div class="estado-content">
                            <div class="name-legend relative flex flex-col justify-between gap-6">
                                <h2 class="font-bold text-3xl capitalize">
                                    {{$estado->nombre}}
                                </h2>
                            </div>
                            <p class="block">
                                Descubre las fascinantes zonas arqueológicas de <small><strong>{{$estado->nombre}} - {{$estado->capital}}</strong></small>, hogar de antiguas civilizaciones.
                            </p>
                            <div>
                                <x-button tipo="go" class="!font-bold">
                                    Explorar
                                </x-button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- paginador --}}
            <div class="paginator">
                {{$estados -> links()}}
            </div>
        </div>

    </div>

</div>
