<div align="center">

<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Megaphone.png" alt="Megaphone" width="120" />

# 📋 Complaint Management System

### *A role-based complaint tracking web application*

<br/>

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

<br/>

![Status](https://img.shields.io/badge/Status-In%20Development-orange?style=flat-square)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)
![PRs Welcome](https://img.shields.io/badge/PRs-Welcome-brightgreen?style=flat-square&logo=github)
![Made with Love](https://img.shields.io/badge/Made%20with-❤️-red?style=flat-square)

</div>

---

## 📌 Table of Contents

- [About the Project](#-about-the-project)
- [Features](#-features)
- [User Roles](#-user-roles)
- [Project Structure](#-project-structure)
- [Tech Stack](#-tech-stack)
- [Getting Started](#-getting-started)
- [Database Setup](#-database-setup)
- [Screenshots](#-screenshots)
- [Contributing](#-contributing)
- [License](#-license)

---

## 🧾 About the Project

> 🎯 **Complaint Management System** is a full-stack web application that provides an organized platform for users to **submit complaints**, departments to **resolve them**, and admins to **oversee the entire process** — all from a clean, role-based dashboard.

This project was built as a **college mini-project** to demonstrate multi-role authentication, CRUD operations, and department-based complaint routing using **vanilla PHP + MySQL** — no heavy frameworks, just clean fundamentals.

Whether you're a student, institution, or organization — this system helps bridge the gap between complaint-raiser and resolver. 🚀

---

## ✨ Features

| Feature | Status |
|---|---|
| 🔐 User Registration & Login | ✅ Done |
| 👤 Role-based Authentication (Admin / User / Department) | ✅ Done |
| 📝 Complaint Submission | 🚧 In Progress |
| 📂 Department-wise Complaint Routing | 🚧 In Progress |
| ✅ Complaint Status Tracking | 🚧 In Progress |
| 🛠️ Admin Dashboard | 🚧 In Progress |
| 📊 Complaint Analytics | ⏳ Planned |
| 📧 Email Notifications | ⏳ Planned |

---

## 👥 User Roles

The system has **three distinct roles**, each with its own dashboard and access level:

### 🙋 User
- Register and log in to the system
- Submit new complaints with description and category
- Track the status of submitted complaints
- View complaint history

### 🏢 Department
- Log in to a department-specific dashboard
- View complaints assigned to the department
- Update complaint status (Pending → In Progress → Resolved)
- Add resolution notes or remarks

### 🛡️ Admin
- Full system oversight from a central dashboard
- Manage all users and departments
- Assign complaints to appropriate departments
- View analytics and complaint statistics
- Delete or escalate complaints

---

## 🗂️ Project Structure

```
complain_system_project/
│
├── 📁 admin/               # Admin dashboard & management pages
├── 📁 auth/                # Authentication processors
│   ├── login_process.php
│   └── register_process.php
├── 📁 assets/
│   └── css/               # Shared stylesheets
├── 📁 config/              # Database connection & configuration
├── 📁 department/          # Department dashboard
├── 📁 user/                # User dashboard & complaint pages
│
├── 📄 login.php            # Login page (entry point)
├── 📄 register.php         # Registration page
├── 📄 login.css            # Login page styles
├── 📄 register.css         # Register page styles
└── 📄 .gitignore
```

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| 🖥️ Frontend | HTML5, CSS3, Vanilla JavaScript |
| ⚙️ Backend | PHP (vanilla, no framework) |
| 🗄️ Database | MySQL |
| 🔗 Communication | Fetch API (AJAX) |
| 🎨 Styling | Custom CSS |

---

## 🚀 Getting Started

### Prerequisites

Make sure you have the following installed:

- ![XAMPP](https://img.shields.io/badge/XAMPP-FB7A24?style=flat-square&logo=xampp&logoColor=white) **XAMPP** (or any local server with PHP + MySQL)
- A browser (Chrome, Firefox, etc.)
- Git

---

### 🧰 Installation

**1. Clone the repository**

```bash
git clone https://github.com/jagratsati45/complain_system_project.git
```

**2. Move to your server's root directory**

```bash
# For XAMPP on Windows
cp -r complain_system_project C:/xampp/htdocs/

# For XAMPP on Linux/Mac
cp -r complain_system_project /opt/lampp/htdocs/
```

**3. Start Apache & MySQL** from the XAMPP Control Panel

**4. Set up the database** (see [Database Setup](#-database-setup) below)

**5. Configure the DB connection**

Open `config/db.php` (or similar) and update:

```php
<?php
$host     = "localhost";
$username = "root";
$password = "";          // your MySQL password
$database = "complain_system";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

**6. Open the app in your browser**

```
http://localhost/complain_system_project/login.php
```

---

## 🗄️ Database Setup

Open **phpMyAdmin** → Create a new database named `complain_system` → Run the following SQL:

```sql
-- Create database
CREATE DATABASE IF NOT EXISTS complain_system;
USE complain_system;

-- Users table
CREATE TABLE users (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    email       VARCHAR(150) UNIQUE NOT NULL,
    password    VARCHAR(255) NOT NULL,
    role        ENUM('admin', 'user', 'department') DEFAULT 'user',
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Departments table
CREATE TABLE departments (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    email       VARCHAR(150) UNIQUE NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Complaints table
CREATE TABLE complaints (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT NOT NULL,
    department_id   INT,
    title           VARCHAR(200) NOT NULL,
    description     TEXT NOT NULL,
    status          ENUM('pending', 'in_progress', 'resolved') DEFAULT 'pending',
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

-- Default admin account (password: admin123)
INSERT INTO users (name, email, password, role)
VALUES ('Admin', 'admin@system.com', '$2y$10$examplehashedpassword', 'admin');
```

> ⚠️ **Note:** Always use `password_hash()` in PHP for storing passwords. Never store plain text passwords.

---

## 🔐 Default Test Credentials

| Role | Email | Password |
|---|---|---|
| Admin | admin@system.com | admin123 |
| User | Register yourself | — |
| Department | Set up via admin | — |

---

## 🤝 Contributing

Contributions are **always welcome**! Here's how you can help:

```bash
# 1. Fork the project
# 2. Create your feature branch
git checkout -b feature/AmazingFeature

# 3. Commit your changes
git commit -m "feat: add AmazingFeature"

# 4. Push to the branch
git push origin feature/AmazingFeature

# 5. Open a Pull Request 🎉
```

### 💡 Ideas for Contributions

- [ ] Add `README` (you're reading it! ✅)
- [ ] Build the complaint submission page
- [ ] Add session-based auth checks on all dashboards
- [ ] Implement `password_hash()` in registration
- [ ] Add SQL schema file to the repo
- [ ] Build admin analytics dashboard
- [ ] Add email notifications on complaint status change
- [ ] Make the UI mobile-responsive

---

## 📄 License

Distributed under the **MIT License**. See `LICENSE` for more information.

---

<div align="center">

### 🌟 If you find this project helpful, give it a star!

[![Star on GitHub](https://img.shields.io/github/stars/jagratsati45/complain_system_project?style=social)](https://github.com/jagratsati45/complain_system_project)

<br/>

Made with ❤️ by [jagratsati45](https://github.com/jagratsati45)


</div>
