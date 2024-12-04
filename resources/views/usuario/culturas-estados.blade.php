


<x-user-main :title="'Culturas de ' . $estado->nombre . ' | INAH'">
    @push('css')
        <style>
            .container {
                /* position: absolute; */
                /* top: 55%;
                left: 50%; */
                /* transform: translate(-50%, -50%); */
                width: 100%;
                min-height: 400px;
                background: #f5f5f5;
                /* box-shadow: 0 30px 50px #dbdbdb; */
            }

            .container .slide .item {
                width: 300px;
                height: 300px;
                position: absolute;
                left: 40px;
                /* top: 20%;
                left: 5%; */
                /* transform: translate(-50%, -50%); */
                border-radius: 10px;
                /* box-shadow: 0 30px 50px #505050; */
                background-position: 50% 50%;
                background-size: cover;
                display: inline-block;
                transition: 0.5s;
            }

            .slide .item:nth-child(1),
            .silde .item:nth-child(2) {
                top: 0;
                left: 0;
                transform: translate(0, 0);
                border-radius: 1em;
                width: 100%;
                height: 100%;
            }

            .silde .item:nth-child(3) {
                left: 50%;
            }

            .silde .item:nth-child(4) {
                left: calc(50% + 220px);
            }

            .silde .item:nth-child(5) {
                left: calc(50% + 440px);
            }

            .silde .item:nth-child(n+6) {
                left: calc(50% + 660px);

            }

            .item .content {
                position: absolute;
                top: 22%;
                right: 40px;
                /* left: 100px; */
                /* width: 300px; */
                text-align: left;
                color: #ffffff;
                /* transform: translate(0 -50%); */
                font-family: system-ui;
                display: none;
            }

            .slide .item:nth-child(1) .content {
                display: block;
                padding: .5em;
                /* margin-left: 700px; */
                width: 430px;
                /* height: 330px; */
            }

            .content {

                background: linear-gradient(135deg, rgba(197, 197, 197, 0.1), rgba(255, 255, 255, 0));
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border-radius: 1em;
                border: 1px solid rgba(255, 255, 255, 0.18);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
                /* height: max-content; */
                place-items: center;
            }

            .content .name {
                font-size: 3em;
                text-transform: uppercase;
                font-weight: bold;
                animation: animate 1s ease-in-out 1 forwards;
                text-align: center;
                text-shadow:
                    3px 3px 0px rgb(86, 83, 83),
                    -3px -3px 0px rgb(86, 83, 83),
                    -3px 3px 0px rgb(86, 83, 83),
                    3px -3px 0px rgb(86, 83, 83),
                    3px 0px 0px rgb(86, 83, 83),
                    0px 3px 0px rgb(86, 83, 83),
                    -3px 0px 0px rgb(86, 83, 83),
                    0px -3px 0px rgb(86, 83, 83);
            }

            .content .des {
                /* margin-top: 10px; */
                /* margin-bottom: 20px; */
                font-size: 14px;
                padding: 0 1em 1em 1em;
                animation: animate 1s ease-in-out 0.3s 1 forwards;
                text-align: center;
            }

            .content button {
                padding: 10px 20px;
                text-decoration: none;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                animation: animate 1s ease-in-out 0.6s 1 forwards;
                background: blueviolet;
                font-size: 15px;
                color: #fff;


            }

            .button .prev {
                background: #fff;
                font-size: 20px;
                height: 45px;
                width: 55px;
            }

            .button .next {
                background: #fff;
                font-size: 20px;
                height: 45px;
                width: 55px;
            }


            @keyframes animate {

                from {
                    opacity: 0;
                    transform: translate(0, 100px);
                    filter: blur(33px);
                }

                to {
                    opacity: 1;
                    transform: translate(0);
                    filter: blur(0);

                }
            }

            .button {
                width: 100%;
                text-align: center;
                position: absolute;
                bottom: 20px;
            }

            .button button {
                width: 40px;
                height: 35px;
                border-radius: 8px;
                border: none;
                cursor: pointer;
                margin: 0 5px;
                border: 1px solid #000;
                transition: 0.3s;
            }

            .button button:hover {
                background: #ababab;
                color: #fff;

            }

            .titulo {
                text-align: center;
                font-size: 40px;
                font-family: "Poppins", serif;
            }

            .titulo span {
                color: #840909;
                font-size: 12.em;
                font-weight: 900;
            }
        </style>
    @endpush

    @livewire('usuario.culturas-estados-component', ['idEstado' => $estado->idEstadoRepublica], key($estado->idEstadoRepublica))

</x-user-main>
