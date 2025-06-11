#include <WiFi.h>
#include <HTTPClient.h>
#include <time.h>
#include <Wire.h>  // BH1750 IIC Mode 
#include <math.h> 

const char* ssid = "POCO X3 Pro";
const char* password = "12345678x";
const char* serverUrl = "http://192.168.220.52:8000/api/sensor"; // Ganti dengan URL API Anda

// NTP Server Settings
const char* ntpServer = "pool.ntp.org";
const long gmtOffset_sec = 25200;  // GMT+7 (7 * 60 * 60)
const int daylightOffset_sec = 0;

// BH1750 Sensor Addresses
const int BH1750address1 = 0x23; // Sensor pertama (Alamat 0x23) - Location 1
const int BH1750address2 = 0x5C; // Sensor kedua (Alamat 0x5C) - Location 2

byte buff[2];

// Pin I2C untuk ESP32 (GPIO21 dan GPIO22)
#define SDA_PIN 21
#define SCL_PIN 22

// Timer untuk pengiriman data
unsigned long lastSendTime = 0;
unsigned long lastSensorReadTime = 0;

void setup() {
  Serial.begin(115200);
  
  // Inisialisasi I2C menggunakan pin SDA dan SCL yang benar
  Wire.begin(SDA_PIN, SCL_PIN);  // Menyambungkan ke I2C di ESP32 (GPIO21 dan GPIO22)
  
  // Menghubungkan ke WiFi
  WiFi.begin(ssid, password);
  Serial.println("Connecting to WiFi...");
  
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(100);
  }
  
  Serial.println("\nConnected to WiFi!");
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());

  // Inisialisasi NTP
  configTime(gmtOffset_sec, daylightOffset_sec, ntpServer);
  
  // Tunggu waktu sinkronisasi NTP
  Serial.println("Waiting for NTP time sync...");
  while (time(nullptr) < 1000000000) {
    Serial.print(".");
    delay(1000);
  }
  Serial.println("\nTime synchronized!");

  // Inisialisasi sensor BH1750
  BH1750_Init(BH1750address1);
  BH1750_Init(BH1750address2);
  Serial.println("BH1750 Sensors Initialized!");
}

String getFormattedTime() {
  struct tm timeinfo;
  if(!getLocalTime(&timeinfo)){
    Serial.println("Failed to obtain time");
    return "now"; // fallback value
  }
  
  char timeStr[25];
  strftime(timeStr, sizeof(timeStr), "%Y-%m-%d %H:%M:%S", &timeinfo);
  return String(timeStr);
}

void sendDataToAPI() {
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("WiFi Disconnected!");
    return;
  }

  // Baca data dari kedua sensor
  uint16_t luxValue1 = readSensorData(BH1750address1);
  uint16_t luxValue2 = readSensorData(BH1750address2);
  
  // Dapatkan waktu untuk pencatatan
  String waktuPencatatan = getFormattedTime();
  
  HTTPClient http;
  http.begin(serverUrl);
  http.addHeader("Content-Type", "application/json");
  http.setTimeout(15000);

  // Kirim data untuk Lokasi 1
  String payload1 = "{\"masterdevice_id\": 1, \"nilai\": " + String(luxValue1) + 
                   ", \"waktu_pencatatan\": \"" + waktuPencatatan + "\"}";
  
  Serial.println("Sending Location 1 reading: " + payload1);
  int httpResponseCode1 = http.POST(payload1);
  
  if (httpResponseCode1 > 0) {
    String response = http.getString();
    Serial.println("Location 1 Success! Response code: " + String(httpResponseCode1));
    Serial.println("Response: " + response);
  } else {
    Serial.println("Location 1 Error: " + String(httpResponseCode1));
    Serial.println("Error message: " + http.errorToString(httpResponseCode1));
  }

  // Kirim data untuk Lokasi 2
  String payload2 = "{\"masterdevice_id\": 3, \"nilai\": " + String(luxValue2) + 
                   ", \"waktu_pencatatan\": \"" + waktuPencatatan + "\"}";
  
  Serial.println("Sending Location 2 reading: " + payload2);
  int httpResponseCode2 = http.POST(payload2);
  
  if (httpResponseCode2 > 0) {
    String response = http.getString();
    Serial.println("Location 2 Success! Response code: " + String(httpResponseCode2));
    Serial.println("Response: " + response);
  } else {
    Serial.println("Location 2 Error: " + String(httpResponseCode2));
    Serial.println("Error message: " + http.errorToString(httpResponseCode2));
  }
  
  http.end();
}

uint16_t readSensorData(int sensorAddress) {
  uint16_t val = 0;
  BH1750_Init(sensorAddress);  // Inisialisasi sensor
  delay(200);  // Tunggu sebentar agar sensor bisa memproses

  int bytesRead = BH1750_Read(sensorAddress);
  if (bytesRead == 2) {
    val = ((buff[0] << 8) | buff[1]) / 1.2; // Konversi ke nilai lux
  } else {
    Serial.print("No data read from sensor at address ");
    Serial.println(sensorAddress, HEX);
  }

  return val;
}

int BH1750_Read(int address) {
  int i = 0;
  Wire.beginTransmission(address);
  Wire.requestFrom(address, 2);  // Meminta 2 byte data dari sensor
  delay(100);  // Tambahkan sedikit delay untuk memberi waktu sensor
  while (Wire.available()) { 
    buff[i] = Wire.read();  // Terima satu byte data
    i++;
  }
  Wire.endTransmission();  
  return i; // Mengembalikan jumlah byte yang diterima
}

void BH1750_Init(int address) {
  Wire.beginTransmission(address);
  Wire.write(0x10);  // 1lx resolution mode, 120ms
  Wire.endTransmission();
}

void loop() {
  // Pastikan tidak menggunakan delay, kita ganti dengan millis
  unsigned long currentMillis = millis();

  // Baca data dari kedua sensor dan kirim ke API setiap 10 detik
  if (currentMillis - lastSendTime >= 10000) { // 10 detik
    lastSendTime = currentMillis;
    sendDataToAPI();
  }

  // Baca data sensor setiap 5 detik (jangan menggunakan delay)
  if (currentMillis - lastSensorReadTime >= 5000) { // 5 detik
    lastSensorReadTime = currentMillis;
    // Sensor sudah dibaca, tidak perlu melakukan hal lain karena sudah otomatis di read dan kirim
  }
}
