#include <SoftwareSerial.h>

SoftwareSerial sim900(10, 11); 

void setup() {
  Serial.begin(9600);        
  sim900.begin(9600);        // Giao tiếp với SIM900A

  // Gửi lệnh AT để kiểm tra kết nối
  Serial.println("Initializing...");
  delay(1000);
  sim900.println("AT");
  delay(1000);

  sim900.println("AT+CMGF=1"); //Chuyển sang Text mode
  delay(1000);

  // Gửi tin nhắn
  sim900.println("AT+CMGS='+84971360307'"); //thay bằng số điện thoại của e nhé
  delay(1000);
  sim900.print("Tin nhan Arduino test nha!");    // Nội dung tin nhắn
  delay(1000);
  sim900.write(26);
  delay(1000);

  Serial.println("Tin nhan da gui!");
}

void loop() {
 
}
