#include <WiFi.h>
#include <HTTPClient.h>
#include <time.h>

const char* ssid = "PONITI";
const char* password = "12345678";
const char* serverUrl = "http://192.168.1.11:8000/api/sensor";

// NTP Server Settings
const char* ntpServer = "pool.ntp.org";
const long gmtOffset_sec = 25200;  // GMT+7 (7 * 60 * 60)
const int daylightOffset_sec = 0;

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

  // Init and get the time
  configTime(gmtOffset_sec, daylightOffset_sec, ntpServer);
  
  // Wait until time is synchronized
  Serial.println("Waiting for NTP time sync...");
  while (time(nullptr) < 1000000000) {
    Serial.print(".");
    delay(1000);
  }
  Serial.println("\nTime synchronized!");
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

  HTTPClient http;
  http.begin(serverUrl);
  http.addHeader("Content-Type", "application/json");
  http.setTimeout(15000);
  
  // Data sensor (dummy)
  static float luxValue = 2.0;
  luxValue += 0.5;
  if (luxValue > 100) luxValue = 25.0;
  
  // Get current time for logging
  String waktuPencatatan = getFormattedTime();
  
  // Create JSON with formatted time
  String payload = "{\"masterdevice_id\": 1, \"nilai\": " + String(luxValue, 1) + 
                  ", \"waktu_pencatatan\": \"" + waktuPencatatan + "\"}";
  
  Serial.println("Sending: " + payload);
  
  int httpResponseCode = http.POST(payload);
  
  if (httpResponseCode > 0) {
    String response = http.getString();
    Serial.println("Success! Response code: " + String(httpResponseCode));
    Serial.println("Response: " + response);
  } else {
    Serial.println("Error: " + String(httpResponseCode));
    Serial.println("Error message: " + http.errorToString(httpResponseCode));
  }
  
  http.end();
}

void loop() {
  sendDataToAPI();
  delay(10000);
}