var mqtt = require('mqtt');
var client = mqtt.connect('mqtt://localhost');

const { Router } = require('express');
const router = Router();
const mysql = require('mysql');

// se crea la conexion a mysql
const connection = mysql.createPool({
    connectionLimit: 500,
    host: 'localhost',
    user: 'root',
    password: '0115', //el password de ingreso a mysql
    database: 'proyecto',
    port: 3306
});
client.on('connect', function () {
    client.subscribe('topico1', function (err) {
        if (err) {
            console.log("error en la subscripcion")
        }
    })
});
client.on('message', function (topic, message) {
    // message is Buffer
    json1 = JSON.parse(message.toString());
    console.log(json1);
    //client.publish('topico2', 'mensaje recibido')

    var estado = "No hay alertas";
    var alerta_a = false;
    var alerta_r = false;

    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {

            tempConn.query('INSERT INTO datos VALUES(null, ?, ?,?,?,?)',

                [json1.fecha, json1.id_arenero, json1.nivelarena, json1.pesoarenero, json1.pesoresiduos], function
                (error, result) { //se ejecuta la inserción
                if (error) {
                } else {
                    tempConn.release();
                }
            });
        }
    });

    if (json1.nivelarena > 18) {
        alerta_a = true;
        estado = "Alerta activa";

    }

    if (json1.pesoresiduos > 100) {
        alerta_r = true;
        estado = "Alerta activa";

    } else if ((json1.pesoresiduos <= 100) && (json1.nivelarena <= 18)) {
        estado = "No hay alertas";
        alerta_a = false;
        alerta_r = false;

    } else if (json1.pesoresiduos <= 100) {
        alerta_r = false;
        estado = "Alerta activa";

    } else if (json1.nivelarena <= 18) {
        estado = "No hay alertas";
        alerta_a = false;


    }
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {
            tempConn.query('UPDATE alertas set alerta_arena=?,alerta_residuos=?, estado=? where id_arenero=?',
                [alerta_a, alerta_r, estado, json1.id_arenero], function
                (error, result) { //se ejecuta la inserción

            });
        }


    });

    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {
            tempConn.query('UPDATE arenero set estado=? where id_arenero=?',
                [estado, json1.id_arenero], function
                (error, result) { //se ejecuta la inserción

            });
        }


    });
});

//function get en la ruta /datos, que trae todos los datos almacenados en la tabla
router.get('/datos', (req, res) => {
    var json1 = {}; //variable para almacenar cada registro que se lea, en formato json
    var arreglo = []; //variable para almacenar todos los datos, en formato arreglo de json
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //si no se pudo conectar
        }
        else {
            console.log('Conexion correcta.');
            //ejecuciÃ³n de la consulta
            tempConn.query('SELECT * FROM datos', function (error, result) {
                var resultado = result; //se almacena el resultado de la consulta en la variable resultado
                if (error) {
                    throw error;
                    res.send("error en la ejecuciÃ³n del query");
                } else {
                    tempConn.release(); //se librea la conexiÃ³n
                    for (i = 0; i < resultado.length; i++) { //se lee el resultado y se arma el json
                        json1 = {
                            "id_datos": resultado[i].id_datos,
                            "fecha": resultado[i].fecha,
                            "id_arenero": resultado[i].id_arenero,
                            "nivelarena": resultado[i].nivelarena,
                            "pesoarenero": resultado[i].pesoarenero,
                            "pesoresiduos": resultado[i].pesoresiduos
                        };
                        console.log(json1); //se muestra el json en la consola
                        arreglo.push(json1); //se aÃ±ade el json al arreglo
                    }
                    res.json(arreglo); //se retorna el arreglo

                }
            });
        }
    });
});

router.get('/datos/:id', (req, res) => {
    var json1 = {}; //variable para almacenar cada registro que se lea, en formato json
    var arreglo = []; //variable para almacenar todos los datos, en formato arreglo de json
    var id = req.params.id; //recogemos el parÃ¡metro enviado en la url
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //si no se pudo conectar
        }
        else {
            console.log('Conexion correcta.');
            //ejecuciÃ³n de la consulta
            tempConn.query('SELECT * FROM datos WHERE id_datos=?', [id],
                function (error, result) {
                    var resultado = result; //se almacena el resultado de la  consulta en la variable resultado
                    if (error) {
                        throw error;
                        res.send("error en la ejecuciÃ³n del query");
                    } else {
                        tempConn.release(); //se librea la conexiÃ³n
                        for (i = 0; i < resultado.length; i++) { //se lee el resultado y se arma el json
                            json1 = {
                                "fecha": resultado[i].fecha,
                                "id_arenero": resultado[i].id_arenero,
                                "nivelarena": resultado[i].nivelarena,
                                "pesoarenero": resultado[i].pesoarenero,
                                "pesoresiduos": resultado[i].pesoresiduos

                            };
                            console.log(json1); //se muestra el json en la consola
                            arreglo.push(json1); //se aÃ±ade el json al arreglo
                        }
                        res.json(arreglo); //se retorna el arreglo
                    }
                });
        }
    });
});

