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
cd reech-crm
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

### 4. open xampp mysql, apache

### 5. Run migrations

```bash
php artisan migrate
```

### 6. Run migrations

```bash
npm install
npm run build
npm run dev
```

### 7. Run the Application

```bash
composer run dev
```
