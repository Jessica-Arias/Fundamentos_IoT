<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
        crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    $us = $_SESSION['user_name'];
    $rol = $_SESSION['rol'];

    if ($us == "" || $rol != "admin") {
        header("Location: index.php");
    }

    $url_rest_get = "http://20.169.243.49:3000/arenero/";
    $cur1_get = curl_init($url_rest_get);
    curl_setopt($cur1_get, CURLOPT_RETURNTRANSFER, true);
    $respuesta_get = curl_exec($cur1_get);

    curl_close($cur1_get);
    $resp_get = json_decode($respuesta_get);

    $tam_get = count($resp_get);

    if ($_GET) {


        $id = $_GET['id'];

        $url_rest_del = "http://20.169.243.49:3000/arenero/$id";

        $curl_del = curl_init($url_rest_del);
        curl_setopt($curl_del, CURLOPT_CUSTOMREQUEST, "DELETE");
        $respuesta_del = curl_exec($curl_del);

        curl_close($curl_del);


        header("Location: eliminararenero.php");

    }

    ?>

    <form action="eliminararenero.php" method="post">
         <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #c3e9f7; height: 8%;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
                    aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarExample01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Admin</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  flex-row-reverse dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Usuarios
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="crearusuarioadmin.php">Crear</a></li>
                            <li><a class="dropdown-item" href="eliminarusuario.php">Eliminar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                            <a class="nav-link  flex-row-reverse dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Areneros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="creararenero.php">Crear</a></li>
                                <li><a class="dropdown-item" href="eliminararenero.php">Eliminar</a></li>
                            </ul>
                        </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  flex-row-reverse dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Datos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="creardatos.php">Crear</a></li>
                            <li><a class="dropdown-item" href="eliminardatos.php">Eliminar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  flex-row-reverse dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Zonas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="crearzona.php">Crear</a></li>
                            <li><a class="dropdown-item" href="eliminarzona.php">Eliminar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                            <a class="nav-link  flex-row-reverse dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Alertas
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="alertas.php">Ver datos</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="justify-content-center align-items-center" style="border-radius: .5rem; height: 80%;">
            <div class="card text-center opacity-25 col-auto" style="background: none;">
                <hr>
                <table class="table caption-top table-striped table-bordered table-sm">
                    <thead style="background-color: #999999;">
                        <tr>
                            <th>ID arenero</th>
                            <th>Estado</th>
                            <th>User_Name</th>
                            <th>ID Zona</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php

                            for ($i = 0; $i <= $tam_get - 1; $i++) {
                                $result = $resp_get[$i];
                                $id_arenero = $result->id_arenero;
                                $estado = $result->estado;
                                $user_name = $result->user_name;
                                $id_zona = $result->id_zona;

                                echo "<tr>";
                                echo "<td>";
                                echo $id_arenero;
                                echo "</td>";
                                echo "<td>";
                                echo $estado;
                                echo "</td>";
                                echo "<td>";
                                echo $user_name;
                                echo "</td>";
                                echo "<td>";
                                echo $id_zona;
                                echo "</td>";
                                echo "<td>";
                                echo "<a href=\"?id=" . $id_arenero . "\">Borrrar</a>";
                                echo "</td>";
                                echo "</tr>";


                            }

                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>

    </form>
</body>