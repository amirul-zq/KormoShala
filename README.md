# KormoShala

A modern Laravel-based local worker marketplace for Bangladesh that connects Hirers and Workers through a simple, secure, and user-friendly platform.

---

# Project Overview

KormoShala allows users to:

- Register as a Hirer or Worker
- Create and manage job postings
- Browse available jobs
- Apply for jobs
- Select workers for jobs
- Complete jobs
- Submit reviews and ratings
- Manage the platform through an Admin Panel

---

# Technology Stack

- Laravel
- Blade
- Tailwind CSS
- MySQL
- Vite
- PHP 8.3+

---

# Prerequisites

Before running the project, install the following software:

- Git
- PHP 8.3 or later
- Composer
- Node.js (LTS)
- MySQL Server 8.x

---

# Getting Started

## 1. Clone the Repository

Open **Command Prompt**, **PowerShell**, or **VS Code Terminal**.

Navigate to your preferred directory.

```bash
cd C:\Projects
```

Clone the repository.

```bash
git clone <repository-url>
```

Enter the project folder.

```bash
cd KormoShala
```

---

## 2. Install Project Dependencies

Install PHP dependencies.

```bash
composer install
```

Install JavaScript dependencies.

```bash
npm install
```

---

## 3. Configure the Environment

If the repository already contains a `.env` file, no action is required.

Otherwise, copy the provided `.env` file into the project root before running the project.

---

## 4. Configure the Database

1. Start your MySQL Server.
2. Create a database named:

```text
kormoshala
```

3. Import the provided database backup:

```text
kormoshala.sql
```

4. Ensure the database credentials inside the `.env` file match your local MySQL configuration.

Example:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kormoshala
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

---

## 5. Run the Project

Open **two terminals** inside the project directory.

### Terminal 1

Start the Vite development server.

```bash
npm run dev
```

Leave this terminal running.

---

### Terminal 2

Start the Laravel development server.

```bash
php artisan serve
```

---

## 6. Open the Application

Open your browser and visit:

```
http://127.0.0.1:8000
```

The project should now be running successfully.

---

# Default Login Credentials

Use the credentials available in the imported database.

Example:

### Admin

Email

```text
admin@kormoshala.com
```

Password

```text
password
```

---

# Troubleshooting

## PHP Not Found

Verify PHP installation.

```bash
php -v
```

---

## Composer Not Found

Verify Composer installation.

```bash
composer -V
```

---

## Node.js Not Found

Verify installation.

```bash
node -v

npm -v
```

---

## Database Connection Error

Ensure that:

- MySQL Server is running.
- The `kormoshala` database exists.
- The database has been imported successfully.
- The `.env` database credentials are correct.

---

## Frontend Assets Not Loading

Run:

```bash
npm run dev
```

Keep the Vite server running while using the application.

---

## Port 8000 Already in Use

Run Laravel on another port.

```bash
php artisan serve --port=8001
```

Then open:

```
http://127.0.0.1:8001
```

---

# Daily Startup

Whenever you want to run the project:

Open two terminals inside the project folder.

**Terminal 1**

```bash
npm run dev
```

**Terminal 2**

```bash
php artisan serve
```

Open your browser and visit:

```
http://127.0.0.1:8000
```

---

# Project Structure

```
KormoShala/
│
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── vendor/
├── package.json
├── composer.json
├── README.md
└── .env
```

---

# License

This project was developed for academic purposes as part of a university software development project.