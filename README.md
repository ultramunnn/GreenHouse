# Smart GreenHouse Monitoring System

An advanced greenhouse monitoring solution powered by Laravel and Filament, featuring ESP32-based sensor integration for real-time environmental monitoring. This enterprise-grade system provides comprehensive control and monitoring capabilities for modern greenhouse management.

## 🌟 Core Features

- **Advanced Real-time Monitoring**: Enterprise-grade sensor system utilizing ESP32 for precise environmental parameter tracking
- **Admin Interface**: Elegant and responsive management dashboard built with Filament
- **User Management**: Role-based access control system with granular permissions
- **Device Management**: Seamless tracking and control of multiple sensor nodes
- **Data Logging**: Comprehensive logging system for sensor activities and user actions
- **Responsive Design**: Professional mobile-first interface for monitoring on any device

## 🔧 Technology Stack

- **Backend Framework**: Laravel 12.0 (Enterprise Edition)
- **Admin Panel**: Filament 3.3 (Professional Suite)
- **Database**: MySQL (Enterprise Ready)
- **Hardware**: ESP32 Microcontroller
- **Integrated Sensors**: 
  - BH1750 Precision Light Sensor
  - Expandable sensor array (temperature, humidity, etc.)

## 📋 Prerequisites

- PHP >= 8.2 (Enterprise Edition)
- Composer (Latest Version)
- Node.js & NPM (LTS Version)
- MySQL Database (Enterprise Ready)
- Arduino IDE (for ESP32 Development)

## ⚙️ Enterprise Installation

1. **Clone the Repository**
   ```bash
   git clone [repository-url]
   cd GreenHouse
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript Dependencies**
   ```bash
   npm install
   ```

4. **Configure Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Configuration**
   - Configure `.env` with your enterprise database credentials
   ```bash
   php artisan migrate
   php artisan db:seed --class=AdminUserSeeder
   ```

6. **Build Production Assets**
   ```bash
   npm run build
   ```

7. **Launch Application Server**
   ```bash
   php artisan serve
   ```

## 🔌 Hardware Integration

### ESP32 Configuration
1. Open `esp32_sensor/esp32_sensor.ino` in Arduino IDE
2. Configure network credentials and API endpoint:
   ```cpp
   const char* ssid = "your-enterprise-wifi";
   const char* password = "your-secure-password";
   const char* serverUrl = "http://your-server-domain/api/sensor";
   ```
3. Deploy firmware to ESP32 device
4. Connect sensors according to the provided pin configuration

## 👥 Access Control

- **Administrator**: Full system access with comprehensive management capabilities
- **Standard User**: Restricted access to monitoring and essential features

## 📊 Database Architecture

The system implements the following core models:
- Users
- Devices
- DeviceCategories
- SensorTransactions
- ActivityLogs

## 🔒 Enterprise Security

- Secure API authentication via Laravel Sanctum
- Role-based access control (RBAC)
- Comprehensive activity logging for audit compliance

## 🤝 Development

Contributions and feature requests are welcome through our enterprise collaboration channels.

## 📝 Licensing

This project is licensed under the MIT License - enabling enterprise deployment and modification.

## ✨ Enterprise Support

For premium support and customization services, contact our development team or create an issue in the repository.

---

Engineered with ❤️ for professional greenhouse management and monitoring.
