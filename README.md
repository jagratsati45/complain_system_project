<div align="center">

<a href="https://github.com/jagratsati45/complain_system_project">
  <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Megaphone.png" width="110" alt="Megaphone"/>
</a>

# Local Service and Complaint Management System
### A role-based complaint tracking web application (PHP + MySQL)

<p>
  <a href="https://github.com/jagratsati45/complain_system_project/stargazers"><img alt="Stars" src="https://img.shields.io/github/stars/jagratsati45/complain_system_project?style=for-the-badge"></a>
  <a href="https://github.com/jagratsati45/complain_system_project/network/members"><img alt="Forks" src="https://img.shields.io/github/forks/jagratsati45/complain_system_project?style=for-the-badge"></a>
  <a href="https://github.com/jagratsati45/complain_system_project/issues"><img alt="Issues" src="https://img.shields.io/github/issues/jagratsati45/complain_system_project?style=for-the-badge"></a>
  <a href="https://github.com/jagratsati45/complain_system_project/blob/main/LICENSE"><img alt="License" src="https://img.shields.io/github/license/jagratsati45/complain_system_project?style=for-the-badge"></a>
</p>

<p>
  <img alt="PHP" src="https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white" />
  <img alt="MySQL" src="https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white" />
  <img alt="HTML" src="https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white" />
  <img alt="CSS" src="https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white" />
  <img alt="JS" src="https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black" />
</p>

<p><b>Status:</b> In Development • <b>Focus:</b> Multi-role auth + complaint routing • <b>Type:</b> College mini-project</p>

<a href="#-quick-start">Quick Start</a> •
<a href="#-features">Features</a> •
<a href="#-roles--permissions">Roles</a> •
<a href="#-project-structure">Structure</a> •
<a href="#-database-setup">Database</a> •
<a href="#-screenshots">Screenshots</a> •
<a href="#-contributing">Contributing</a>

<br/><br/>

</div>

---

## Why this project?
Complaint handling becomes messy when messages are scattered across chats/calls. This system centralizes complaints so:

- **Users** can raise issues and track progress
- **Departments** can manage assigned complaints and update statuses
- **Admins** can control routing, users/departments, and system oversight

---

## ✨ Features

<table>
  <tr>
    <th align="left">Feature</th>
    <th align="left">Description</th>
    <th align="center">Status</th>
  </tr>
  <tr>
    <td>🔐 Authentication</td>
    <td>Login/Register + role-based access (Admin/User/Department)</td>
    <td align="center">✅</td>
  </tr>
  <tr>
    <td>📝 Complaint Submission</td>
    <td>Create complaints with category and description</td>
    <td align="center">✅</td>
  </tr>
  <tr>
    <td>📂 Complaint Routing</td>
    <td>Assign complaints to departments</td>
    <td align="center">✅</td>
  </tr>
  <tr>
    <td>📌 Status Tracking</td>
    <td>Pending → In Progress → Resolved</td>
    <td align="center">✅</td>
  </tr>
  <tr>
    <td>🛡️ Admin Dashboard</td>
    <td>Central control panel for management</td>
    <td align="center">✅</td>
  </tr>
  <tr>
    <td>📊 Analytics</td>
    <td>Complaint counts, trends, department load</td>
    <td align="center">⏳ Planned</td>
  </tr>
  <tr>
    <td>📧 Notifications</td>
    <td>Email alerts on status change</td>
    <td align="center">⏳ Planned</td>
  </tr>
</table>

---

## 👥 Roles & Permissions

<details open>
  <summary><b>🙋 User</b></summary>
  <ul>
    <li>Create an account and login</li>
    <li>Submit new complaints</li>
    <li>Track complaint status</li>
    <li>View complaint history</li>
  </ul>
</details>

<details>
  <summary><b>🏢 Department</b></summary>
  <ul>
    <li>View complaints assigned to the department</li>
    <li>Update complaint status (Pending → In Progress → Resolved)</li>
    <li>Add resolution remarks/notes</li>
  </ul>
</details>

<details>
  <summary><b>🛡️ Admin</b></summary>
  <ul>
    <li>Manage users and departments</li>
    <li>Assign complaints to departments</li>
    <li>Oversee all complaint activity</li>
    <li>(Planned) View analytics dashboard</li>
  </ul>
</details>

---

## 🧱 Project Structure

```text
complain_system_project/
├── admin/                 # Admin dashboard & management pages
├── auth/                  # Authentication processors
│   ├── login_process.php
│   └── register_process.php
├── assets/
│   └── css/               # Shared stylesheets
├── config/                # Database connection & configuration
├── department/            # Department dashboard
├── user/                  # User dashboard & complaint pages
├── login.php              # Login page (entry point)
├── register.php           # Registration page
├── login.css              # Login page styles
├── register.css           # Register page styles
└── .gitignore
```

---

## 🛠 Tech Stack

- **Frontend:** HTML5, CSS3, Vanilla JavaScript  
- **Backend:** PHP (vanilla, no framework)  
- **Database:** MySQL  
- **Async requests:** Fetch API (AJAX)

---

## 🚀 Quick Start

### 1) Clone the repo
```bash
git clone https://github.com/jagratsati45/complain_system_project.git
```

### 2) Move into your server directory (XAMPP example)
**Windows**
```bash
cp -r complain_system_project C:/xampp/htdocs/
```

**Linux/Mac**
```bash
cp -r complain_system_project /opt/lampp/htdocs/
```

### 3) Start services
Start **Apache** and **MySQL** from the XAMPP Control Panel.

### 4) Configure DB connection
Open your DB config file (commonly `config/db.php`) and set credentials:

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

### 5) Run the project
Open:
```text
http://localhost/complain_system_project/login.php
```

---

## 🗄 Database Setup

> If your repo does not include a `.sql` file yet, create the database manually first, then import the schema when available.

1. Open phpMyAdmin:  
   `http://localhost/phpmyadmin`

2. Create database:
   - Name: `complain_system`

3. Import your SQL schema (recommended):
   - `complain_system.sql` (add this file to repo when ready)

---

## 🔐 Default Test Credentials

> Change these after first run (recommended).

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@system.com | admin123 |
| User | Register yourself | — |
| Department | Create via admin | — |

---

## 🖼 Screenshots

> Add screenshots in a folder like `assets/screenshots/` and link them here.

<details>
  <summary><b>Example placeholders (replace with real images)</b></summary>

  - `assets/screenshots/login.png`
  - `assets/screenshots/admin-dashboard.png`
  - `assets/screenshots/user-complaints.png`

</details>

---

## 🧩 Roadmap

- [ ] Add SQL schema file (`complain_system.sql`)
- [ ] Implement `password_hash()` + `password_verify()`
- [ ] Add session-based auth checks on all dashboards
- [ ] Add admin analytics dashboard
- [ ] Email notifications on complaint status updates
- [ ] Improve UI + mobile responsiveness

---

## 🤝 Contributing

Contributions are welcome.

```bash
# 1. Fork the project
# 2. Create your feature branch
git checkout -b feature/amazing-feature

# 3. Commit your changes
git commit -m "feat: add amazing feature"

# 4. Push to GitHub
git push origin feature/amazing-feature

# 5. Open a Pull Request
```

---

## 📄 License

MIT — see the [LICENSE](./LICENSE) file.

---

<div align="center">

### If you find this project useful, please ⭐ the repo
Made by <a href="https://github.com/jagratsati45">jagratsati45</a>

</div>
