

<x-user-main title="Estados de la República Mexicana" :usarMapa="true">

    @livewire('usuario.estados.estados-component')

    @push('js')
        <script>
            function initMap() {
                const mexico = { lat: 23.6345, lng: -102.5528 };

                const map = new google.maps.Map(document.getElementById('mapEstados'), {
                    zoom: 5,
                    center: mexico,
                    styles: [
                        {
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#ebe3cd"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#523735"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#f5f1e6"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#c9b2a6"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#dcd2be"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#ae9e90"
                            }
                            ]
                        },
                        {
                            "featureType": "landscape.natural",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#93817c"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry.fill",
                            "stylers": [
                            {
                                "color": "#a5b076"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#447530"
                            }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#f5f1e6"
                            }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#fdfcf8"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#f8c967"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#e9bc62"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway.controlled_access",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#e98d58"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway.controlled_access",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#db8555"
                            }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#806b63"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#8f7d77"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#ebe3cd"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.station",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry.fill",
                            "stylers": [
                            {
                                "color": "#b9d3c2"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#92998d"
                            }
                            ]
                        }
                    ]
                });

                const estados = [
                    { name: 'Aguascalientes', lat: 21.8823, lng: -102.2826 },
                    { name: 'Baja California', lat: 32.7157, lng: -115.4550 },
                    { name: 'Baja California Sur', lat: 24.1444, lng: -110.3005 },
                    { name: 'Campeche', lat: 19.8301, lng: -90.5349 },
                    { name: 'Chiapas', lat: 16.7569, lng: -93.1292 },
                    { name: 'Chihuahua', lat: 28.6320, lng: -106.0691 },
                    { name: 'Ciudad de México', lat: 19.4326, lng: -99.1332 },
                    { name: 'Coahuila', lat: 27.0587, lng: -101.7068 },
                    { name: 'Colima', lat: 19.2452, lng: -103.7250 },
                    { name: 'Durango', lat: 24.0277, lng: -104.6532 },
                    { name: 'Guanajuato', lat: 21.0190, lng: -101.2574 },
                    { name: 'Guerrero', lat: 17.4392, lng: -99.5451 },
                    { name: 'Hidalgo', lat: 20.0911, lng: -98.7624 },
                    { name: 'Jalisco', lat: 20.6597, lng: -103.3496 },
                    { name: 'México', lat: 19.3587, lng: -99.6640 },
                    { name: 'Michoacán', lat: 19.5665, lng: -101.7068 },
                    { name: 'Morelos', lat: 18.6813, lng: -99.1013 },
                    { name: 'Nayarit', lat: 21.7514, lng: -104.8455 },
                    { name: 'Nuevo León', lat: 25.6866, lng: -100.3161 },
                    { name: 'Oaxaca', lat: 17.0732, lng: -96.7266 },
                    { name: 'Puebla', lat: 19.0413, lng: -98.2062 },
                    { name: 'Querétaro', lat: 20.5888, lng: -100.3899 },
                    { name: 'Quintana Roo', lat: 19.1817, lng: -88.4791 },
                    { name: 'San Luis Potosí', lat: 22.1565, lng: -100.9855 },
                    { name: 'Sinaloa', lat: 24.8091, lng: -107.3940 },
                    { name: 'Sonora', lat: 29.0729, lng: -110.9559 },
                    { name: 'Tabasco', lat: 17.8409, lng: -92.6189 },
                    { name: 'Tamaulipas', lat: 24.2669, lng: -98.8363 },
                    { name: 'Tlaxcala', lat: 19.3182, lng: -98.2375 },
                    { name: 'Veracruz', lat: 19.1738, lng: -96.1342 },
                    { name: 'Yucatán', lat: 20.7099, lng: -89.0943 },
                    { name: 'Zacatecas', lat: 22.7709, lng: -102.5832 }
                ];

                estados.forEach(estado => {
                    const marker = new google.maps.Marker({
                        position: { lat: estado.lat, lng: estado.lng },
                        map: map,
                        title: estado.name,
                        icon: {
                            url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
                            scaledSize: new google.maps.Size(20, 20),
                        },
                    });
                });
            }
        </script> {{-- GOOGLE MAP --}}
    @endpush {{-- STACK JS ESTADOS --}}

</x-user-main>
