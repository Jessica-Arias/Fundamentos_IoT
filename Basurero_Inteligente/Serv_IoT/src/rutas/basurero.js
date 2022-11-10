const { Router } = require('express');
const router = Router();
const mysql = require('mysql');

// se crea la conexión a mysql
const connection = mysql.createPool({
    connectionLimit: 500,
    host: 'localhost',
    user: 'root',
    password: '', //el password de ingreso a mysql
    database: 'basurerodb',
    port: 3306
});
//function get en la ruta /datos, que trae todos los datos almacenados en la tabla
router.get('/basurero', (req, res) => {
    var json1 = {}; //variable para almacenar cada registro que se lea, en formato json
    var arreglo = []; //variable para almacenar todos los datos, en formato arreglo de json
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //si no se pudo conectar
        }
        else {
            console.log('Conexion correcta.');
            //ejecución de la consulta
            tempConn.query('SELECT * FROM basurero', function (error, result) {
                var resultado = result; //se almacena el resultado de la consulta en la variable resultado
                if (error) {
                    throw error;
                    res.send("error en la ejecución del query");
                } else {
                    tempConn.release(); //se librea la conexión
                    for (i = 0; i < resultado.length; i++) { //se lee el resultado y se arma el json
                        json1 = {
                            "id_basurero":resultado[i].id_basurero,
                            "altura": resultado[i].altura,
                            "estado": resultado[i].estado, 
                            "alerta": resultado[i].alerta,
                            "user_name": resultado[i].user_name,
                            "id_zona": resultado[i].id_zona
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

router.get('/basurero/:id', (req, res) => {
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
            tempConn.query('SELECT * FROM basurero WHERE id_basurero=?', [id],
            function (error, result) {
                var resultado = result; //se almacena el resultado de la  consulta en la variable resultado
                if (error) {
                    throw error;
                    res.send("error en la ejecución del query");
                } else {
                    tempConn.release(); //se librea la conexión
                    for (i = 0; i < resultado.length; i++) { //se lee el resultado y se arma el json
                        json1 = {
                            "altura": resultado[i].altura,
                            "estado": resultado[i].estado, 
                            "alerta": resultado[i].alerta,
                            "user_name": resultado[i].user_name,
                            "id_zona": resultado[i].id_zona

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

router.get('/basurero/u/:id', (req, res) => {
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
            tempConn.query('SELECT * FROM basurero WHERE user_name=?', [id],
            function (error, result) {
                var resultado = result; //se almacena el resultado de la  consulta en la variable resultado
                if (error) {
                    throw error;
                    res.send("error en la ejecución del query");
                } else {
                    tempConn.release(); //se librea la conexión
                    for (i = 0; i < resultado.length; i++) { //se lee el resultado y se arma el json
                        json1 = {
                            "id_basurero": resultado[i].id_basurero,
                            "altura": resultado[i].altura,
                            "estado": resultado[i].estado, 
                            "alerta": resultado[i].alerta,
                            "id_zona": resultado[i].id_zona

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
router.post('/basurero', (req, res) => {
    console.log(req.body); //mustra en consola el json que llego
    json1 = req.body; //se almacena el json recibido en la variable json1
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {
            console.log('Conexion correcta.');
            tempConn.query('INSERT INTO basurero VALUES(null, ?, ?,?,?,?)',
                [json1.altura, json1.estado, json1.alerta, json1.user_name, json1.id_zona], function
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
router.put('/basurero/:id', (req, res) => {
    var id = req.params.id; //recogemos el parámetro enviado en la url

    console.log(req.body); //mustra en consola el json que llego
    json1 = req.body; //se almacena el json recibido en la variable json1
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {
            console.log('Conexion correcta.');
            tempConn.query('UPDATE basurero set altura=?,estado=?, alerta=?,user_name=?, id_zona=? where id_basurero=?',
                [json1.altura, json1.estado, json1.alerta, json1.user_name, json1.id_zona, id], function
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
router.delete('/basurero/:id', (req, res) => {
    var id = req.params.id; //recogemos el parámetro enviado en la url

    console.log(req.body); //mustra en consola el json que llego
    json1 = req.body; //se almacena el json recibido en la variable json1
    connection.getConnection(function (error, tempConn) { //conexion a mysql
        if (error) {
            throw error; //en caso de error en la conexion
        }
        else {
            console.log('Conexion correcta.');
            tempConn.query('DELETE from basurero where id_basurero=?',
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