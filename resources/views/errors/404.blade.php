<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página no encontrada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        h1 {
            font-size: 60px;
            color: #ff6b6b;
        }
        p {
            font-size: 20px;
        }
        a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Error 404</h1>
    <p>La página que buscas no existe o ha sido movida.</p>
    <a href="{{ url('/') }}">Regresar al inicio</a>
</body>
</html>
