# FASE DE DEFINICIÓN
## 1.1. Definición del contexto de aplicación y del problema a solucionar 
Según información de la firma Kantar World Panel, citada por MSD Salud Animal Colombia, afirma que de los 3,6 millones de hogares que tienen mascotas, uno de cada cuatro resulta ser un gato.

De estos animales se destaca según la AVEPA (Asociación de Veterinarios Especialistas en Pequeños Animales) su extremada limpieza e independencia, un ejemplo de esto es la capacidad que tienen de hacer sus necesidades desde cachorros en lugares seguros, arenosos y apartados de la comida. 

La anterior característica resulta llamativa e interesante para los tipos de dueño que diariamente se encuentran ocupados y son incapaces de otorgarle a la mascota todos los cuidados que requiera cualquier otro tipo de animal. Sin embargo el ser dueño de un gato requiere de ciertos cuidados o requerimientos; entre estos destaca la importancia de dejarles cada cosa en su lugar, puesto que el olfato de los gatos es uno de los más sensibles, razón por la cual sus espacios para alimentarse, orinar, jugar y descansar deben permanecer separados para evitar efectos contraproducentes en su salud.

Debido a su mencionada naturaleza, utilizan un espacio y objeto específico dentro de los hogares para hacer sus necesidades, una caja de arena que utilizan para ocultar olores. Esto causa una gran diferencia en comparación a otros animales que necesitan hacer sus necesidades en el exterior, haciendo que los dueños deban ocupar un cierto tiempo en la tarea de pasearlos.
Estas características de los gatos si bien resultan favorables para los dueños, no los dejan exentos de ciertas responsabilidades y el uso y mantenimiento de las cajas de arena puede ser problemático para algunos por el tiempo que les consume, la constancia que deben tener y los olores que se perciben. Por esta razón se logra evidenciar un problema para el tipo de dueño que le resulte difícil cambiar con constancia la arena de los gatos, que no sepa los momentos adecuados para realizar el proceso o simplemente quiera evitar los malos olores que esta genera al momento de limpiarla. A partir de esto, surge la pregunta ¿Existe alguna forma de garantizar la limpieza y el aseo de las cajas de arena de los gatos sin importar la disponibilidad que tenga el amo?

## 1.2. Planteamiento de una solución basada en IoT:
### 1.2.1. Identificación del Objeto: 
Teniendo en cuenta el contexto planteado y la pregunta problema generada, el objeto de aplicación para el proyecto de la asignatura Fundamentos de IoT es un arenero para gatos especial que permite que este realice las tareas de limpieza de manera autónoma recogiendo las heces del animal, según se requiera y alertando al usuario cuando este llegue a su capacidad máxima de desechos, o se encuentre con poca arena en su dispensador, brindando asistencia a los amos que se encuentren ocupados y garantizando un buen aseo en el felino.
### 1.2.2. Clasificación del objeto: 
El arenero será un objeto inteligente llamado “Smart LitterBox” de aproximadamente 50x30x25 cm, que se podrá tener dentro de los hogares que cuenten con un gato como mascota. Este se adecuará con sensores que le permitan conocer si este necesita ser limpiado y con actuadores que le permitan tomar acción para asear el terreno. 



## 1.3. Definición de las variables que deben ser censadas.

Para cumplir su función, se llegó a la conclusión de que el objeto sensara las siguientes variables:

Nivel de arena en el dispensador, lo que permite conocer si este se debe recargar al estar en bajo, alertando al usuario, de tal manera que evite que el objeto se quede sin arena, afectando su buen funcionamiento.

Peso de los residuos, para controlar la capacidad del lugar en donde los desechos del animal son depositados, evitando la acumulación excesiva de los mismos al alertar al usuario cuando sea pertinente realizar el cambio.

