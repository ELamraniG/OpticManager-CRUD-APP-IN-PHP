# 💎  OPTIRENT (OpticManager)
**A Comprehensive Optical Clinic & Retail Management Suite**

Optirent is a feature-rich web application designed to handle the end-to-end operations of optical stores and clinics. It bridges the gap between medical consultation and retail sales.

### 🌟 Key Performance Modules

#### 📊 Advanced Analytics Dashboard
- **Real-time KPIs**: Track 30-day revenue trends, daily consultation volumes, and critical stock alerts.
- **Demographics Tracking**: Automated patient age distribution charts using **Chart.js**.
- **Revenue Intelligence**: Daily turnover tracking and financial snapshots.

#### 🏥 Clinical & Prescription Workflow
- **Electronic Medical Records (EMR)**: Manage detailed patient profiles and complete consultation histories.
- **Automated Prescriptions**: Generate professional PDF prescriptions (*Ordonnances*) including sphere, cylinder, and axis measurements using the **FPDF** engine.
- **Appointment Scheduler**: Centralized management for patient visits and follow-ups.

#### 📦 Inventory & Supply Chain Intelligence
- **Smart Stock Alerts**: Visual notifications and high-priority alerts when products fall below safe thresholds.
- **Supplier CRM**: Manage procurement flows with dedicated supplier records and purchase order tracking.
- **Multi-Category Catalog**: Organize products by type, brand, and taxable margins (TVA).

#### 🛒 Point of Sale (POS) & Billing
- **Direct Transaction Handling**: Seamlessly convert consultations into sales.
- **Detailed Invoicing**: Full record-keeping of payment modes, unit prices, and transaction details.

### 🔐 Role-Based Access Control (RBAC)
The system implements a secure permission hierarchy:
- **Administrator**: Full system control including user management, financial statistics, and configuration.
- **Optician**: Focused access to clinical tools, patient records, and sales.
- **Assistant**: Optimized for appointment scheduling and front-desk tasks.

### 🛠️ Technical Architecture
- **Backend**: PHP 8.x with Procedural/Modular structure.
- **Database**: MySQL (Relational Schema with Cascading Integrity).
- **Frontend**: Bootstrap 5.3, Custom Slate-Emerald UI Theme.
- **Libraries**:
    - **Chart.js**: Dynamic data visualization.
    - **DataTables**: High-performance, searchable lists.
    - **FPDF**: Server-side PDF generation.
    - **Boxicons & FontAwesome**: Modern, semantic iconography.

---


## 🚀 Getting Started

### Prerequisites
- PHP Server (XAMPP, WAMP, or Linux/Apache)
- MySQL Database Engine
- Visual Studio (for AssoManager)

### Installation (Optirent)
1. **Database Setup**:
    - Create a database named `optirent`.
    - Import the SQL files in order: `les table.sql`, `les table_continue1.sql`, and `lestable_continue2.sql`.
2. **Configuration**:
    - Adjust `connexion.php` with your local DB credentials.
3. **Run**:
    - Navigate to `index-main.php` on your local server.
4. **Login**:
    - **Admin**: `admin` / `admin`
    - **Optician**: `opticien1` / `opticien123`

---

*Developed as part of the SUPISI Software Development curriculum.*
