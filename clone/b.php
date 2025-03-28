<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>NodeMCU Web Server - Đồ Thị Thay Đổi</title>
    <script src="/chart.js"></script>
    <script>
      window.onload = function() {
        // Sau khi trang được tải hoàn toàn, tiến hành các tác vụ JavaScript
        let dataPoints = [];  // Mảng để lưu trữ giá trị dữ liệu
        let timePoints = [];  // Mảng để lưu trữ thời gian (X)

        function fetchData() {
          fetch('http://192.168.4.1/random')
            .then(response => response.json())
            .then(data => {
              // Thêm dữ liệu vào mảng
              let currentTime = new Date().toLocaleTimeString();
              dataPoints.push(data.randomNumber);
              timePoints.push(currentTime);

              // Giới hạn số điểm dữ liệu (có thể điều chỉnh)
              if (dataPoints.length > 10) {
                dataPoints.shift();
                timePoints.shift();
              }

              // Cập nhật đồ thị
              chart.update();
            })
            .catch(error => console.error('Error fetching data:', error));
        }

        // Cấu hình Chart.js
        const ctx = document.getElementById('myChart').getContext('2d');
        const chart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: timePoints, // Thời gian
            datasets: [{
              label: 'Giá trị ngẫu nhiên',
              data: dataPoints, // Dữ liệu
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

        // Tạo yêu cầu fetch mỗi giây
        setInterval(fetchData, 1000);
      }
    </script>
  </head>
  <body>
    <h1>NodeMCU Web Server - Đồ Thị Thay đổij giá trị cảm biến rung</h1>
    <canvas id="myChart" width="400" height="200"></canvas>
  </body>
</html>
