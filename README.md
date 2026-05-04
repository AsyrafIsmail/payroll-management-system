# Payroll Management System

This is a Laravel-based Payroll Management System developed as part of a technical assessment.  
The application manages departments, employees, payroll processing, and payslip generation.

---

## Features

- User authentication using Laravel Breeze
- Department management (CRUD)
- Employee management (CRUD)
- Payroll processing with automated calculations
- Payroll history with filtering (month, year, department)
- Payslip generation
- Export payslip as PDF
- Unit testing using Pest
- Dockerized environment

---

## Tech Stack

- Laravel (PHP)
- MySQL
- Blade (UI)
- Tailwind CSS
- Vite
- Pest (Testing)
- Docker

---

## Setup Instructions

The application can be run using either a local environment or Docker.

---

## Option 1: Local Setup (Herd / XAMPP / Laragon)

### 1. Clone repository

```bash
git clone <repository-url>
cd payroll-management
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Update database configuration in .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=payroll_management
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run migrations and seeders

```bash
php artisan migrate:fresh --seed
```

### 5. Run frontend

```bash
npm run dev
```

### 6. Access application
Using Herd:
```bash
http://payroll-management.test
```
Or:
```bash
php artisan serve
```

## Option 2: Docker Setup

### 1. Create environment file

```bash
cp .env.docker.example .env.docker
```

### 2. Build and start containers

```bash
docker compose up -d --build
```

### 3. Enter Container

```bash
docker exec -it payroll_app bash
```

### 4. Setup Laravel

```bash
php artisan key:generate
php artisan migrate:fresh --seed
php artisan optimize
```

### 5. Build frontend assets (on host machine)
```bash
npm install
npm run build
```

### 6. Access application
http://localhost:8000

---

## Database

- Local setup uses system MySQL
- Docker setup uses a MySQL container

These environments use separate databases.

---

## Default Login

- Email: nikasyraf@gmail.com
- Password: password

These environments use separate databases.

---

## Payroll Calculation

```bash
Overtime Pay = Overtime Hours × Hourly Rate

Gross Pay = Basic Salary + Allowance + Overtime Pay

Tax (8%) = Gross Pay × 0.08
EPF Employee (11%) = Gross Pay × 0.11
EPF Employer (13%) = Gross Pay × 0.13

Net Pay = Gross Pay - Tax - EPF Employee
```

---

## Running Tests

```bash
php artisan test
```
Unit tests cover payroll calculation logic using Pest.

---

## Assumptions and Decisions

- Payroll records store calculated values (e.g. gross_pay, net_pay) to preserve computed results
- Employee salary data (e.g. basic salary, allowance) is retrieved dynamically from the employee table
- This implementation follows the provided database structure without introducing additional snapshot fields
- Employee updates may affect how historical payroll data is displayed
- Docker is included to provide a consistent development environment
- Frontend assets are compiled using `npm run build` for Docker setup

---

## Notes
If switching between Docker and local environment, clear cache:
```bash
php artisan optimize:clear
```

---

## Project Structure

app/
  Services/PayrollCalculationService.php

tests/
  Unit/PayrollCalculationTest.php

resources/views/
  employees/
  departments/
  payroll/
  payslip/

docker-compose.yml
Dockerfile

---

## Author
Nik Muhammad Asyraf Bin Nik Ismail

---

## Submission Notes

This project fulfills the technical assessment requirements, including:

- CRUD operations
- Payroll processing logic
- Payslip generation
- Unit testing
- Docker setup
- Clear documentation

---
