# Azora Solution — Complete Laravel PHP Application

> **Production-Grade Laravel 13 Web Application & Digital Growth Platform**  
> Migrated from static HTML/JS architecture to modern Laravel PHP + Blade + Bootstrap 5.3 + MySQL.

---

## 🚀 Key Architectural Improvements & Highlights

1. **Full Laravel Architecture**:
   - Reusable Blade Layouts (`layouts/app.blade.php`).
   - Modular Blade Components (`<x-navbar />`, `<x-footer />`, `<x-google-map />`).
   - MVC Pattern with dedicated controllers: [`PageController`](app/Http/Controllers/PageController.php), [`LeadController`](app/Http/Controllers/LeadController.php), and [`DashboardController`](app/Http/Controllers/DashboardController.php).
   - Eloquent ORM with [`Lead`](app/Models/Lead.php) model and MySQL database persistence.
   - Branded transactional email notifications via [`LeadReceived`](app/Mail/LeadReceived.php) Mailable.

2. **100% Bootstrap 5.3 Frontend (Zero Tailwind)**:
   - Primary CSS framework: **Bootstrap 5.3.3** + **Bootstrap Icons**.
   - Grid System, Containers, Rows, Columns, Navbars, Dropdowns, Cards, Modals, Forms.
   - Futuristic dark glassmorphic design system maintained in [`public/assets/css/azora-modern.css`](public/assets/css/azora-modern.css).
   - Custom animations, scroll reveals, interactive counters, and custom desktop cursor preserved.

3. **Critical Global Header & Services Dropdown Fix**:
   - One single reusable Blade component: [`<x-navbar />`](resources/views/components/navbar.blade.php).
   - Identical on every page with working links and hover/tap support.
   - No broken relative paths or missing JavaScript event listeners.

4. **Master Global Footer (Portfolio Page Design)**:
   - Built as [`<x-footer />`](resources/views/components/footer.blade.php) using the master portfolio page aesthetic.
   - Consistent across all pages: Homepage, About, Services, Plans, Portfolio, Quote, and Success.
   - Includes the updated corporate headquarters address.

5. **Updated Corporate Address & Interactive Google Maps**:
   - Company address updated everywhere to:  
     `1015 GLENDALE CHASE CT, Morrisville, North Carolina, United States, 27560`
   - Reusable interactive Google Maps embed component: [`<x-google-map />`](resources/views/components/google-map.blade.php).
   - Embed URL: `https://www.google.com/maps?q=1015+Glendale+Chase+Ct,+Morrisville,+NC+27560&output=embed`
   - Responsive with direct "Get Directions" link.

6. **Complete Removal of POS & Hardware Content**:
   - All POS hardware listings, images, terminals, and menus have been removed.
   - Old hardware routes (`/hardware`, `/admin-inventory`) permanently redirect (301) to relevant digital services.
   - Hardware entries removed from `sitemap.xml` and `robots.txt`.

7. **Lead Capture & Secure Admin Command Center**:
   - Unified quote modal & form capture leads to MySQL `leads` table.
   - Protected Admin Command Center (`/dashboard`) with authentication, 7-day velocity chart, lead inspection drawer, and CSV export.

---

## 🛠 Tech Stack

- **PHP**: 8.2+ (Tested on PHP 8.3)
- **Framework**: Laravel 13.x
- **Template Engine**: Laravel Blade
- **CSS Framework**: Bootstrap 5.3.3 + Bootstrap Icons
- **Database**: MySQL / MariaDB (Database name: `azora_db`)
- **JavaScript**: Modern Vanilla JS + Bootstrap 5.3 Bundle (Popper.js)

---

## 📁 Project Structure

