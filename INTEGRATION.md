# 🔌 Integration Guide - GEMBOK LARA

Panduan lengkap untuk integrasi sistem eksternal dengan GEMBOK LARA.

---

## 📡 Mikrotik Integration

### Overview
Integrasi dengan Mikrotik RouterOS untuk manajemen PPPoE dan Hotspot secara otomatis dari dashboard GEMBOK LARA.

### Prerequisites
- Mikrotik RouterOS v6.x atau v7.x
- API Service enabled di Mikrotik
- User dengan permission API & Write

### Configuration

#### 1. Enable API di Mikrotik
```bash
/ip service
set api address=0.0.0.0/0 disabled=no port=8728
```

#### 2. Create API User
```bash
/user add name=api_user password=your_secure_password group=full
```

#### 3. Setup di GEMBOK LARA

Edit `.env`:
```env
MIKROTIK_HOST=192.168.1.1
MIKROTIK_PORT=8728
MIKROTIK_USERNAME=api_user
MIKROTIK_PASSWORD=your_secure_password
MIKROTIK_USE_SSL=false
```

### Features

#### PPPoE Management

**Auto Create PPPoE Secret**
```php
// Ketika customer dibuat/diupdate
$mikrotik->createPPPoESecret([
    'name' => $customer->username,
    'password' => $customer->password,
    'service' => 'pppoe',
    'profile' => $customer->package->pppoe_profile,
    'comment' => "Customer: {$customer->name}"
]);
```

**Update Bandwidth**
```php
// Ketika package diubah
$mikrotik->updatePPPoEProfile([
    'name' => $package->pppoe_profile,
    'rate-limit' => "{$package->speed}M/{$package->speed}M"
]);
```

**Disconnect User**
```php
// Suspend customer
$mikrotik->disconnectPPPoE($customer->username);
```

#### Hotspot Management

**Generate Voucher**
```php
$mikrotik->createHotspotUser([
    'name' => $voucher->code,
    'password' => $voucher->password,
    'profile' => $voucher->profile,
    'limit-uptime' => $voucher->duration,
    'comment' => "Voucher: {$voucher->package}"
]);
```

**Monitor Active Sessions**
```php
$activeSessions = $mikrotik->getActiveHotspotUsers();
```

### API Endpoints

#### Get User Status
```
GET /api/mikrotik/user/{username}/status
```

Response:
```json
{
    "username": "customer001",
    "status": "online",
    "ip_address": "10.10.10.100",
    "uptime": "2h 30m",
    "bytes_in": 1048576,
    "bytes_out": 524288
}
```

#### Control Bandwidth
```
POST /api/mikrotik/user/{username}/bandwidth
```

Request:
```json
{
    "upload": "10M",
    "download": "10M"
}
```

---

## 🌐 GenieACS Integration

### Overview
GenieACS adalah Auto Configuration Server (ACS) open-source untuk manajemen CPE menggunakan protokol TR-069/CWMP.

### Prerequisites
- GenieACS Server v1.2+
- MongoDB v4.x+
- Node.js v14+

### Installation GenieACS

#### 1. Install Dependencies
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install -y mongodb nodejs npm

# Install GenieACS
sudo npm install -g genieacs
```

#### 2. Configure GenieACS
```bash
# Create config directory
sudo mkdir -p /opt/genieacs/config

# Create config file
sudo nano /opt/genieacs/config/config.json
```

Config:
```json
{
  "MONGODB_CONNECTION_URL": "mongodb://127.0.0.1:27017/genieacs",
  "CWMP_INTERFACE": "0.0.0.0",
  "CWMP_PORT": 7547,
  "CWMP_SSL": false,
  "NBI_INTERFACE": "0.0.0.0",
  "NBI_PORT": 7557,
  "FS_INTERFACE": "0.0.0.0",
  "FS_PORT": 7567,
  "UI_INTERFACE": "0.0.0.0",
  "UI_PORT": 3000
}
```

#### 3. Start Services
```bash
# Start GenieACS services
sudo systemctl start genieacs-cwmp
sudo systemctl start genieacs-nbi
sudo systemctl start genieacs-fs
sudo systemctl start genieacs-ui

