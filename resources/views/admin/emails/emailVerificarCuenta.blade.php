


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Cuenta de Administrador</title>
    <style>

        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            background-color: #f3f4f6
        }

        .email-main {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-content: center;
            align-items: center;
            padding: 1em;
        }

        .content { background-color: #fff;  }
        .content-body { background-color: #fff;  }

        .logo {
            background-color: #611232;
        }
        .logo img { height: 150px; width: 100%; padding: 1em 0; }

        .welcome {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 0 4em;
        }
        .name {
            text-align: center;
            font-size: 2.4em;
        }

        .info {
            display: flex;
            flex-direction: column;
            color: #fff;
            background-color: #76143b;
            padding: 0 4em;
            margin: 1em 0 1em 0;
        }
        .info p {
            display: flex;
            justify-content: space-between;
        }
        .info p span {
            text-decoration: underline;
            letter-spacing: .2em;
        }

        .redirect-verify {
            display: flex;
            padding: 0 4em;
            align-content: center;
            align-items: center;
            flex-direction: column;
            justify-content: space-between;
        }

        .redirect-verify button {
            width: 30%;
            border: none;
            outline: none;
            background-color: #292335;
            border-radius: .6em;
            cursor: pointer;
            padding: .5em 1.5em;
            box-shadow: 0 .2em .2em 0 #808080ac;
        }
        .redirect-verify button:hover {
            opacity: .9;
        }
        .redirect-verify svg {
            width: 30px;
            fill: #fff;
        }
        .redirect-verify a {
            font-size: 1.5em;
            color: #fff;
            display: flex;
            text-align: center;
            justify-content: space-between;
            align-items: center;
            text-decoration: none;
            font-weight: bolder;
            width: 100%;
            letter-spacing: .1em;
        }
    </style>
</head>
<body>
    <main class="email-main">
        <section class="content">
            <div class="logo">
                <img src="https://www.inah.gob.mx/images/logos/logo_85.svg" alt="logo_85_inah">
            </div>

            <div class="content-body">
                <div class="welcome">
                    <h1 class="name">¡{{$saludo ?? 'Bienvenid@'}} al equipo, <strong>{{$nombre ?? 'Admin'}}</strong>!</h1>

                    <h2>Nos alegra que estés aquí.</h2>
                    <p>
                        Tu cuenta ha sido creada con éxito. <br>
                        A continuación, encontrarás tu contraseña temporal y tu token de verificación. Presiona <small><em>verificar</em></small> para continuar.
                    </p>
                </div>

                <div class="info">
                    <p>
                        <strong>Contraseña Temporal: </strong>
                        <span>{{ $password ?? 'a1b2c3d4e5f6' }}</span>
                    </p>
                    <p>
                        <strong>Token de Verificación:</strong>
                        <span>{{ $token ?? 'z9x8c8y7w6q5ñ3' }}</span>
                    </p>
                </div>

                <div class="redirect-verify">
                    <h3>Por favor, verifica tu cuenta utilizando el token.</h3>

                    <button>
                        <a href="http://inah.test/verify-admin-account">
                            Verificar
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                        </a>
                    </button>
                </div>
            </div>
        </section>

        <footer>

        </footer>
    </main>
</body>
</html>
