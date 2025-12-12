# Reech CRM

Reech CRM is a Laravel-based web application.

---

## Requirements

Make sure you have the following installed on your machine:

-   PHP (8.x recommended)
-   Composer
-   Node.js & npm
-   MySQL
-   XAMPP (or Apache + MySQL)
-   Git

---

## Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/SimplyMon/reech.git
cd reech
```

### 2. Install Backend Dependencies

```bash
composer install
```

### 3. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Make sure to open xampp mysql, apache

### 5. Run migrations

```bash
php artisan migrate
```

### 6. Clear Cache and optimize

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize
```

### 7. Run migrations

```bash
npm install
npm run dev
```

### 8. Run the Application

```bash
php artisan serve
```
