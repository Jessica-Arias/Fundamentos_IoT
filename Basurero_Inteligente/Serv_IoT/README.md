Abrimos el cmd y nos ubicamos en la carpeta que acabamos de
crear, y ejecutamos el comando:
npm init –yes

Se instala la librería de MQTT que nos permitirá conectarnos a un bróker MQTT y realizar
publicaciones y subscripciones. Para esto usamos el comando
npm install mqtt --save

Se deben instalar los paquetes express y morgan con el siguiente comando:
npm i express morgan

Para lanzar el servidor y ejecutar el código desarrollado se debe ejecutar el siguiente comando:
node src/indexrest.js
