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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/mdb.min.css">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/style.css">

</head>

<body style="background-color: #f4f5f7;">
    <?php
    session_start();
    $us = $_SESSION['user_name'];
    $rol = $_SESSION['rol'];

    if ($us == "") {
        header("Location: index.php");
    }

    $url_rest_get = "http://localhost:3000/basurero/u/$us";
    $cur1_get = curl_init($url_rest_get);
    curl_setopt($cur1_get, CURLOPT_RETURNTRANSFER, true);
    $respuesta_get = curl_exec($cur1_get);

    curl_close($cur1_get);
    $resp_get = json_decode($respuesta_get);

    $tam_get = count($resp_get);
    $tam_get2 = 0;

    if ($_GET) {

        $id = $_GET['id'];


        $url_rest_get2 = "http://localhost:3000/datos/b/$id";
        $cur1_get2 = curl_init($url_rest_get2);
        curl_setopt($cur1_get2, CURLOPT_RETURNTRANSFER, true);
        $respuesta_get2 = curl_exec($cur1_get2);

        curl_close($cur1_get2);
        $resp_get2 = json_decode($respuesta_get2);

        $tam_get2 = count($resp_get2);

    }

    ?>

    <section class="vh-100" style="background-color: #f4f5f7;">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E1EDE0; height: 8%;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                    data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarExample01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container py-5 h-92">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col col-lg-18 mb-6 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem; background-color: #267D39;">
                                <img src="https://i.pinimg.com/originals/f4/fa/fa/f4fafaf122d00f0775aa586b8a061d0b.png"
                                    lt="Avatar" class="img-fluid my-5" style="width: 300px;">
                                <?php echo "<h5> $us </h5>" ?>
                                <?php echo "<p> $rol </p>" ?>
                            </div>
                            <div class="col-md-8 h-80">
                                <h6>
                                    <?php$us?>
                                </h6>
                                <h5>Mis Basureros:</h5>
                                <div class="card text-center opacity-25" style="background: none; width: 95%;">
                                    <table class="table caption-top table-striped table-bordered table-sm">
                                        <thead style="background-color: #999999;">
                                            <tr>
                                                <td>ID Basurero</td>
                                                <td>Altura</td>
                                                <td>Estado</td>
                                                <td>Alerta</td>
                                                <td>ID Zona</td>
                                                <td>Acción</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php

                                                for ($i = 0; $i <= $tam_get - 1; $i++) {
                                                    $result = $resp_get[$i];
                                                    $id_basurero = $result->id_basurero;
                                                    $altura = $result->altura;
                                                    $estado = $result->estado;
                                                    $alerta = $result->alerta;
                                                    $id_zona = $result->id_zona;

                                                    echo "<tr>";
                                                    echo "<td>";
                                                    echo $id_basurero;
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $altura;
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $estado;
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $alerta;
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $id_zona;
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo "<a href=\"?id=" . $id_basurero . "\">Mostrar Datos</a>";
                                                    echo "</td>";
                                                    echo "</tr>";

                                                }


                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <h5>Datos:</h5>
                                <div class="card text-center opacity-25" style="background: none; width: 95%;">
                                    <table class="table caption-top table-striped table-bordered table-sm">
                                        <thead style="background-color: #999999;">
                                            <tr>
                                                <td>ID Datos</td>
                                                <td>Fecha</td>
                                                <td>Capacidad Usada</td>
                                                <td>ID Basurero</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php

                                                for ($i = 0; $i <= $tam_get2 - 1; $i++) {
                                                    $result2 = $resp_get2[$i];
                                                    $id_datos = $result2->id_datos;
                                                    $fecha = $result2->fecha;
                                                    $capacidad_usada = $result2->capacidad_usada;
                                                    $id_basurero = $result2->id_basurero;

                                                    echo "<tr>";
                                                    echo "<td>";
                                                    echo $id_datos;
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $fecha;
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $capacidad_usada;
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $id_basurero;
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>