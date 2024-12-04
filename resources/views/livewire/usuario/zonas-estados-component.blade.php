

<div>

    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Zonas Arqueológicas de {{$estado->nombre}}</h1>

    <div id="map" class="rounded-xl w-full h-[600px]"></div>

    <section class="bg-gray-100 p-8">
        <!-- GRILLA -->
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-8">
            <!-- TARJETAS DE LAS zonas -->
            @foreach ($zonas as $zona)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105 cursor-pointer"
                    wire:click="mostrarZona({{$zona->idZonaArqueologica}})"
                >
                    <div class="h-40 bg-cover bg-center" style="background-image: url('{{img_u_url($zona->fotos->first()?->foto)}}');">
                    </div>
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800">{{$zona->nombre}}</h2>
                        <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{$zona->significado}}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <x-paginador :table="$zonas" />

    </section>

    {{-- MAPA --}}
    @php
        $zonasArray = $zonas->map(function ($zona) {
            return [
                'lat' => $zona->ubicacion->latitud,
                'lng' => $zona->ubicacion->longitud,
                'nombre' => $zona->nombre,
            ];
        })->toArray();
    @endphp
    @push('js')
        <script>
            function initMap() {
                const zonas = @json($zonasArray);

                const lat = {{$zonas->first()?->ubicacion->latitud ?? 0}};
                const lng = {{$zonas->first()?->ubicacion->longitud ?? 0}};

                const map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 7,
                    center: { lat: lat, lng: lng },
                    styles:[
                        {
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#f5f5f5"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.icon",
                            "stylers": [
                            {
                                "visibility": "off"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#616161"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#f5f5f5"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#bdbdbd"
                            }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#eeeeee"
                            }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#757575"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#e5e5e5"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#ffffff"
                            }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#757575"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#dadada"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#616161"
                            }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#e5e5e5"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.station",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#eeeeee"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#c9c9c9"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                            ]
                        }
                    ]
                });

                zonas.forEach(zona => {
                    const marker = new google.maps.Marker({
                        position: { lat: parseFloat(zona.lat), lng: parseFloat(zona.lng) },
                        map: map,
                        title: zona.nombre,
                        icon: {
                            url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
                            scaledSize: new google.maps.Size(20, 20),
                        },
                    });

                });
            }
        </script> {{-- FUNCION INIT MAP --}}
    @endpush

</div>
