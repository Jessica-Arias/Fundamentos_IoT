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

     if ($us == "" || $rol != "admin") {
        header("Location: index.php");
     }

     $url_rest_get = "http://20.169.243.49:3000/datos/";
     $cur1_get = curl_init($url_rest_get);
     curl_setopt($cur1_get, CURLOPT_RETURNTRANSFER, true);
     $respuesta_get = curl_exec($cur1_get);

     curl_close($cur1_get);
     $resp_get = json_decode($respuesta_get);

     $tam_get = count($resp_get);

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

   <div class="container py-5 h-92">
      <div class="row justify-content-center align-items-center h-100">
         <div class="col col-lg-18 mb-6 mb-lg-0">
            <div class="card mb-3" style="border-radius: .5rem;">
               <div class="row g-0">
                  <div class="col-md-4 gradient-custom text-center text-white"
                     style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem; background-color: #36a899;">
                     <img src="https://www.sanboni.edu.co/onu/wp-content/uploads/avatar-mujer.png" lt="Avatar"
                        class="img-fluid my-5" style="width: 300px;">
                     <?php echo "<h5> $us </h5>" ?>
                     <?php echo "<p> $rol </p>" ?>
                  </div>
                  <div class="col-md-8 h-80">
                     <h6>
                        <?php$us?>
                     </h6>
                     <div class="card text-center opacity-25" style="background: none; width: 95%;">
                        <table class="table caption-top table-striped table-bordered table-sm">
                           <thead style="background-color: #999999;">
                              <tr>
                                 <th>ID</th>
                                 <th>Fecha</th>
                                 <th>ID arenero</th>
                                 <th>Nivel arena</th>
                                 <th>Peso arenero</th>
                                 <th>Peso residuos</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <?php

                                 for ($i = 0; $i <= $tam_get - 1; $i++) {
                                    $result = $resp_get[$i];
                                    $id_datos = $result->id_datos;
                                    $fecha = $result->fecha;$id_arenero = $result->id_arenero;
                                    $nivelarena = $result->nivelarena;
                                    $pesoarenero = $result->pesoarenero;
                                    $pesoresiduos = $result->pesoresiduos;

                                    echo "<tr>";
                                    echo "<td>";
                                    echo $id_datos;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $fecha;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $id_arenero;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $nivelarena;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $pesoarenero;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $pesoresiduos;
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