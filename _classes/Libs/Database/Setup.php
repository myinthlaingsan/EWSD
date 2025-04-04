<?php
include("../../../vendor/autoload.php");

use Libs\Database\MySQL;

$db = (new MySQL())->connect();

try {
    $db->exec("
        CREATE TABLE IF NOT EXISTS faculties(
        id INT AUTO_INCREMENT PRIMARY KEY,
        faculty_name VARCHAR(30) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    // Create users table
    $db->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            email VARCHAR(50) UNIQUE NOT NULL,
            address VARCHAR(50),
            phone VARCHAR(50),
            password VARCHAR(255) NOT NULL, -- Hashed passwords
            faculty_id INT NULL,
            FOREIGN KEY (faculty_id) REFERENCES faculties(id) ON DELETE CASCADE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            last_login TIMESTAMP NULL DEFAULT NULL
        )
    ");
    // Create roles table
    $db->exec("
        CREATE TABLE IF NOT EXISTS roles (
            id INT AUTO_INCREMENT PRIMARY KEY,
            role_name VARCHAR(50) UNIQUE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    // Create role_user table (Many-to-Many: users ↔ roles)
    $db->exec("
        CREATE TABLE IF NOT EXISTS role_user (
            user_id INT NOT NULL,
            role_id INT NOT NULL,
            PRIMARY KEY (user_id, role_id),
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
        )
    ");
    // Create permissions table
    $db->exec("
        CREATE TABLE IF NOT EXISTS permissions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            permission_name VARCHAR(50) UNIQUE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    // Create role_permission table (Many-to-Many: roles ↔ permissions)
    $db->exec("
        CREATE TABLE IF NOT EXISTS role_permission (
            role_id INT NOT NULL,
            permission_id INT NOT NULL,
            PRIMARY KEY (role_id, permission_id),
            FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
            FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE
        )
    ");
    // Create settings table
    $db->exec("
        CREATE TABLE IF NOT EXISTS settings(
            setting_id INT NOT NULL,
            academicyear VARCHAR(100) UNIQUE NOT NULL,
            closure_date DATE NOT NULL,
            final_closure_date DATE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    $db->exec("
        CREATE TABLE IF NOT EXISTS articles (
            article_id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            status VARCHAR(30),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id)
        );
    ");
    $db->exec("
        CREATE TABLE IF NOT EXISTS doc_attachment (
            doc_attachment_id INT AUTO_INCREMENT PRIMARY KEY,
            article_id INT NOT NULL,
            docfile VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (article_id) REFERENCES articles(article_id)
        );
    ");
    $db->exec("
        CREATE TABLE IF NOT EXISTS img_attachment (
            img_attachment_id INT AUTO_INCREMENT PRIMARY KEY,
            article_id INT NOT NULL,
            imagefile VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (article_id) REFERENCES articles(article_id)
        );
    ");
    $db->exec("
        CREATE TABLE IF NOT EXISTS comments(
            comment_id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            article_id INT NOT NULL,
            comment_text TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (article_id) REFERENCES articles(article_id)
        );
    ");
    $db->exec("
        CREATE TABLE IF NOT EXISTS notifications(
            notification_id INT AUTO_INCREMENT PRIMARY KEY,
            article_id INT NOT NULL,
            user_id INT NOT NULL,
            message TEXT NOT NULL,
            is_read BOOLEAN DEFAULT FALSE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            deadline_date DATE NOT NULL,
            FOREIGN KEY (article_id) REFERENCES articles(article_id),
            FOREIGN KEY (user_id) REFERENCES users(id)
        );
    ");
    $db->exec("
        CREATE TABLE activity_logs (
            active_id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NULL,
            page_url VARCHAR(255) NOT NULL,
            browser VARCHAR(255) NOT NULL,
            ip_address VARCHAR(50) NOT NULL,
            view_count INT DEFAULT 1,
            last_viewed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
        );
    ");

    echo "Database setup completed successfully!";
} catch (PDOException $e) {
    echo "Error setting up the database: " . $e->getMessage();
}
