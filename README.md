# 🔐 GEMBOK LARA - ISP Billing & Management System

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)
![Chart.js](https://img.shields.io/badge/Chart.js-4.x-FF6384?style=for-the-badge&logo=chartdotjs)
![CI/CD](https://img.shields.io/badge/CI%2FCD-GitHub_Actions-2088FF?style=for-the-badge&logo=github-actions)



**GEMBOK LARA** is an ISP (Internet Service Provider) billing and operational management system built using **Laravel 12**. This system is designed with a modern interface, deep analytics, and comprehensive features to manage your ISP business.

🌐 **Demo**: [https://isp.digitalkanaku.com/](https://isp.digitalkanaku.com/)

---

## � Screenshots

<div align="center">
  <img src="img/login.png" alt="Login Page" width="45%">
  <img src="img/dashboard.png" alt="Dashboard" width="45%">
  <img src="img/customers.png" alt="Customer Management" width="45%">
  <img src="img/network-map.png" alt="Network Map" width="45%">
</div>

> **Note**:Application screenshots are available in the folder `img/`

---

## ✨ Full Feature 

### 🎨 **Modern UI/UX**
- **Theme ISP Network**: Modern design with professional cyan & blue color palettes
- **Responsive Design**: Optimal display across desktop, tablet, and mobile devices.
- **Dark Sidebar**: Elegant gradient sidebar featuring intuitive navigation.
- **Interactive Charts**: Analytical graphs powered by Chart.js.
- **Smooth Animations**: Seamless transitions and refined hover effects.

### 📊 **Dashboard Analytics**
- **Real-time Statistics**: 
  - Total Customers & Active Status
  - Total Revenue & Pending Revenue
  - Package Distribution
  - Invoice Status
- **Interactive Charts**:
  - Revenue Trend (6 bulan terakhir)
  - Customer Growth Chart
  - Package Distribution (Doughnut Chart)
  - Invoice Status (Pie Chart)
- **Recent Activity**: Latest invoices and customers
- **Quick Actions**: Fast access to core features

### 👥 **Customer Management**
- **CRUD Lengkap**: Create, Read, Update, Delete customer
- **Customer Profile**: Comprehensive details with statistics
- **Package Assignment**: Assign internet packages to customers
- **Status Management**: Active, Inactive, Suspended
- **Search & Filter**: Search and filter by status or package
- **Invoice History**: Billing history per customer

### 💰 **Invoice & Billing**
- **Auto Invoice Generation**: Generate invoice otomatis
- **Invoice Management**: Create, edit, view, print invoice
- **Payment Tracking**: Paid/unpaid status with payment dates
- **Invoice Filtering**: Filter by status, customer, and date
- **Professional Print**: Print-ready invoice templates
- **Revenue Analytics**: Real-time revenue statistics

### 📦 **Package Management**
- **Flexible Packages**: Create packages with custom pricing and speeds
- **Package Statistics**: Number of subscribers per package
- **Tax Configuration**:Tax settings per package
- **PPPoE Profile**: Mapping to MikroTik profiles
- **Active/Inactive Status**: Control which packages are displayed

### 🎫 **Voucher System**
- **Voucher Purchase**: Online voucher purchasing system
- **Pricing Management**: Customer vs. Agent pricing
- **Generation Settings**: Voucher format configuration
- **Online Settings**: Duration and voucher profiles
- **Delivery Logs**: Voucher delivery tracking
- **Sales Analytics**: Voucher sales statistics

### 🌐 **Network Management**
- **ODP Management**: Database Optical Distribution Point
- **Interactive Map**: Network map powered by Leaflet.js
- **Capacity Monitoring**: Port usage visualization
- **GPS Coordinates**: ODP locations with precise coordinates
- **Status Tracking**: Active, Maintenance, Full
- **Cable Routes**: Cable route management per customer
- **ONU Devices**:ONU device database
- **Network Segments**: Network segment management
- **Maintenance Logs**: Infrastructure maintenance history

### 📟 **OLT Management** (NEW v1.3.0)
- **OLT Dashboard**: Monitoring all OLTs with ONU statistics
- **ONU Status**: Real-time status (Online, Offline, LOS, DyingGasp)
- **Optical Signal**: RX/TX Power monitoring with quality indicators
- **Hardware Monitoring**: Temperature and Fan speed (RPM)
- **PON Port Management**: Status and capacity per port
- **ONU Actions**: Reboot, status update, customer assignment
- **Status History**: Tracking ONU status changes
- **Search & Filter**: Search ONU by SN, MAC, or customer

### 👨‍💼 **Agent System**
- **Agent Management**: CRUD agen penjualan
- **Balance System**: Manajemen saldo deposit agen
- **Transaction History**: Riwayat transaksi lengkap
- **Balance Requests**: Sistem request topup saldo
- **Voucher Sales**: Tracking penjualan voucher per agen
- **Commission System**: Perhitungan komisi otomatis
- **Monthly Payments**: Pembayaran bulanan via agen
- **Notifications**: Sistem notifikasi untuk agen

### 🛠️ **Staff Management**
- **Technicians**: Field technician management
- **Collectors**: Payment collector management
- **Area Coverage**: Work area assignment
- **Performance Tracking**: Staff performance monitoring

### ⚙️ **System Settings**
- **Company Profile**: Company data configuration
- **Payment Gateway**: Midtrans/Xendit integration
- **WhatsApp Gateway**: Automated notifications via WA
- **Email Configuration**: SMTP setup for email
- **System Preferences**: General system settings

### 🔌 **Mikrotik Integration**
- **PPPoE Management**: Auto create/update/delete secrets, profile mapping, disconnect users
- **Hotspot Management**: User sessions, active connections, traffic monitoring
- **System Monitoring**: CPU, memory, uptime, interface statistics
- **Auto-sync**: Customer credentials sync with Mikrotik on create/update

### 📡 **GenieACS CPE Management**
- **Device Management**: List, view details, status monitoring (online/offline)
- **Remote Control**: Reboot, factory reset, refresh data, WiFi settings
- **Bulk Operations**: Bulk reboot, bulk refresh for multiple devices
- **TR-069 Protocol**: Full CWMP support for CPE provisioning

### 🛡️ **RADIUS Server Integration**
- **User Management**: Create, update, delete RADIUS users
- **Group/Profile**: Bandwidth profiles with rate limits
- **Session Monitoring**: Online users, session history (radacct)
- **CoA Support**: Disconnect and suspend/unsuspend users

### 📊 **SNMP Network Monitoring**
- **Device Monitoring**: System info, uptime, description
- **Traffic Statistics**: Interface in/out bandwidth (bps)
- **Resource Usage**: CPU and memory monitoring
- **Connectivity**: Ping and status checks

### 🔗 **CRM Integration**
- **Providers**: HubSpot, Salesforce, Zoho CRM
- **Features**: Contact sync, deal creation, activity logging
- **Bulk Sync**: Sync all customers to CRM

### 💼 **Accounting Integration**
- **Providers**: Accurate Online, Jurnal.id, Zahir
- **Features**: Customer sync, invoice sync, payment recording
- **Bulk Sync**: Sync all data to accounting software

---

## 🗄️ **Database Seeders**

The system comes equipped with 23 comprehensive seeders for dummy data:

### Core Data
- `UserSeeder` - Admin and staff users
- `AppSettingSeeder` - Application configuration
- `PackageSeeder` - Internet packages (10-100 Mbps)
- `VoucherPricingSeeder` - Voucher pricing

### Staff & Agents
- `TechnicianSeeder` - Technician data
- `CollectorSeeder` - Collector data
- `AgentSeeder` - Agent data (3 agents)
- `AgentBalanceSeeder` - Agent balances
- `AgentTransactionSeeder` - Agent transactions
- `AgentBalanceRequestSeeder` - Balance requests
- `AgentNotificationSeeder` - Agent notifications
- `AgentPaymentSeeder` - Payments via agents
- `AgentMonthlyPaymentSeeder` - Monthly payments
- `AgentVoucherSaleSeeder` - Voucher sales

### Network Infrastructure
- `OdpSeeder` - 5 ODPs with GPS coordinates
- `NetworkSegmentSeeder` - Network segments
- `CableRouteSeeder` - Customer cable routes
- `OnuDeviceSeeder` - ONU devices
- `CableMaintenanceLogSeeder` - Maintenance logs

### Customers & Billing
- `CustomerSeeder` - 5 dummy customers
- `InvoiceSeeder` - Monthly invoices

### Voucher System
- `VoucherPurchaseSeeder` - 20 voucher transactions
- `VoucherGenerationSettingSeeder` - Generator settings
- `VoucherOnlineSettingSeeder` - Online settings (1H-30D)
- `VoucherDeliveryLogSeeder` - Delivery logs

### Reports
- `MonthlySummarySeeder` - Summary for the last 3 months

**Full Documentation**: See `database/seeders/README.md`

---

## 🚀 Installation & Setup

### Prasyarat
- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js >= 18.x & NPM

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/rizkylab/gembok-lara.git
   cd gembok-lara
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure  Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   
   Edit `.env` dan sesuaikan database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gembok_lara
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Setup Database**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Build Assets**
   ```bash
   npm run build
   # atau untuk development
   npm run dev
   ```

6. **Run Server**
   ```bash
   php artisan serve
   ```

Access the application at:: `http://localhost:8000`

---

## 🔑  Demo Accounts

| Role | Email/Username | Password |
|------|----------------|----------|
| **Administrator** | `admin@gembok.com` | `admin123` |
| **Customer** | `pppoe-ahmad` or `081299887766` | `ahmad123` |

> Customers can login using: PPPoE username, username, mobile number, or email.

---

## 🛠️ Tech Stack

### Backend
- **Laravel 12** - PHP Framework
- **MySQL 8** - Database
- **Eloquent ORM** - Database abstraction

### Frontend
- **Blade Templates** - Templating engine
- **Tailwind CSS 3** - Utility-first CSS
- **Alpine.js** - Lightweight JavaScript
- **Chart.js 4** - Interactive charts
- **Leaflet.js** - Interactive maps
- **Font Awesome 6** - Icon library

### Tools & Libraries
- **Vite** - Frontend build tool
- **Composer** - PHP dependency manager
- **NPM** - JavaScript package manager

---

## 📁 Project Structure

```
gembok-lara/
├── app/
│   ├── Http/Controllers/Admin/  # Controllers
│   ├── Models/                   # Eloquent Models
│   └── Providers/                # Service Providers
├── database/
│   ├── migrations/               # Database migrations
│   └── seeders/                  # Database seeders
├── resources/
│   ├── views/admin/              # Blade templates
│   ├── css/                      # Stylesheets
│   └── js/                       # JavaScript
├── routes/
│   └── web.php                   # Route definitions
├── public/                       # Public assets
└── img/                          # Screenshots
```

---

## 🔒 Security

GEMBOK LARA is built following Laravel's high security standards:

- ✅ **Authentication** - Session-based with Bcrypt hashing
- ✅ **CSRF Protection** - Tokens enabled on all forms
- ✅ **SQL Injection Protection** - Powered by Eloquent ORM binding
- ✅ **XSS Protection** - Automatic escaping via Blade templates
- ✅ **Input Validation** - Strict server-side validation for all inputs
- ✅ **Password Hashing** - Secure Bcrypt with unique salts
- ✅ **Secure Headers** - Implementation of standard HTTP security headers

---

## 🔄 CI/CD Pipeline

This project utilizes **GitHub Actions** with automated security checks before deployment.

### Pipeline Flow

### Security Checks

#### SAST (Static Application Security Testing)
| Tool | Function |
|------|----------|
| **PHPStan** | Static analysis for PHP (level 5) |
| **Psalm** | Taint analysis for SQL injection and XSS detection |
| **Semgrep** | Pattern-based security scanning |
| **CodeQL** | GitHub's advanced security analysis |

#### Dependency Vulnerability Scan
| Tool | Function |
|------|----------|
| **Composer Audit** | Scans for vulnerabilities in PHP packages |
| **PHP Security Checker** | Checks against Symfony security advisories |
| **NPM Audit** | Scans for vulnerabilities in JavaScript packages |

### Workflow Triggers
- **Push to `main`**: Full pipeline + deployment to VPS
- **Push to `dev`**: Security checks + tests (no deployment)
- **Pull Request**: Security checks + tests

### Deployment
- Auto-deploy to VPS via SSH after all security checks pass
- Laravel optimization (config/route/view cache)
- Zero-downtime deployment

### Dependabot
- Automated dependency updates every week (Monday)
- Monitoring for: Composer, NPM, and GitHub Actions

See detailed configuration in `.github/workflows/ci-security.yml`

---

## 🗺️ Roadmap & Progress

### Phase 1 - Core System ✅ 100% Complete
| Feature | Status | Description |
|---------|--------|-------------|
| Customer Management | ✅ | CRUD, search, filter, status management |
| Package Management | ✅ | Pricing, bandwidth, PPPoE profile mapping |
| Invoice & Billing | ✅ | Auto-generate, print, payment tracking |
| Agent System | ✅ | Balance, transactions, voucher sales |
| Staff Management | ✅ | Technicians, collectors, area coverage |
| Voucher System | ✅ | Pricing, generation, online settings |
| Network Infrastructure | ✅ | ODP, cable routes, ONU devices |
| Analytics Dashboard | ✅ | Charts, statistics, real-time data |
| Modern UI/UX | ✅ | Tailwind CSS, responsive, dark sidebar |

### Phase 2 - Integration ✅ 100% Complete
| Feature | Status | Description |
|---------|--------|-------------|
| Mikrotik PPPoE | ✅ | Auto-sync secrets, profiles, disconnect |
| Mikrotik Hotspot | ✅ | User management, active sessions |
| GenieACS CPE | ✅ | TR-069, reboot, WiFi config, bulk ops |
| WhatsApp Gateway | ✅ | Fonnte/WaBlas, invoice notif, reminders |
| Payment Gateway | ✅ | Midtrans & Xendit, webhooks, auto-activate |
| Public Order System | ✅ | Package selection, payment, tracking |

### Phase 3 - Advanced Features ✅ 100% Complete
| Feature | Status | Description |
|---------|--------|-------------|
| Customer Portal | ✅ | Dashboard, invoices, payments, tickets, usage, profile |
| Agent Portal | ✅ | Voucher sales, balance, transactions |
| Collector Portal | ✅ | Invoice collection, payment processing |
| Technician Portal | ✅ | Tasks, installations, repairs, map |
| API Documentation | ✅ | Customer & Admin REST API |
| Advanced Reporting | ✅ | Daily/monthly reports, multi-format export |
| Automated Billing | ✅ | Auto-generate, reminders, suspend, reactivate |
| Public Voucher Store | ✅ | Online purchase, WhatsApp delivery |
| GUI Integration Settings | ✅ | Mikrotik, RADIUS, GenieACS, WhatsApp, Midtrans, Xendit |

### Phase 4 - Enterprise Features ✅ 100% Complete
| Feature | Status | Description |
|---------|--------|-------------|
| RADIUS Server | ✅ | FreeRADIUS, user/group management, CoA |
| SNMP Monitoring | ✅ | Device status, traffic, CPU/memory |
| Ticketing System | ✅ | Categories, priorities, assignments |
| CRM Integration | ✅ | HubSpot, Salesforce, Zoho sync |
| Accounting Integration | ✅ | Accurate, Jurnal, Zahir sync |
| Multi-language | ✅ | English & Indonesian, language switcher |

### Phase 5 - Future Enhancements 📋 Planned
| Feature | Status | Description |
|---------|--------|-------------|
| Mobile App | 📋 | Flutter-based mobile application |
| Multi-tenant | 📋 | Support multiple ISP companies |
| SMS Gateway | 📋 | SMS notification integration |
| Email Marketing | 📋 | Promotional email campaigns |
| SLA Monitoring | 📋 | Service level agreement tracking |

---

## 📝 Changelog

### Version 1.3.0 (Current - December 2025)
- ✅ OLT Management System for FTTH network monitoring
- ✅ ONU status monitoring (Online, Offline, LOS, DyingGasp)
- ✅ Optical signal monitoring (RX/TX Power, Temperature, Voltage)
- ✅ Fan status and temperature monitoring for OLT
- ✅ ONU reboot and status history tracking
- ✅ Customer assignment to ONU devices
- ✅ Customer portal login with PPPoE credentials
- ✅ GUI Integration Settings for all services (Mikrotik, RADIUS, GenieACS, WhatsApp, Midtrans, Xendit)

### Version 1.2.0 (December 2025)
- ✅ RADIUS Server Integration (FreeRADIUS)
- ✅ SNMP Network Monitoring
- ✅ CRM Integration (HubSpot/Salesforce/Zoho)
- ✅ Accounting Integration (Accurate/Jurnal/Zahir)
- ✅ Ticketing System with priorities & assignments
- ✅ Multi-language Support (EN/ID)
- ✅ Customer Portal (tickets, usage monitoring)
- ✅ Advanced Reporting (daily/monthly, CSV/JSON export)
- ✅ Automated Billing (auto-reactivate, WhatsApp reports)
- ✅ REST API with documentation

### Version 1.1.0 (November 2025)
- ✅ Mikrotik PPPoE & Hotspot Integration
- ✅ GenieACS CPE Management (TR-069)
- ✅ WhatsApp Gateway Integration
- ✅ Payment Gateway (Midtrans/Xendit)
- ✅ Multi-Portal System (Customer, Agent, Collector, Technician)
- ✅ Public Order & Voucher Store

### Version 1.0.0 (October 2025)
- ✅ Complete CRUD for all modules
- ✅ Modern UI with Cyan/Blue theme
- ✅ Interactive dashboard with Chart.js
- ✅ Network map with Leaflet.js
- ✅ 23 database seeders with realistic data
- ✅ Fully responsive design
- ✅ Print-ready invoice template
- ✅ Agent management system
- ✅ Voucher system
- ✅ ODP & network management
- ✅ Customer detail with statistics
- ✅ Revenue & growth analytics

---

## 🤝 Contribution

We highly appreciate your contributions!

1. Fork the repository
2. Create a new branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 💬 Support

- **Issues**: [GitHub Issues](https://github.com/rizkylab/gembok-lara/issues)
- **Discussions**: [GitHub Discussions](https://github.com/rizkylab/gembok-lara/discussions)

---

## ☕ Support Project

If this project is useful to you, please consider showing your support:

<a href="https://saweria.co/rizkylab" target="_blank">
  <img src="https://img.shields.io/badge/Saweria-Support%20Me-orange?style=for-the-badge&logo=buy-me-a-coffee&logoColor=white" alt="Support via Saweria">
</a>

Your support helps with the development of new features and project maintenance. Thank you! 🙏

---

## 📄 License

This project is licensed under the **MIT License**. See the `LICENSE` file for details.

---

## 🙏 Acknowledgments

This project was inspired by:
- **[Gembok Bill](https://github.com/alijayanet/gembok-bill)** by Ali Jaya Net

Special thanks to:
- Laravel Community
- Tailwind CSS Team
- Chart.js Contributors
- Leaflet.js Team

---

## 📞 Contact

**Developer**: Rizky Lab  
**Email**: rizkylab@gmail.com 
**GitHub**: [@rizkylab](https://github.com/rizkylab)

---

<div align="center">
  <strong>GEMBOK LARA</strong> - <em>Simplifying ISP Management</em>
  <br><br>
  Made with ❤️ using Laravel & Tailwind CSS
</div>
