# Laravel Tailwind Template

A clean Laravel template project using **Laravel** and **Tailwind CSS** with a well-organized structure. This template provides a ready-to-use starting point for modern web applications with Laravel and Tailwind.

**Made by Simon Pasag | All Rights Reserved**

## Features

-   Laravel PHP framework
-   Tailwind CSS for modern styling
-   Clean and organized project structure
-   Pre-configured build tools (Vite + npm)
-   Optimized for development and production

## Requirements

-   PHP >= 8.x
-   Composer
-   Node.js & npm
-   MySQL or other supported database (optional for local setup)

## Installation

Follow these steps to set up the project locally:

```bash
# Clone the repository
git clone https://github.com/SimplyMon/laravel-temp.git

# Navigate into the project folder
cd laravel-temp

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Migrations
php artisan migrate

# Optimize Laravel performance
php artisan optimize

# Alternatively, build assets for production
npm run build

# Build assets for development
npm run dev

# Start the local development server
composer run dev
```

## License

© 2025 Simon Pasag. All Rights Reserved.
