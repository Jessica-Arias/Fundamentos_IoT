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
    if (isset($_POST["enviar"])) {

        $u = $_POST["user_name"];
        $p = $_POST["password"];
        $r = $_POST["rol"];
        $z = $_POST["id_zona"];


        $url_rest = "http://20.169.243.49:3000/usuario";
        $data = array(
            "user_name" => $u,
            "password" => $p,
            "rol" => $r,
            "id_zona" => $z
        );
        $data_string = json_encode($data);
        $curl = curl_init($url_rest);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type:application/json',
                'Content-Length: ' . strlen($data_string)
            )
        );

        $result = curl_exec($curl);
        header("Location: admin.php");
    } else {



    ?>
     <section class=" vh-100" style="background-color: #f4f5f7;">
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
        <section class="text-center text-lg-start">
            <style>
                .cascading-right {
                margin-right: -50px;
                }

                @media (max-width: 991.98px) {
                .cascading-right {
                    margin-right: 0;
                }
                }
            </style>
            <div class="container py-4">
                <div class="row g-0 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card cascading-right" style="
                        background: hsla(0, 0%, 100%, 0.55);
                        backdrop-filter: blur(30px);
                        ">
                    <div class="card-body p-5 shadow-5 text-center">
                        <h2 class="fw-bold mb-5">Crear usuario</h2>
                        <form action="crearusuarioadmin.php" method="post">
                
                        <div class="form-outline mb-4">
                            <input type="text" name="user_name" class="form-control" />
                            <label class="form-label" for="form3Example3">User_name</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" name="password" class="form-control" />
                            <label class="form-label" for="form3Example4">Password</label>
                        </div>

                        <div class="form-outline mb-4">
                            <div class="input-group mb-0 form-outline flex-fill">
                                <label class="input-group-text form-label" name="rol">Rol</label>
                                <select class="select form-control-lg form-outline flex-fill mb-0"
                                    name="rol">
                                    <option selected>Seleccione...</option>
                                    <option value="admin">Administrador</option>
                                    <option value="cliente">Cliente</option>
                                    <option value="vendedor">Vendedor</option>
                                </select>
                            </div>-
                        </div>
                        <div class="form-outline mb-4">
                            <input type="text" name="id_zona" class="form-control" />
                            <label class="form-label" for="form3Example3">Id zona</label>
                        </div>

                        <button type="submit" name="enviar" class="btn btn-primary btn-block mb-4">
                            Registrar
                        </button>

                        <div class="text-center">
                        
                        </div>
                        </form>
                    </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0" style="
                height: 650px;">
                    <img src="https://images.unsplash.com/photo-1596662100219-5903f73416a3?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1yZWxhdGVkfDl8fHxlbnwwfHx8fA%3D%3D&w=1000&q=80" class="w-100 rounded-4 shadow-4"
                    alt="" style="
                height: 95%;"/>
                </div>
                </div>
            </div>
        </section>
    </section>
    <?php } ?>
</body>