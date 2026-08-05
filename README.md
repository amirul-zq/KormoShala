# KormoShala — Full-Stack Web Application

KormoShala is a **Laravel-based full-stack web application** that connects local workers and hirers through a structured role-based workflow system. It was developed to simplify local service hiring by enabling job posting, worker applications, assignment management, and service completion through secure, role-specific workflows.

> **Live Demo:** https://kormoshala-production.up.railway.app/  
> **Repository:** https://github.com/amirul-zq/KormoShala

---

# 📌 Project Overview

KormoShala demonstrates practical software engineering concepts through a real-world web application.

### Worker
- Browse available jobs
- Apply for jobs
- Manage assigned work
- Complete tasks
- Submit ratings and reviews

### Hirer
- Create job posts
- Review applications
- Select workers
- Manage assignments
- Rate completed work

### Administrator
- Manage platform users
- Monitor system activities

---

# ✨ Key Features

- Role-based Authentication & Authorization
- Laravel MVC Architecture
- Job Posting & Application Workflow
- Worker Selection & Assignment
- Rating & Review System
- Relational Database Design
- Server-side Validation
- CSRF Protection
- Eloquent ORM Relationships

---

# 🛠️ Technology Stack

## Backend
- PHP
- Laravel
- Eloquent ORM

## Frontend
- Blade
- Tailwind CSS
- HTML
- JavaScript

## Database
- MySQL

## Development Tools
- Git
- GitHub
- Composer
- Vite
- Node.js
- NPM

---

# 📸 Screenshots

## Home Page
![Home Page](./screenshots/home.png)

## Hirer Dashboard
![Hirer Dashboard](./screenshots/hirer.png)

## Worker Dashboard
![Worker Dashboard](./screenshots/worker.png)

## Admin Dashboard
![Admin Dashboard](./screenshots/admin1.png)
![Admin Dashboard](./screenshots/admin2.png)


---

# 🏗️ Software Engineering Concepts

- Object-Oriented Programming (OOP)
- MVC Architecture
- CRUD Operations
- Authentication & Authorization
- Role-Based Access Control
- Relational Database Design
- Database Normalization
- Business Logic Implementation
- Secure Web Application Development

---

# 📂 Suggested Repository Structure

```text
KormoShala/
├── README.md
├── screenshots/
│   ├── home.png
│   ├── hirer.png
│   ├── worker.png
│   ├── admin1.png
│   └── admin2.png
├── app/
├── database/
├── public/
├── resources/
└── routes/
```

---

# ⚙️ Local Setup

```bash
git clone https://github.com/amirul-zq/KormoShala.git
cd KormoShala
composer install
npm install
cp .env.example .env
php artisan key:generate
# Configure database credentials in .env
php artisan migrate
npm run build
php artisan serve
```

---

# 🧪 Manual Testing

- Authentication flow
- Role-based authorization
- Job creation
- Job application
- Worker selection
- Assignment completion
- Rating & review workflow

---

# 🔮 Planned Improvements

- REST API
- Real-time notifications
- Payment integration
- Automated testing

---

# 👨‍💻 Author

**Amirul Alam**

- GitHub: https://github.com/amirul-zq
