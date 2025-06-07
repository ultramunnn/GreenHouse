#include <WiFi.h>
#include <HTTPClient.h>

const char* ssid = "Sejahtera bersama";
const char* password = "12345678x";
const char* serverUrl = "http://192.168.1.11:8000/api/sensor";

void setup() {
  Serial.begin(115200);
  
  WiFi.begin(ssid, password);
  Serial.println("Connecting to WiFi...");
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
  }
  
  Serial.println("\nConnected to WiFi!");
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());
}

String getFormattedTime() {
  // Format waktu HH:MM:SS
  unsigned long timeInSeconds = millis() / 1000;
  unsigned long hours = (timeInSeconds / 3600) % 24;
  unsigned long minutes = (timeInSeconds / 60) % 60;
  unsigned long seconds = timeInSeconds % 60;
  
  char timeStr[9];
  sprintf(timeStr, "%02lu:%02lu:%02lu", hours, minutes, seconds);
  return String(timeStr);
}

void sendDataToAPI() {
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("WiFi Disconnected!");
    return;
  }

  HTTPClient http;
  http.begin(serverUrl);
  http.addHeader("Content-Type", "application/json");
  http.setTimeout(15000);
  
  // Data sensor (dummy)
  static float luxValue = 25.0;
  luxValue += 0.5;
  if (luxValue > 100) luxValue = 25.0;
  
  // Format waktu untuk pencatatan
  String waktuPencatatan = getFormattedTime();
  
  // Buat JSON dengan waktu yang diformat
  String payload = "{\"masterdevice_id\": 5, \"nilai\": " + String(luxValue, 1) + 
                  ", \"waktu_pencatatan\": \"" + waktuPencatatan + "\"}";
  
  Serial.println("Sending: " + payload);
  
  int httpResponseCode = http.POST(payload);
  
  if (httpResponseCode > 0) {
    String response = http.getString();
    Serial.println("Success! Response code: " + String(httpResponseCode));
    Serial.println("Response: " + response);
    
    // Parse server time jika ada
    if (response.indexOf("server_time") > 0) {
      int startIdx = response.indexOf("server_time") + 14;
      int endIdx = response.indexOf("\"", startIdx);
      if (startIdx > 0 && endIdx > 0) {
        String serverTime = response.substring(startIdx, endIdx);
        Serial.println("Server time: " + serverTime);
      }
    }
  } else {
    Serial.println("Error: " + String(httpResponseCode));
    Serial.println("Error message: " + http.errorToString(httpResponseCode));
  }
  
  http.end();
}

void loop() {
  sendDataToAPI();
  delay(5000);
} 