Peso del arenero, esta variable ayudará para dos funciones del objeto. En primer lugar detecta si el gato ha usado el arenero para hacer sus necesidades, estimando cuánto tiempo ha estado dentro del objeto. Y en segundo lugar sirve para conocer cuando el arenero cuenta con poca arena, lo que procura mantener el peso del arenero en un rango determinado.

Presencia del gato en el arenero, esta variable es importante para evitar que el objeto se active cuando el gato aún esté sobre él, evitando que el animal pueda salir lastimado o tenga reacciones negativas hacia el objeto. Esta variable se puede medir con varios métodos distintos, entre ellos, el mencionado anteriormente, el peso del arenero.


## 1.3. Definición del tipo de información que se debe presentar al usuario o usuarios de la aplicación. ¿Cuáles serían estos usuarios? 
Se definen dos tipos de usuarios para la aplicación, un usuario llamado cliente y el otro llamado vendedor.

El usuario cuidador podrá ver el nivel actual de la arena, la capacidad actual del almacenamiento de residuos y el estado de limpieza del arenero, además, de contar con la opción de activar manualmente la limpieza del arenero por medio de una instrucción en la aplicación. Por medio de esta aplicación también recibirá las alertas necesarias.

El usuario comerciante recibirá por su parte las estadísticas del volumen de arena gastada además de las veces que se llena el almacenamiento para tener información de cuando el cuidador necesitará más arena y poder proporcionar su nuevamente servicio de venta. 








# FASE DE ADQUISICIÓN DE DATOS

## 2.1. Identificación de los mecanismos que se usarán para sensar las variables definidas. Sensores seleccionados, características, comportamiento.

Sensor ultrasónico HC-SR04 para medir el nivel de arena en el dispensador.

ZC 133 de 1 Kg usado para medir el peso de las heces o desechos recolectados del gato.

ZC 133 de 20 Kg, usado para medir el peso de la arena, también se usa para detectar la presencia del gato ya que detectando el cambio abrupto de peso se puede detectar la presencia del gato, además de que el uso de este sensor puede tener doble uso.

Las celdas de carga YZC 133  de 1 Kg y  de 20 Kg permiten por medio de ellas saber el peso de un objeto o la presencia de un objeto midiendo la tensión aplicada a una superficie. Este barra de carga cuenta con cuatro cables que se pueden conectar al módulo conversor A/D HX711, este modulo conversor análogo a digital 24 Bits, es ampliamente utilizado en el acoplamiento entre las Celdas de Carga internamente se encarga de la lectura del puente Wheatstone formado por la celda de carga, convirtiendo la lectura analógica a digital con su conversor A/D interno de 24 Bits, entregando una lectura digital. El rango de valores varía dependiendo la celda que se utilice, si es la de 1 Kg el rango es de 0 a 1 Kg y la celda de 20 Kg es de 0 a 20 Kg. La unidad de medida es g o Kg.

El sensor HC-SR04 tiene un emisor piezoeléctrico que emite 8 pulsos de ultrasonido a 40KHz, luego de recibir la orden en el pin TRIG, las ondas de sonido viajan en el aire y rebota al encontrar un objeto, el sonido de rebote es detectado por el receptor piezoeléctrico, luego el pin ECHO cambia a Alto (5V) por un tiempo igual al que demoró la onda desde que fue emitida hasta que fue detectada, el tiempo del pulso ECO es medido por el microcontrolador y así se puede calcular la distancia al objeto.


## 2.2. Identificación de los areneros (nodos). 
Cada arenero contará con un microcontrolador, el cual realiza varias funciones, las cuales son; leer los datos de los sensores, voltaje de (0 a 5)V del sensor de ultrasonido y dos entradas digitales de los módulos HX711, el microcontrolador procesa esos datos y los convierte en a variables entendibles como centimetros para distancia para la variable de nivel y gramos y kilogramos para la de peso, mientras usa un protocolo de enlace para transmitir esos datos a un servidor o plataforma que los almacene.

