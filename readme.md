# EASY&CO — Luxury Condo Accommodation & Online Booking System

**EASY&CO** is a full-stack luxury condominium accommodation and online reservation platform built with **CodeIgniter 4 (PHP 8.3)**, **Tailwind CSS**, and **MySQL / SQLite3**. Inspired by botanical garden living (`123 Aurora Boulevard, Quezon City`), EASY&CO blends a serene nature-inspired hospitality storefront with an interactive Flatpickr booking engine, digital payment gateway simulation (GCash, Maya, QR Ph), and an administrative management suite.

---

## Key Features

### Guest Experience
- **Nature-Inspired Editorial Showcase**: Immersive gallery, curated amenities showcase, guest reviews, interactive moodboard (`/mb`), and product roadmap (`/rm`).
- **Real-Time Date Conflict & Pricing Engine**: Flatpickr calendar automatically disables booked dates via `/booking/get-booked-dates`, enforces stay duration and guest capacity rules, and dynamically computes nightly rates + cleaning fees.
- **Multi-Channel Digital Payment Flow**: Supports **GCash**, **Maya (PayMaya)**, and **QR Ph** checkout flows with server-generated transaction IDs (`TXN-...`) and instant booking confirmation receipts.
- **Guest Booking Portal**: View upcoming, pending, completed, and cancelled reservations (`/bookings`), inspect itemized booking receipts, and cancel eligible upcoming stays.

### Admin Dashboard (`/admin/dashboard` & `/admin/bookings`)
- **Executive KPI Analytics**: Real-time tracking of Total Earnings, Active Confirmed Bookings, Registered Users, and Monthly Booking Growth.
- **Reservation Lifecycle Management**: Search, filter by status or check-in/check-out window, inspect guest details, adjust booking dates/guests with automatic price recalculation, and update statuses (`pending`, `confirmed`, `completed`, `cancelled`, `rejected`).

---

## Demo Credentials (Auto-Seeded on First Boot)

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@easyco.com` | `EasyCo2025!` |
| **Client** | `billieeilish@gmail.com` | `Billie08` |

---

## Deploying to Railway

This repository is pre-configured for zero-config deployment on **Railway**:
1. Push this repository to GitHub and create a new project in Railway from the repository.
2. Railway automatically detects the root `Dockerfile` and `railway.json`.
3. **Database Options**:
   - **Zero-Config SQLite (Default)**: Works immediately out-of-the-box using `/app/writable/easyco.db`, running migrations and seeding the property, demo users, and sample bookings automatically on startup.
   - **Railway MySQL**: Add a MySQL service in Railway and link `MYSQL_URL` (or `MYSQLHOST`, `MYSQLUSER`, `MYSQLPASSWORD`, `MYSQLDATABASE`, `MYSQLPORT`) — `app/Config/Database.php` automatically switches to MySQL when detected.
