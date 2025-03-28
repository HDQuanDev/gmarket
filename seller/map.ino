#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <FS.h>  

// Thông tin AP
const char* ssid = "NodeMCU_AP";
const char* password = "12345678";
// cổng 80
ESP8266WebServer server(80);


void handleRoot() {
  String html = R"rawliteral(
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="UTF-8">
        <title>NodeMCU Web Server - Đồ Thị Thay Đổi</title>
        <script src="/chart.js"></script>
        <script>
          window.onload = function() {
            let dataPoints = [];  // Mảng để lưu trữ giá trị dữ liệu
            let timePoints = [];  // Mảng để lưu trữ thời gian (X)

           
            function fetchData() {
              fetch('/random')
                .then(response => response.json())
                .then(data => {
                  let currentTime = new Date().toLocaleTimeString(); // Lấy thời gian hiện tại
                  dataPoints.push(1024-data.vibration);
                  timePoints.push(currentTime);

                  // Giới hạn số điểm dữ liệu
                  if (dataPoints.length > 10) {
                    dataPoints.shift();
                    timePoints.shift();
                  }

                  chart.update();
                })
                .catch(error => console.error('Error fetching data:', error));
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
                  borderColor: 'rgb(75, 192, 192)',
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

           
            setInterval(fetchData, 1000);
          }
        </script>
      </head>
      <body>
        <h1>NodeMCU Web Server - Đồ Thị Thayy Đổi cảm biến rung </h1>
        <canvas id="myChart" width="400" height="200"></canvas>
      </body>
    </html>
  )rawliteral";

  // Gửi HTML về cho client
   server.sendHeader("Access-Control-Allow-Origin", "*");  // Cho phép mọi nguồn
    server.sendHeader("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
    server.sendHeader("Access-Control-Allow-Headers", "Content-Type");
    // server.send(200, "text/plain", "Hello from NodeMCU");
  server.send(200, "text/html; charset=UTF-8", html);
}

// Hàm trả về dữ liệu ngẫu nhiên dạng JSON
void handleRandomData() {
  int randomNumber = random(0, 100);  // Sinh số ngẫu nhiên từ 0 đến 99
  String jsonResponse = "{\"randomNumber\": " + String(randomNumber) + "}";
  server.send(200, "application/json", jsonResponse);
}

// Hàm trả về file chart.js từ thư mục SPIFFS
void handleChartJS() {
  File file = SPIFFS.open("./chart.js", "r+");
  if (file) {
    server.streamFile(file, "application/javascript");
    file.close();
  } else {
    server.send(404, "text/plain", "File not found");
  }
}
void handleChartJS1(){
  File file = SPIFFS.open("./a.js", "r+");
  if (file) {
    server.streamFile(file, "application/javascript");
    file.close();
  } else {
    server.send(404, "text/plain", "File not found");
  }
}

void setup() {
  Serial.begin(115200);
  // WiFi.begin("P106", "phong106");

  // Khởi tạo SPIFFS
  if (!SPIFFS.begin()) {
    Serial.println("SPIFFS Mount Failed");
    return;
  }

  // Thiết lập Access Point
  WiFi.softAP(ssid, password);
  Serial.println("Access Point started");
  Serial.print("IP address: ");
  Serial.println(WiFi.softAPIP());


  

  // Thiết lập các URL và chức năng xử lý
  server.on("/", handleRoot);             // Xử lý yêu cầu trang chủ
  server.on("/random", handleRandomData); // Xử lý yêu cầu dữ liệu ngẫu nhiên
  server.on("/chart.js", HTTP_GET, handleChartJS);  // Xử lý yêu cầu file chart.js
  server.on("/a.js", HTTP_GET, handleChartJS1);  // Xử lý yêu cầu file chart.js


  // Bắt đầu server
  server.begin();
  Serial.println("HTTP server started");
}

void loop() {
  // Xử lý yêu cầu HTTP
  server.handleClient();
}
