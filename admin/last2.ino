#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <FS.h>  

const char* ssid = "NodeMCU_AP";
const char* password = "12345678";
ESP8266WebServer server(80);

const int sensorPin = A0;
const int buzzerPin = D1; 

void handleRoot() {
  String html = R"rawliteral(
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="UTF-8">
        <title>NodeMCU Web Server - Đồ Thị Thay Đổi</title>
        <script src="http://localhost/chart.js"></script>
        <script>
         let oscillator; 
        let audioContext =""; 
        function playSound() {
            if (audioContext=="") {
                audioContext = new (window.AudioContext || window.webkitAudioContext)();
            } else if (audioContext.state === 'suspended') {
                audioContext.resume();
            }
            else{

              
              oscillator = audioContext.createOscillator();
              oscillator.type = 'sine'; // Các loại khác: 'square', 'triangle', 'sawtooth'
              oscillator.frequency.setValueAtTime(440, audioContext.currentTime); // Tần số 440Hz (nốt A4)
              oscillator.connect(audioContext.destination);
              oscillator.start();
            }
        }
        function stopSound() {
            if (oscillator) {
                oscillator.stop();
                oscillator.disconnect(); 
            }
        }
        function firstActive(){
          if (!audioContext) {
              audioContext = new (window.AudioContext || window.webkitAudioContext)();
              console.log("AudioContext đã được kích hoạt.");
          } else if (audioContext.state === "suspended") {
              audioContext.resume();
          }

        }
          window.onload = function() {
            let dataPoints = [];  // Mảng để lưu trữ giá trị dữ liệu
            let timePoints = [];  // Mảng để lưu trữ thời gian (X)

            function fetchData() {
              fetch('/sensor')
                .then(response => response.json())
                .then(data => {
                  let currentTime = new Date().toLocaleTimeString(); // Lấy thời gian hiện tại
                  dataPoints.push(1024-data.vibration);
                  timePoints.push(currentTime);


                  if(data.vibration<1010 && document.getElementById('open_status').value=='0'){
                    document.getElementById('open_status').value='1';
                    console.log(1);
                    playSound();
                  }
                  else{
                    document.getElementById('open_status').value='0';

                    console.log(2);
                    stopSound();
                  }



                  // Giới hạn số điểm dữ liệu
                  if (dataPoints.length > 10) {
                    dataPoints.shift();
                    timePoints.shift();
                  }

                  chart.update();
                })
            }

            //  Chart.js
            const ctx = document.getElementById('myChart').getContext('2d');
            const chart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: timePoints,  // Nhãn thời gian
                datasets: [{
                  label: 'Giá trị ngẫu nhiên',
                  data: dataPoints,  // Dữ liệu điểm
                  borderColor: 'rgb(192, 192, 192)',
                  fill: false,
                }]
              },
              options: {
                responsive: true,
                scales: {
                  x: {
                    type: 'category',
                    title: {
                      display: true,
                      text: 'Thời gian'
                    }
                  },
                  y: {
                    title: {
                      display: true,
                      text: 'Giá trị'
                    }
                  }
                }
              }
            });

            setInterval(fetchData, 1500);
          }
        </script>
      </head>
      <body>
        <h1>NodeMCU Web Server - Đồ Thị Thay Đổi cảm biến rung </h1>
        <input type="text" hidden id="open_status" value="0">
        <button id="enableAudio" onclick="firstActive()">Kích hoạt âm thanh</button>
        <div id="canvasContainer">
          <canvas id="myChart" width="400" height="200"></canvas>
        </div>
      </body>
    </html>
  )rawliteral";

  server.send(200, "text/html; charset=UTF-8", html);
}

void handleSensorData() {
  int sensorValue = analogRead(sensorPin); 
  String jsonResponse = "{\"vibration\": " + String(sensorValue) + "}";
  server.send(200, "application/json", jsonResponse);

  if (sensorValue > 1000) {
    digitalWrite(buzzerPin, HIGH);  
  } else {
    digitalWrite(buzzerPin, LOW);   
  }
}

void handleChartJS() {
  File file = SPIFFS.open("./chart.js", "r+");
  if (file) {
    server.streamFile(file, "application/javascript");
    file.close();
  } else {
    server.send(404, "text/plain", "File not found");
  }
}
void handleRandomData() {
  int randomNumber = random(0, 1024);  
  String jsonResponse = "{\"vibration\": " + String(randomNumber) + "}";
  server.send(200, "application/json", jsonResponse);
}
void setup() {
  Serial.begin(115200);

  if (!SPIFFS.begin()) {
    Serial.println("SPIFFS Mount Failed");
    return;
  }

  WiFi.softAP(ssid, password);
  Serial.println("Access Point started");
  Serial.print("IP address: ");
  Serial.println(WiFi.softAPIP());

  server.on("/", handleRoot);            
  server.on("/chart.js", HTTP_GET, handleChartJS);  
  server.on("/sensor", handleSensorData);
  server.on("/random", handleRandomData); 


  pinMode(buzzerPin, OUTPUT);
  digitalWrite(buzzerPin,HIGH);
  server.begin();
  Serial.println("HTTP server started");
}

void loop() {
  server.handleClient();
}
