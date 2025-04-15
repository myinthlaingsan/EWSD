
# 🎓 EWSD (Enterprise Web Software Development) System

A role-based PHP web application to manage users, assign roles and permissions, submit and analyze article contributions by students, generate statistical reports, and send email notifications.

---

## 🚀 Getting Started

Follow the instructions below to run this project locally.

---

### 🧩 1. Install Composer

If Composer is not installed on your system:

- Visit [https://getcomposer.org/](https://getcomposer.org/)
- Download and install Composer
- Verify installation in your terminal:

```bash
composer
```

---

### 📂 2. Project Setup

- Open the project in **VS Code**
- In the terminal, run:

```bash
composer install
```

If there's no `composer.json`, create one:

```bash
composer init
```

Then in `composer.json`, add the following under `"autoload"`:

```json
"autoload": {
    "psr-4": {
        "Helpers\": "_classes/Helpers/",
        "Libs\": "_classes/Libs/"
    }
}
```

Finally, generate autoload files:

```bash
composer dump-autoload
```

---

### 🗃️ 3. Database Setup

#### ✅ Option A: Manual Creation

- Open **phpMyAdmin**
- Create a database named: `ewsd`

#### ✅ Option B: Import Existing Structure

- Import the provided `ewsd.sql` into phpMyAdmin

---

### 🔌 4. Configure Database Connection

- Open your browser and visit:

```
http://localhost/ewsd/_classes/Libs/Database/MySQL.php
```

> (This will test the DB connection)

If you're starting fresh, use:

```
http://localhost/ewsd/_classes/Libs/Database/Setup.php
```

> (This creates necessary tables)

---

### 🔐 5. Login and Test Users

Go to:

```
http://localhost/ewsd/src/Auth/design/login.php
```

Use one of the credentials below to log in:

| Role        | Email                | Password  |
|-------------|----------------------|-----------|
| Admin       | admin@gmail.com      | password  |
| Manager     | manager@gmail.com    | password  |
| Coordinator | coor@gmail.com       | password  |
| Student     | student@gmail.com    | password  |
| Guest       | guest@gmail.com      | password  |

---

### 🧰 6. Role Management

- After logging in as **Admin**:
  - Create new **Roles**
  - Assign **Roles** to Users
  - Assign **Permissions** to Roles

---

### ✉️ 7. Optional: Email Testing with Mailtrap

To test email functionality:

1. Register at [https://mailtrap.io](https://mailtrap.io)
2. Navigate to **Email Testing > My Inbox**
3. Copy your **SMTP credentials**
4. Edit `_classes/Helpers/Mailers.php` and update your username/password
5. Test the setup by visiting:

```
http://localhost/ewsd/_classes/Helpers/test.php
```

> You should see test email in your Mailtrap inbox.

---

## 🧪 Required Tools

- PHP 7.4 or higher
- MySQL or MariaDB
- XAMPP or similar local server
- Composer
- PHPMailer (auto-installed via composer)

To install PHPMailer:

```bash
composer require phpmailer/phpmailer
```

---

## 📁 Project Structure

```
ewsd/
├── _classes/
│   ├── Helpers/
│   └── Libs/
│       └── Database/
├── src/
│   ├── Auth/
│   │   └── design/
│   └── Admin/
│       └── design/
├── public/
├── ewsd.sql
├── composer.json
└── README.md
```

---

## 🔍 Useful URLs

| Purpose           | URL                                                         |
|-------------------|-------------------------------------------------------------|
| Test DB Connection| `http://localhost/ewsd/_classes/Libs/Database/MySQL.php`    |
| Setup Tables      | `http://localhost/ewsd/_classes/Libs/Database/Setup.php`    |
| Login             | `http://localhost/ewsd/src/Auth/design/login.php`           |
| Test Email        | `http://localhost/ewsd/_classes/Helpers/test.php`           |

---

## 🙋 Support

If you run into any problems, feel free to raise an issue or reach out to the maintainer.

---

## 📜 License

This project is licensed for academic and educational use.
