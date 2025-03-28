#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>

const char* ssid = "NodeTest";
const char* password = "12345678";

const int sensorPin = A0; 

ESP8266WebServer server(80);

void handleRoot() {
  String html = R"rawliteral(
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="UTF-8">
        <title>NodeMCU Web Server</title>
        <script>
          function fetchData() {
            fetch('/sensor').then(r => r.json())
              .then(data => {
                document.getElementById('sensorData1').innerText = data.vibration;
              })
          }
          setInterval(fetchData, 1000);
        </script>
      </head>
      <body>
        <h1>NodeMCU Web Server</h1>
        <p>Giá trị cảm biến rung:</p>
        <p id="sensorData1">Đang tải...</p>
      </body>
    </html>
  )rawliteral";

  server.send(200, "text/html; charset=UTF-8", html);
}

void handleSensorData() {
  int sensorValue = analogRead(sensorPin); // analog
  String jsonResponse = "{\"vibration\": " + String(sensorValue) + "}";
  server.send(200, "application/json", jsonResponse);
}

void setup() {
  Serial.begin(115200);

  pinMode(sensorPin, INPUT); 

  WiFi.softAP(ssid, password);
  Serial.println("AP là ");
  Serial.print("IP : ");
  Serial.println(WiFi.softAPIP());

  // router
  server.on("/", handleRoot);        
  server.on("/sensor", handleSensorData); 

  // server
  server.begin();
  Serial.println("Ok ok");
}

void loop() {
  //HTTP
  server.handleClient();
}
