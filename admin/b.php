<!DOCTYPE html>
    <html>
      <head>
        <meta charset="UTF-8">
        <title>NodeMCU Web Server - Đồ Thị Thay Đổi</title>
        <script src="http://localhost/chart.js"></script>
        <script>
       

          window.onload = function() {
            let dataPoints = [];  // Mảng để lưu trữ giá trị dữ liệu
            let timePoints = [];  // Mảng để lưu trữ thời gian (X)

            function fetchData() {
              fetch('/admin/sensor.php')
                .then(response => response.json())
                .then(data => {
                  let currentTime = new Date().toLocaleTimeString(); // Lấy thời gian hiện tại
                  dataPoints.push(1024-data.vibration);

                  if(data.vibration<8000 && document.getElementById('open_status').value=='0'){
                    document.getElementById('open_status').value='1';
                    console.log(1);
                    playSound();
                  }
                  else{
                    document.getElementById('open_status').value='0';

                    console.log(2);
                    stopSound();
                  }
                  timePoints.push(currentTime);

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

            setInterval(fetchData, 2000);
          }

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