

<x-user-main title="Estado X | INAH" :usarMapa="true">

    @livewire('usuario.estados.estados-show-component', ['idEstado' => $estado->idEstadoRepublica], key($estado->idEstadoRepublica))

    @push('js')
        <script>
            function initMap() {
                const estado = { lat: {{$estado->ubicacion->latitud}}, lng: {{$estado->ubicacion->longitud}} };

                const map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 6,
                    center: estado,
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

                const marker = new google.maps.Marker({
                    position: { lat: estado.lat, lng: estado.lng },
                    map: map,
                    title: estado.name,
                    icon: {
                        url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png", // Ruta del icono
                        scaledSize: new google.maps.Size(20, 20), // Ajusta el tamaño (ancho, alto)
                    },
                });
            }
        </script> {{-- FUNCION INIT MAP --}}
    @endpush

</x-user-main>
