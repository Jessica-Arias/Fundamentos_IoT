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
    if (isset($_POST["enviar"])) {
        echo "<h2> el usuario es ... </h2>";
        $u = $_POST["user_name"];
        $p = $_POST["password"];
        $url_rest = "http://localhost:3000/usuario/$u";
        $cur1 = curl_init($url_rest);
        curl_setopt($cur1, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($cur1);

        if ($respuesta === false) {
            curl_close($cur1);
            die("Error...");
        }

        curl_close($cur1);
        $resp = json_decode($respuesta);
        $tam = count($resp);

        if ($tam == 0) {
            header("Location: login.php");
        } else {
            $result = $resp[0];
            $pass = $result->password;
            $rol = $result->rol;
            $id_zona = $result->id_zona;

            if ($pass == $p) {
                session_start();
                $_SESSION['user_name'] = $u;
                $_SESSION['rol'] = $rol;
                $_SESSION['id_zona'] = $id_zona;

                if ($rol == "Admin") {
                    header("Location: admin.php");
                } else {
                    header("Location: cliente.php");
                }
            } else {
                header("Location: login.php");
            }
        }
    } else {

    ?>
    <form action="login.php" method="post">

        <section class="vh-100" style="background-color: #63A355;">
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
                                <a class="nav-link" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Iniciar Sesión</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="crearusuario.php">Crear Cuenta</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container py-5 h-92">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <h3 class="mb-5">Iniciar Sesión</h3>

                                <div class="form-outline mb-4">
                                    <input type="text" name="user_name" class="form-control form-control-lg" />
                                    <label class="form-label" name="user_name">User Name</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" name="password" class="form-control form-control-lg" />
                                    <label class="form-label" name="password">Password</label>
                                </div>

                                <input type="submit" class="btn btn-success btn-lg" name="enviar" value="Iniciar Sesión" />
                                <div class="text-center">
                                    <p>No se encuentra registrado? <a href="crearusuario.php">Crear Cuenta</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <?php } ?>
</body>