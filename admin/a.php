<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Audio API</title>
</head>
<body>
    <button id="playSound" onclick="playSound()">Phát âm thanh</button>
    <button id="stopSound" onclick="stopSound()">Dừng âm thanh</button>

    <script>
        // Tạo AudioContext
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        let oscillator; // Biến để lưu bộ dao động (oscillator)

        // Hàm phát âm thanh
        function playSound() {
            // Tạo bộ dao động
            oscillator = audioContext.createOscillator();

            // Cài đặt loại sóng âm
            oscillator.type = 'sine'; // Các loại khác: 'square', 'triangle', 'sawtooth'
            oscillator.frequency.setValueAtTime(440, audioContext.currentTime); // Tần số 440Hz (nốt A4)

            // Kết nối bộ dao động tới đầu ra (loa)
            oscillator.connect(audioContext.destination);

            // Bắt đầu phát
            oscillator.start();
        }

        // Hàm dừng âm thanh
        function stopSound() {
            if (oscillator) {
                oscillator.stop(); // Dừng bộ dao động
                oscillator.disconnect(); // Ngắt kết nối
            }
        }

        // Thêm sự kiện cho các nút
        // document.getElementById('playSound').addEventListener('click', playSound);
        // document.getElementById('stopSound').addEventListener('click', stopSound);
    </script>
</body>
</html>
