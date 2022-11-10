# Basurero Inteligente:

Los datos serán tomados de dos sensores: presencia del
usuario, el cual se toma con un sensor infrarrojo, y capacidad
usada del basurero, el cual se mide con un sensor de proximidad
ubicado en la tapa superior del mismo; los datos que serán
enviados al servidor será la capacidad usada del basurero, junto
con la fecha y hora, para esto se pondrá la altura inicial del
basurero, para realizar un procedimiento de porcentualizar la
resta entre la altura inicial y la distancia entregada por el sensor
de proximidad.

Los datos serán enviados cuando la lectura de la presencia
del usuario sea de 1, lo cual significará que el usuario está
depositando la basura, por lo que el nivel estará actualizado, se
decide enviar solo en este momento, pues el resto del tiempo el
nivel no tiene por qué cambiar, por lo que permanecerá en el
valor anterior.

La alerta se generará cuando la capacidad usada del basurero
sobrepasé el 75% del mismo, pasando a un estado de alerta
amarilla, permaneciendo usable. Cuando se sobrepasé el 90% de
la capacidad, se cambiará a una alerta roja, donde el usuario
deberá atender de manera más inmediata la misma, una vez en
esta alerta, el basurero pasará de estado usable a estado inusable.

![image](https://user-images.githubusercontent.com/115200711/200975606-a2e29082-df7d-43cc-b204-6eb1e2d5902c.png)

# Estructura Tablas MySql (Database: basurerodb)

Para el proyecto se utiliza una base de datos llamada
basurerodb, el cual consta de 4 tablas, en primer lugar, el usuario,
que cuenta con user_name y contraseña, además con una tabla
de zona, para reconocer el lugar donde se encuentra. Adicional
a estas dos, se tiene una tabla de basurero, que cuenta con su id,
la altura del mismos, el estado, alerta, su usuario y su zona. Por
último, se tiene la tabla de datos, que tiene el id del basurero, la
fecha y hora y la capacidad usada.

La relación entre las tablas y los datos que tiene cada una se
pueden apreciar mejor en la siguiente figura:

![Parcial3_Diseño_BaseDeDatos drawio (3)](https://user-images.githubusercontent.com/115200711/200976149-cb6ebf8e-f0f9-411d-8f48-1d38eea9d98f.png)

# Página Web.

Para correr la página web, se usó XAMPP, para esto se activa apache y la carpeta de
página web se introduce en la ruta "C:\xampp\htdocs" luego en el navegador se
abre localhost/pagina_web/index.php

Las páginas cuentan con sesiones, lo que les da un nivel de seguridad, no se puede ingresar
a páginas adicionales si no se ha inicido sesión.
