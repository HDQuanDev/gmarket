<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>NodeMCU Web Server - Đồ Thị Thay Đổi</title>
    <script src="http://localhost/chart.js"></script>
    <script>
        window.onload = function() {
            let dataPoints = []; // Mảng để lưu trữ giá trị dữ liệu
            let timePoints = []; // Mảng để lưu trữ thời gian (X)

            function fetchData() {
                fetch('192.168.4.1/sensor')
                    .then(response => response.json())
                    .then(data => {
                        let currentTime = new Date().toLocaleTimeString(); // Lấy thời gian hiện tại
                        dataPoints.push(1024 - data.vibration);
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
                    labels: timePoints, // Nhãn thời gian
                    datasets: [{
                        label: 'Giá trị ngẫu nhiên',
                        data: dataPoints, // Dữ liệu điểm
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

            setInterval(fetchData, 1000);
        }
    </script>
</head>

<body>
    <h1>NodeMCU Web Server - Đồ Thị Thay Đổi cảm biến rung </h1>
    <canvas id="myChart" width="400" height="200"></canvas>
</body>

</html>