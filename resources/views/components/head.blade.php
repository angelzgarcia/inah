
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('/img/downloads/favicon.ico') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{$src_maps ?? ''}}
    <title>
        {{$title ?? 'Zonas Arqueológicas de México'}}
    </title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
