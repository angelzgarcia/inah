
<?php

    if (!function_exists('sweetAlert')) {
        function sweetAlert($datos) {
            $titulo = json_encode($datos['Titulo']);
            $texto = json_encode($datos['Texto']);
            $tipo = json_encode($datos['Tipo']);

            if ($datos['Alerta'] == 'simple') {
                $alerta = '
                    <script>
                        Swal.fire({
                            position: "center",
                            title: '.$titulo.',
                            text: '.$texto.',
                            icon: '.$tipo.',
                            showConfirmButton: false,
                            timer: 2000,
                            width: 300
                        });
                    </script>
                ';
            } elseif ($datos['Alerta'] == 'siuu') {
                $alerta = '
                    <script>
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            iconColor: "white",
                            customClass: {
                                popup: "colored-toast",
                            },
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });

                        Toast.fire({
                            icon: '.$tipo.',
                            title: '.$titulo.',
                        });
                    </script>
                ';
            }

            return $alerta;
        }
    }