Como es necesario que cada arenero tenga su propio microcontrolador para desarrollar las tareas anteriormente descritas, a cada microcontrolador se le asignará un número entero que lo identifique, y también se transmite esta identificación con los demás datos. 

## 2.2. Comparación de protocolos de enlace y selección de uno. 

![image](https://user-images.githubusercontent.com/115200711/201555894-c430b508-341d-4676-97d0-c3e1fa73e601.png)

Debido a los tipos de usuario a los que se dirige esta solución, personas ocupadas que tengan un hogar y un gato, se prevé que el dispositivo se encuentre en una casa, como se menciona en las características de los protocolos de enlace, el wifi es un protocolo casi omnipresente, por lo que se espera que cada persona a la que la solución se dirige tenga servicio de wifi en su hogar, al seleccionar este protocolo como la capa de enlace que usuran los areneros, podemos estar seguros de que un muy alto porcentaje de las personas que compran la caja de arena puedan conectar el dispositivo a una red wifi.


## 2.3. Selección y comparación de protocolos de capa de aplicación. 

MQTT: Surgió como protocolo de comunicación entre máquinas, por lo que posee características pensadas exclusivamente para este tipo de aplicaciones. Su modo de funcionamiento es a través de publicación/suscripción a un tópico, en el que publica o lee.

Sus mensajes son cortos, por lo que las transmisiones de datos también lo son y esto impacta en el consumo de energía de los nodos, algo crucial en dispositivos alimentados por baterías.


REST: Es una interfaz de aplicación (API) basada en HTTP, que es el protocolo utilizado para transferir datos en la World Wide Web y por lo tanto es natural que también sea utilizado para aplicaciones IoT. Su modo de funcionamiento es del tipo pregunta/respuesta – cliente/servidor.

Una de las ventajas de utilizar HTTP es su capacidad para enviar o recibir grandes cantidades de datos de manera eficiente. Si el nodo IoT envía imágenes, flujos de vídeo o archivos, es recomendable utilizar HTTP.

Se seleccionó MQTT como el protocolo de capa de aplicación, ya que, el dispositivo funciona con baterías como fuente de energía, consume menos energía en la transmisión de datos, al mandar mensajes más cortos que el protocolo REST.




## 2.3. Selección de una plataforma hardware.

La plataforma hardware escogida para recibir los datos de los sensores, generar
el json con la identificación del nodo, los datos censados y si es necesario la fecha y hora y 
transmitirlos es el microcontrolador esp32, ya que, además de permitir  la lectura y procesamiento de los censados, posee un módulo wifi que permite realizar una conexión  sencilla con una zona wifi para la transmisión de datos, agregando que es una tarjeta con muy buenas características teniendo en cuenta su relativo bajo precio.


# FASE DE PROCESAMIENTO Y ALMACENAMIENTO

Para el proyecto se utiliza una base de datos llamada proyecto, el cual consta de 5 tablas, en primer lugar, el usuario, que cuenta con user_name y contraseña, además con una tabla de zona, para reconocer el lugar donde se encuentra. Adicional a estas dos, se tiene una tabla de arenero, que cuenta con su id, el estado del mismos, su usuario y su zona. De igual forma se tiene la tabla de alerta, que tiene la alerta por falta de arena, por sobrepeso de residuous el estado y a que arenero pertenece. Por último, se tiene la tabla de datos, que tiene el id del basurero, la fecha y hora y la capacidad usada.

La relación entre las tablas y los datos que tiene cada una se pueden apreciar mejor en la siguiente figura:

![WhatsApp Image 2022-11-13 at 4 05 46 PM](https://user-images.githubusercontent.com/115200711/201556206-f96fa4a5-45c2-49fa-9e6b-75aadf9a64b1.jpeg)

La base de datos se desarrolla en una máquina virtual creada con Azure Students (ip pública = 20.169.243.49), dentro de la misma se crea el servidor remoto, de forma que se pueda acceder a la pághina web desde cualquier dispositivo si el servidor esta corriendo.
