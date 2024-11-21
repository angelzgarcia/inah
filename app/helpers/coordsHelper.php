<?php

    use Illuminate\Support\Facades\Http;

    if (!function_exists('getCoordinates')) {
        function getCoordinates($address) {
            $addressString = is_array($address) ? implode(", ", $address) : $address;

            $apiKey = config('services.google_maps');
            $apiString = is_array($apiKey) ? implode(", ", $apiKey) : $apiKey;

            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($addressString)."&key={$apiString}&region=mx";

            $response = Http::get($url)->json();

            if (isset($response['status']) && $response['status'] == 'OK') {
                return [
                    'lat' => $response['results'][0]['geometry']['location']['lat'],
                    'lng' => $response['results'][0]['geometry']['location']['lng'],
                ];
            }

            return null;
        }
    }

    if (!function_exists('getAddress')) {
        function getAddress($lat, $lng) {
            $apiKey = config('services.google_maps');
            $apiString = is_array($apiKey) ? implode(", ", $apiKey) : $apiKey;

            $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$lng}&key={$apiString}";

            $response = Http::get($url)->json();

            if ($response['status'] == 'OK') {
                return $response['results'][0]['formatted_address'];
            }

            return null;
        }
    }
