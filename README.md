<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200" alt="Laravel Logo"/>
</p>

<h1 align="center">🔧 FocusAuto — Real-Time Car Service Status Tracking</h1>

<p align="center">
  A web-based real-time vehicle service tracking system built for FocusAuto Repair Shop Kalasey.
  <br/>
  <em>Undergraduate Thesis Project — Information Systems, Sam Ratulangi University, 2026</em>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-red?logo=laravel" alt="Laravel"/>
  <img src="https://img.shields.io/badge/PHP-8.x-blue?logo=php" alt="PHP"/>
  <img src="https://img.shields.io/badge/Bootstrap-5-purple?logo=bootstrap" alt="Bootstrap"/>
  <img src="https://img.shields.io/badge/MySQL-Database-orange?logo=mysql" alt="MySQL"/>
  <img src="https://img.shields.io/badge/XAMPP-Local%20Server-green" alt="XAMPP"/>
  <img src="https://img.shields.io/badge/SUS%20Score-85.25%20%E2%80%94%20Excellent-brightgreen" alt="SUS Score"/>
</p>

---

## 📖 About This Project

**FocusAuto** is a web-based real-time car service status tracking system developed as an undergraduate thesis project. The system was built to address the operational challenges at **FocusAuto Repair Shop Kalasey**, where service progress updates were previously delivered manually through WhatsApp and phone calls — causing delays, inconsistency, and lack of transparency for customers.

This system allows:
- **Admins** to manage customer data, update service progress in real time, and generate invoices.
- **Customers** to independently monitor their vehicle's service status, view invoices, and access service history — all through a clean, mobile-friendly web interface.

The system was developed using the **Rapid Application Development (RAD)** methodology and evaluated using **Blackbox Testing** and the **System Usability Scale (SUS)**, achieving an average SUS score of **85.25 (Excellent)**.

---

## ✨ Features

### 👤 Admin
- Secure login with username & password
- Dashboard with real-time service statistics and monthly income chart
- Customer & vehicle data management (Add, Edit, Delete, Search)
- Service progress tracking with status updates and photo uploads
- Invoice generation with PDF export (including 11% tax calculation)
- Admin account management
- Service history view

### 🚗 Customer
- Login using registered vehicle plate number
- Real-time service tracking with progress stepper
- Pop-up notification when service status is updated
- Invoice viewing, downloading, and printing
- Service history records

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Backend Framework | Laravel (PHP) |
| Frontend | Bootstrap 5, Blade Templating |
| Database | MySQL |
| Local Server | XAMPP (Apache + phpMyAdmin) |
| Development Method | Rapid Application Development (RAD) |
| Testing | Blackbox Testing, System Usability Scale (SUS) |

---

## 🚀 Installation & Setup

### Prerequisites
- PHP >= 8.1
- Composer
- XAMPP (or any local server with MySQL)
- Node.js & NPM

### Steps

1. **Clone the repository**
```bash
   git clone https://github.com/mystrygrdn/your-repo-name.git
   cd your-repo-name
```

2. **Install dependencies**
```bash
   composer install
   npm install && npm run build
```

3. **Configure environment**
```bash
   cp .env.example .env
   php artisan key:generate
```

4. **Set up the database**
   - Create a new MySQL database (e.g., `focusauto_db`)
   - Update `.env` with your database credentials:
