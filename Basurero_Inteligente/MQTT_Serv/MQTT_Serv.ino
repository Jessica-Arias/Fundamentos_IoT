#include <ArduinoJson.h>
#include <PubSubClient.h>
#include <WiFi.h>

#include <DFRobot_HX711.h>
#include <Time.h>
#include <TimeLib.h>

const int EchoPin = 33;
const int TriggerPin = 25;

time_t fecha;

DFRobot_HX711 MyScale1(14, 12);
DFRobot_HX711 MyScale2(26, 27);

const char* ssid = "iPhone de Samantha"; //El SSID de la red wifi a la que se conectará
const char* password = "samantha04"; //El password para conectarse a la red inalambrica

#define mqttUser ""
#define mqttPass ""
#define mqttPort 1883

char mqttBroker[] = "172.20.10.2";
char mqttClientId[] = "esp32-J"; //puede ser cualquier nombre
char inTopic[] = "topico1";

//función que se ejecuta cuando llega un mensaje en caso de subscribirse a un tópico
void callback(char* topic, byte* payload, unsigned int length) {
  Serial.print("Message arrived [");
  Serial.print(topic);
  Serial.print("] ");
  for (int i=0;i<length;i++) {
    Serial.print((char)payload[i]);
  }
  Serial.println();
}

WiFiClient BClient;
PubSubClient client(BClient);

void reconnect() {
  // Este ciclo se ejecuta mientras esté conectado al broker
  while (!client.connected()) {
  Serial.print("Attempting MQTT connection...");
  // Intenta conectarse
    if (client.connect(mqttClientId, mqttUser, mqttPass)) {
      Serial.println("connected"); // cuando se conecta publica este mensaje...
  
      fecha = now();
      // Imprimimos la hora
      String F = String(day(fecha)) + "/" + String(month(fecha)) + "/" + String(year(fecha));
      String H = String(hour(fecha)) + ":" + String(minute(fecha)) + ":" + String(second(fecha));
      String Fecha = String(F + " " + H);
      int cm = ping(TriggerPin, EchoPin);
      
      int sensorNivel = cm;
      int sensorArenero = MyScale1.readWeight();
      int sensorResiduos = MyScale2.readWeight();
      String variable;
      
      StaticJsonDocument<256> doc;
      
      doc["fecha"] = Fecha;
      doc["idarenero"] = 1;
      doc["nivelarena"] = sensorNivel;
      doc["pesoarenero"] = sensorArenero;
      doc["pesoresiduos"] = sensorResiduos;
            
      serializeJson(doc, variable);    
      int lon = variable.length()+1;
      Serial.println(variable);      
      char datojson[lon];
      variable.toCharArray(datojson, lon);
      //publica el json
      client.publish(inTopic,datojson);
      //se desconecta del broker
      client.disconnect();
      delay(5000);
  
  //client.subscribe("topic2"); //en caso de querer subscribirse a un topico
    }else { //en caso de falla de conexión
      Serial.print("failed, rc=");
      Serial.print(client.state());
      Serial.println(" try again in 5 seconds");
      // espera 5 segundos y lo intents de nuevo
      delay(5000);
    }
  }
}

void setup()
{
  Serial.begin(115200);  
  pinMode(TriggerPin, OUTPUT);
  pinMode(EchoPin, INPUT);

  setTime(17, 57, 0, 20, 9, 2022); //H:M:S - D/M/A
   
  setup_wifi(); //WiFi connection
  
  client.setServer( mqttBroker, mqttPort );
  client.setCallback( callback );
  Serial.println("Setup done");
  delay(1500);

}

void setup_wifi() {
  
  delay(10);
  // We start by connecting to a WiFi network
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop()
{
  
  if (!client.connected()) {
    reconnect();
  }
  client.loop();
}

int ping(int TriggerPin, int EchoPin) {
   long duration, distanceCm;
   
   digitalWrite(TriggerPin, LOW);  //para generar un pulso limpio ponemos a LOW 4us
   delayMicroseconds(4);
   digitalWrite(TriggerPin, HIGH);  //generamos Trigger (disparo) de 10us
   delayMicroseconds(10);
   digitalWrite(TriggerPin, LOW);
   
   duration = pulseIn(EchoPin, HIGH);  //medimos el tiempo entre pulsos, en microsegundos
   
   distanceCm = duration * 10 / 292/ 2;   //convertimos a distancia, en cm
   return distanceCm;
}