router.get('/datos/a/:id', (req, res) => {
    var json1 = {}; //variable para almacenar cada registro que se lea, en formato json
    var arreglo = []; //variable para almacenar todos los datos, en formato arreglo de json
    var id = req.params.id; //recogemos el parÃ¡metro enviado en la url
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //si no se pudo conectar
        }
        else {
            console.log('Conexion correcta.');
            //ejecuciÃ³n de la consulta
            tempConn.query('SELECT * FROM datos WHERE id_arenero=?', [id],
                function (error, result) {
                    var resultado = result; //se almacena el resultado de la  consulta en la variable resultado
                    if (error) {
                        throw error;
                        res.send("error en la ejecuciÃ³n del query");
                    } else {
                        tempConn.release(); //se librea la conexiÃ³n
                        for (i = 0; i < resultado.length; i++) { //se lee el resultado y se arma el json
                            json1 = {
                                "id_datos": resultado[i].id_datos,
                                "fecha": resultado[i].fecha,
                                "id_arenero": resultado[i].id_arenero,
                                "nivelarena": resultado[i].nivelarena,
                                "pesoarenero": resultado[i].pesoarenero,
                                "pesoresiduos": resultado[i].pesoresiduos

                            };
                            console.log(json1); //se muestra el json en la consola
                            arreglo.push(json1); //se aÃ±ade el json al arreglo
                        }
                        res.json(arreglo); //se retorna el arreglo
                    }
                });
        }
    });
});

//funcion post en la ruta /datos que recibe datos
router.post('/datos', (req, res) => {
    console.log(req.body); //mustra en consola el json que llego
    json1 = req.body; //se almacena el json recibido en la variable json1

    var estado = "No hay alertas";
    var alerta_a = false;
    var alerta_r = false;

    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {

            tempConn.query('INSERT INTO datos VALUES(null, ?, ?,?,?,?)',

                [json1.fecha, json1.id_arenero, json1.nivelarena, json1.pesoarenero, json1.pesoresiduos], function
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

    if (json1.nivelarena > 18) {
        alerta_a = true;
        estado = "Alerta activa";
    }

    if (json1.pesoresiduos > 100) {
        alerta_r = true;
        estado = "Alerta activa";

    } else if ((json1.pesoresiduos <= 100) && (json1.nivelarena <= 18)) {
        estado = "No hay alertas";
        alerta_a = false;
        alerta_r = false;

    } else if (json1.pesoresiduos <= 100) {
        alerta_r = false;
        estado = "Alerta activa";

    } else if (json1.nivelarena <= 18) {
        estado = "No hay alertas";
        alerta_a = false;
        
    }
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {
            tempConn.query('UPDATE alertas set alerta_arena=?,alerta_residuos=?, estado=? where id_arenero=?',
                [alerta_a, alerta_r, estado, json1.id_arenero], function
                (error, result) { //se ejecuta la inserción

            });
        }


    });
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {
            tempConn.query('UPDATE arenero set estado=? where id_arenero=?',
                [estado, json1.id_arenero], function
                (error, result) { //se ejecuta la inserción

            });
        }


    });
});

router.put('/datos/:id', (req, res) => {
    var id = req.params.id; //recogemos el parÃ¡metro enviado en la url

    console.log(req.body); //mustra en consola el json que llego
    json1 = req.body; //se almacena el json recibido en la variable json1
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {
            console.log('Conexion correcta.');
            tempConn.query('UPDATE datos set fecha=?, id_arenero=?, nivelarena=?, pesoarenero=?, pesoresiduos=? where id_datos=?',
                [json1.fecha, json1.id_arenero, json1.nivelarena, json1.pesoarenero, json1.pesoresiduos, id], function
                (error, result) { //se ejecuta la inserciÃ³n
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
router.delete('/datos/:id', (req, res) => {
    var id = req.params.id; //recogemos el parÃ¡metro enviado en la url

    console.log(req.body); //mustra en consola el json que llego
    json1 = req.body; //se almacena el json recibido en la variable json1
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {
            console.log('Conexion correcta.');
            tempConn.query('DELETE from datos where id_datos=?',
                [id], function
                (error, result) { //se ejecuta la inserciÃ³n
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