```text
E:\AZORA\
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── PageController.php       # Handles all public page routes
│   │       ├── LeadController.php       # Handles form submissions, API, & CSV export
│   │       └── DashboardController.php  # Handles admin authentication & command center
│   ├── Mail/
│   │   └── LeadReceived.php            # Transactional email notification mailable
│   └── Models/
│       └── Lead.php                    # Eloquent model for leads & quote inquiries
├── database/
│   └── migrations/
│       └── *_create_leads_table.php    # MySQL schema definition for leads
├── public/
│   ├── assets/
│   │   ├── css/
│   │   │   └── azora-modern.css        # Azora futuristic design system
│   │   ├── js/
│   │   │   ├── app.js                  # Global UI interactions, cursor, quote modal
│   │   │   └── data.js                 # Clean services and pricing plans data
│   │   └── vendor/
│   │       └── bootstrap/              # Bootstrap 5.3.3 & Bootstrap Icons local bundle
│   ├── robots.txt
│   └── sitemap.xml
├── resources/
│   └── views/
│       ├── components/
│       │   ├── navbar.blade.php        # Unified Global Navigation Header
│       │   ├── footer.blade.php        # Master Global Footer (Portfolio design)
│       │   └── google-map.blade.php    # Interactive Google Maps embed
│       ├── layouts/
│       │   └── app.blade.php           # Master Blade Layout
│       ├── pages/
│       │   ├── home.blade.php          # Homepage
│       │   ├── about.blade.php         # About Us
│       │   ├── services.blade.php      # Digital Services Overview
│       │   ├── plans.blade.php         # Pricing & Plans
│       │   ├── plans-services.blade.php# Plans & Services
│       │   ├── portfolio.blade.php     # Portfolio / Client Success
│       │   ├── quote.blade.php         # Custom Proposal Generator
│       │   └── success.blade.php       # Proposal Received Confirmation
│       ├── dashboard/
│       │   ├── login.blade.php         # Secure Admin Sign-in
│       │   └── index.blade.php         # Admin Command Center
│       └── emails/
│           └── lead-received.blade.php # Branded HTML email alert
├── routes/
│   └── web.php                         # Application route definitions
├── .env                                # Local environment settings
└── .env.example                        # Template environment settings
```

---

## 💻 Local Setup & Development Instructions

### 1. Requirements
Ensure you have the following installed on your machine:
- PHP 8.2 or higher (with `pdo_mysql`, `curl`, `mbstring`, `openssl` extensions enabled)
- Composer 2.x
- MySQL Server (e.g., via XAMPP, Laragon, or standalone MySQL)

### 2. Environment Configuration
Copy `.env.example` to `.env` if not already present:
```bash
cp .env.example .env
```

Ensure your database credentials in `.env` are set:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=azora_db
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Create MySQL Database & Run Migrations
Create the database in MySQL:
```sql
CREATE DATABASE IF NOT EXISTS azora_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Run Laravel migrations:
```bash
php artisan migrate
```

### 4. Run Application Server
Start the local development server:
```bash
php artisan serve --port=8000
```
Open your browser and navigate to:  
👉 **http://127.0.0.1:8000**

---

## 🔐 Admin Command Center Credentials

- **URL**: `http://127.0.0.1:8000/dashboard`
- **Email**: `admin@azorasolution.com`
- **Password**: `AzoraAdmin2026!`

*(These credentials can be customized anytime in `.env` under `ADMIN_EMAIL` and `ADMIN_PASSWORD`)*

---

## 🌐 Public Routes Summary

| URL Route | Page Name | Controller Action |
| :--- | :--- | :--- |
| `/` | Homepage | `PageController@home` |
| `/about` | About Us | `PageController@about` |
| `/services` | Services | `PageController@services` |
| `/plans` | Pricing & Plans | `PageController@plans` |
| `/plans-services`| Plans & Services | `PageController@plansServices` |
| `/portfolio` | Client Portfolio | `PageController@portfolio` |
| `/client-success`| Client Success Stories | `PageController@portfolio` |
| `/quote` | Request a Rapid Quote | `PageController@quote` |
| `/get-a-quote` | Get a Quote (Alias) | `PageController@quote` |
| `/success` | Confirmation Page | `PageController@success` |
| `/dashboard` | Admin Command Center | `DashboardController@index` |
| `/dashboard/login`| Admin Login | `DashboardController@login` |
| `/api/lead` | JSON Lead Endpoint | `LeadController@store` |