# Enable on boot
sudo systemctl enable genieacs-cwmp
sudo systemctl enable genieacs-nbi
sudo systemctl enable genieacs-fs
sudo systemctl enable genieacs-ui
```

### Configuration in GEMBOK LARA

Edit `.env`:
```env
GENIEACS_URL=http://localhost:7557
GENIEACS_USERNAME=admin
GENIEACS_PASSWORD=admin
```

### Features

#### Device Management

**List All Devices**
```php
$devices = $genieacs->getDevices();
```

**Get Device Details**
```php
$device = $genieacs->getDevice($deviceId);
```

**Refresh Device**
```php
$genieacs->refreshDevice($deviceId);
```

#### Remote Control

**Reboot Device**
```php
$genieacs->rebootDevice($deviceId);
```

**Factory Reset**
```php
$genieacs->factoryReset($deviceId);
```

**Update WiFi Settings**
```php
$genieacs->updateWiFi($deviceId, [
    'ssid' => 'MyNetwork',
    'password' => 'SecurePassword123',
    'channel' => 'auto',
    'encryption' => 'WPA2-PSK'
]);
```

#### Provisioning

**Create Preset**
```php
$genieacs->createPreset([
    'name' => 'Default Config',
    'channel' => 'auto',
    'precondition' => '{
        "InternetGatewayDevice.DeviceInfo.ModelName": "HG8245H"
    }',
    'configurations' => [
        [
            'type' => 'value',
            'name' => 'InternetGatewayDevice.LANDevice.1.WLANConfiguration.1.SSID',
            'value' => 'WiFi-{{serialNumber}}'
        ]
    ]
]);
```

**Apply Preset to Device**
```php
$genieacs->applyPreset($deviceId, 'Default Config');
```

#### Monitoring

**Get Device Status**
```php
$status = $genieacs->getDeviceStatus($deviceId);
```

Response:
```json
{
    "device_id": "00259E-HG8245H-HWTC12345678",
    "status": "online",
    "model": "HG8245H",
    "manufacturer": "Huawei",
    "firmware": "V3R017C10S115",
    "ip_address": "192.168.1.100",
    "mac_address": "00:25:9E:12:34:56",
    "uptime": 86400,
    "last_inform": "2024-12-03T10:30:00Z",
    "wifi": {
        "ssid": "WiFi-Customer001",
        "channel": 6,
        "signal": -45
    }
}
```

### Dashboard Integration

#### CPE Management Page

**List View**
- Tabel semua CPE dengan status online/offline
- Filter berdasarkan model, status, customer
- Bulk actions (reboot, refresh)

**Detail View**
- Device information lengkap
- Real-time status monitoring
- Remote control buttons
- Configuration history
- Diagnostic tools

**Actions**
- Reboot device
- Factory reset
- Update WiFi settings
- Change admin password
- Port forwarding setup
- Firmware upgrade

### API Endpoints

#### Get All CPE
```
GET /api/cpe
```

#### Get CPE by Customer
```
GET /api/customers/{id}/cpe
```

#### Remote Reboot
```
POST /api/cpe/{id}/reboot
```

#### Update WiFi
```
POST /api/cpe/{id}/wifi
```

Request:
```json
{
    "ssid": "NewSSID",
    "password": "NewPassword123",
    "channel": "auto"
}
```

---

## 🔐 Security Best Practices

### Mikrotik
1. Gunakan SSL/TLS untuk API connection
2. Buat user khusus dengan permission minimal
3. Whitelist IP GEMBOK LARA di firewall
4. Gunakan strong password
5. Enable audit logging

### GenieACS
1. Gunakan HTTPS untuk web interface
2. Change default credentials
3. Implement authentication di NBI
4. Restrict access dengan firewall
5. Regular backup MongoDB

---

## 🧪 Testing

### Mikrotik Connection Test
```bash
php artisan mikrotik:test
```

### GenieACS Connection Test
```bash
php artisan genieacs:test
```

### Full Integration Test
```bash
php artisan test --filter=IntegrationTest
```

---

## 📚 Resources

### Mikrotik
- [RouterOS API Documentation](https://wiki.mikrotik.com/wiki/Manual:API)
- [PPPoE Server Setup](https://wiki.mikrotik.com/wiki/Manual:PPPoE)
- [Hotspot Setup](https://wiki.mikrotik.com/wiki/Manual:Hotspot)

### GenieACS
- [Official Documentation](https://genieacs.com/docs/)
- [TR-069 Protocol](https://www.broadband-forum.org/technical/download/TR-069.pdf)
- [API Reference](https://github.com/genieacs/genieacs/wiki/API-Reference)

---

## 🆘 Troubleshooting

### Mikrotik Connection Failed
```bash
# Test connection
ping 192.168.1.1

# Test API port
telnet 192.168.1.1 8728

# Check logs
tail -f storage/logs/mikrotik.log
```

### GenieACS Device Not Connecting
```bash
# Check GenieACS logs
sudo journalctl -u genieacs-cwmp -f

# Verify CPE configuration
# ACS URL should be: http://your-server-ip:7547

# Test NBI API
curl http://localhost:7557/devices
```

---

## 💡 Tips & Tricks

1. **Batch Operations**: Gunakan queue untuk operasi bulk
2. **Caching**: Cache device status untuk performa
3. **Monitoring**: Setup monitoring untuk service availability
4. **Backup**: Regular backup konfigurasi Mikrotik & GenieACS
5. **Documentation**: Dokumentasikan custom presets & scripts

---

**Need Help?** Open an issue di [GitHub Issues](https://github.com/rizkylab/gembok-lara/issues)
