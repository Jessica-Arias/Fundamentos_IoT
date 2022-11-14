const { Router } = require('express');
const router = Router();
const mysql = require('mysql');

// se crea la conexión a mysql
const connection = mysql.createPool({
    connectionLimit: 500,
    host: 'localhost',
    user: 'root',
    password: '', //el password de ingreso a mysql
    database: 'proyecto',
    port: 3306
});
//function get en la ruta /datos, que trae todos los datos almacenados en la tabla
router.get('/alertas', (req, res) => {
    var json1 = {}; //variable para almacenar cada registro que se lea, en formato json
    var arreglo = []; //variable para almacenar todos los datos, en formato arreglo de json
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //si no se pudo conectar
        }
        else {
            console.log('Conexion correcta.');
            //ejecución de la consulta
            tempConn.query('SELECT * FROM alertas', function (error, result) {
                var resultado = result; //se almacena el resultado de la consulta en la variable resultado
                if (error) {
                    throw error;
                    res.send("error en la ejecución del query");
                } else {
                    tempConn.release(); //se librea la conexión
                    for (i = 0; i < resultado.length; i++) { //se lee el resultado y se arma el json
                        json1 = {
                            "alerta_arena": resultado[i].alerta_arena,
                            "alerta_residuos": resultado[i].alerta_residuos,
                            "estado": resultado[i].estado,
                            "id_arenero":resultado[i].id_arenero
                        };
                        console.log(json1); //se muestra el json en la consola
                        arreglo.push(json1); //se añade el json al arreglo
                    }
                    res.json(arreglo); //se retorna el arreglo
                }
            });
        }
    });
});



router.get('/alertas/a/:id', (req, res) => {
    var json1 = {}; //variable para almacenar cada registro que se lea, en formato json
    var arreglo = []; //variable para almacenar todos los datos, en formato arreglo de json
    var id = req.params.id; //recogemos el parámetro enviado en la url
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //si no se pudo conectar
        }
        else {
            console.log('Conexion correcta.');
            //ejecución de la consulta
            tempConn.query('SELECT * FROM alertas WHERE id_arenero=?', [id],
                function (error, result) {
                    var resultado = result; //se almacena el resultado de la  consulta en la variable resultado
                    if (error) {
                        throw error;
                        res.send("error en la ejecución del query");
                    } else {
                        tempConn.release(); //se librea la conexión
                        for (i = 0; i < resultado.length; i++) { //se lee el resultado y se arma el json
                            json1 = {
                                "alerta_arena": resultado[i].alerta_arena,
                                "alerta_residuos": resultado[i].alerta_residuos,
                                "estado": resultado[i].estado,
                                "id_arenero":resultado[i].id_arenero

                            };
                            console.log(json1); //se muestra el json en la consola
                            arreglo.push(json1); //se añade el json al arreglo
                        }
                        res.json(arreglo); //se retorna el arreglo
                    }
                });
        }
    });
});



router.get('/alertas/:id', (req, res) => {
    var json1 = {}; //variable para almacenar cada registro que se lea, en formato json
    var arreglo = []; //variable para almacenar todos los datos, en formato arreglo de json
    var id = req.params.id; //recogemos el parámetro enviado en la url
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //si no se pudo conectar
        }
        else {
            console.log('Conexion correcta.');
            //ejecución de la consulta
            tempConn.query('SELECT * FROM alertas WHERE id_arenero=?', [id],
            function (error, result) {
                var resultado = result; //se almacena el resultado de la  consulta en la variable resultado
                if (error) {
                    throw error;
                    res.send("error en la ejecución del query");
                } else {
                    tempConn.release(); //se librea la conexión
                    for (i = 0; i < resultado.length; i++) { //se lee el resultado y se arma el json
                        json1 = {
                            "alerta_arena": resultado[i].alerta_arena,
                            "alerta_residuos": resultado[i].alerta_residuos,
                            "estado": resultado[i].estado,
                            "id_arenero":resultado[i].id_arenero
                        };
                        console.log(json1); //se muestra el json en la consola
                        arreglo.push(json1); //se añade el json al arreglo
                    }
                    res.json(arreglo); //se retorna el arreglo
                }
            });
        }
    });
});

//función post en la ruta /datos que recibe datos
router.post('/alertas', (req, res) => {
    console.log(req.body); //mustra en consola el json que llego
    json1 = req.body; //se almacena el json recibido en la variable json1
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {
            console.log('Conexion correcta.');
            tempConn.query('INSERT INTO alertas VALUES( ?,?,?,null)',
                [json1.alerta_arena,json1.alerta_residuos, json1.estado], function
                (error, result) { //se ejecuta la inserción
                if (error) {
                    res.send("error al ejecutar el query");
                } else {
                    tempConn.release();
                    res.send("datos almacenados"); //mensaje de respuesta
                }
            });
        }
    });
});
router.put('/alertas/:id', (req, res) => {
    var id = req.params.id; //recogemos el parámetro enviado en la url

    console.log(req.body); //mustra en consola el json que llego
    json1 = req.body; //se almacena el json recibido en la variable json1
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {
            console.log('Conexion correcta.');
            tempConn.query('UPDATE alertas set alerta_arena=?,alerta_residuos=?, estado=? where id_arenero=?',
                [json1.alerta_arena,json1.alerta_residuos, json1.estado, id], function
                (error, result) { //se ejecuta la inserción
                if (error) {
                    res.send("error al ejecutar el query");
                } else {
                    tempConn.release();
                    res.send("datos actualizados"); //mensaje de respuesta
                }
            });
        }
    });
});
router.delete('/alertas/:id', (req, res) => {
    var id = req.params.id; //recogemos el parámetro enviado en la url

    console.log(req.body); //mustra en consola el json que llego
    json1 = req.body; //se almacena el json recibido en la variable json1
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {
            console.log('Conexion correcta.');
            tempConn.query('DELETE from alertas where id_arenero=?',
                [id], function
                (error, result) { //se ejecuta la inserción
                if (error) {
                    res.send("error al ejecutar el query");
                } else {
                    tempConn.release();
                    res.send("datos borrados"); //mensaje de respuesta
                }
            });
        }
    });
});
module.exports = router;
