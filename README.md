# Laravel Flower Shop - README

## Introduction

This is an online flower shop project built using the MVC model with Laravel. This project allows users to browse products, place orders, manage orders, and handle inventory.

## System Requirements

- PHP >= 8.3
- Composer
- MySQL
- Laravel >= 10.x

## Installation Guide

### 1. Clone the Project
```bash
  git clone https://github.com/huyhenry02/mvc-shop-flower.git
  cd mvc-shop-flower
```

### 2. Install PHP Packages
```bash
  composer install
```

### 3. Configure Environment
```bash
  cp .env.example .env
```
Then, open the `.env` file and set the appropriate database details:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shop_flower
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key
```bash
  php artisan key:generate
```

### 5. Run Migrations and Seed Sample Data
```bash
  php artisan migrate --seed
```

### 6. Start the Server
```bash
  php artisan serve
```
Open your browser and access:
```
http://127.0.0.1:8000
```

## Directory Structure
```
├── app/             # Contains backend code (Models, Controllers,...)
├── bootstrap/       # Bootstrap files
├── config/          # Application configuration
├── database/        # Migrations, Seeders
├── public/          # Static files like images, CSS, JS
├── resources/       # Blade templates, CSS, JS
├── routes/          # Defines routes (web.php, api.php)
├── storage/         # Cache, logs
├── tests/           # Unit tests
└── vendor/          # Packages installed via Composer
```

## Default Accounts
After seeding the data, you can log in with:
- **Admin**: `sandbox.duchuy02@gmail.com` / `1`
- **User**: `nguyen_a@gmail.com` / `1`

## Contact
For any issues, please contact via email: `sandbox.duchuy02@gmail.com`.

