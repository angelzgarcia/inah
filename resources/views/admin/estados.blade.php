
<x-admin-main title="Estados de la República Mexicana | Admin | INAH" :usarMap="true">

    @livewire('admin.estado-wire')

    @push('js')

        <x-toast name_event="est-event"/> {{-- SWEET ALERT TOAST --}}

        <x-toast-confirm
            {{-- text="Todas las culturas relacionadas a este estado tambien serán elimiandas." --}}
        /> {{-- SWEET ALERT CONMFIRM EVENT --}}

        {{-- init map --}}
        <script>
            Livewire.on('openModal', data => {
                setTimeout(() => {
                    initMap(data[0]);
                }, 200);
            });

            function initMap(data) {
                const estado = { lat: parseFloat(data.lat), lng: parseFloat(data.lng) };

                const mapaContenedor = document.getElementById('mapaEstado');

                const map = new google.maps.Map(mapaContenedor, {
                    zoom: 6,
                    center: estado,
                    mapTypeId: 'hybrid',
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU, // Muestra un menú desplegable
                    },
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

                new google.maps.Marker({
                    position: estado,
                    map: map,
                });

                google.maps.event.addListenerOnce(map, 'tilesloaded', () => {
                    google.maps.event.trigger(map, 'resize');
                });
            }

        </script>

    @endpush {{-- STACK JS ESTADOS --}}

</x-admin-main>
