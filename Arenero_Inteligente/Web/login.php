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


        $url_rest = "http://20.169.243.49:3000/usuario/$u";
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

                if ($rol == "admin") {
                    header("Location: admin.php");
                } else if($rol == "cliente") {
                    header("Location: cliente.php");
                }else{
                    header("Location: vendedor.php");
                }
            } else {
                header("Location: login.php");
            }
        }
    } else {

    ?>
    

        <section class="vh-100">
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #c3e9f7; height: 8%;">
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
            <div class="container py-4">
            <div class="row g-0 align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card cascading-right" style="
                    background: hsla(0, 0%, 100%, 0.55);
                    backdrop-filter: blur(30px);
                    ">
                <div class="card-body p-5 shadow-5 text-center">
                    <h2 class="fw-bold mb-5">Iniciar sesion</h2>
                    <form action="login.php" method="post">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="text" name="user_name" class="form-control" />
                        <label class="form-label" for="form3Example3">user_name</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password" class="form-control" />
                        <label class="form-label" for="form3Example4">Password</label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" name="enviar" class="btn btn-primary btn-block mb-4">
                        Iniciar
                    </button>

                    <!-- Register buttons -->
                    <div class="text-center">
                    <a href="crearusuario.php">Crear Usuario</a>
                    </div>
                    </form>
                </div>
                </div>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0"  style="
            height: 650px;">
            
                <img src="https://thumbs.dreamstime.com/b/one-most-beautiful-cat-pictures-vertical-head-portrait-proud-purebred-female-natural-background-136516541.jpg"  class="w-100 rounded-4 shadow-4"
                alt=""  style="
            height: 90%; "/>
            </div>
            </div>
        </div>
        </section>
    <?php } ?>
</body>