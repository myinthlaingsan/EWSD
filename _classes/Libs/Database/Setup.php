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
            faculty_id INT,
            FOREIGN KEY (faculty_id) REFERENCES faculties(id) ON DELETE CASCADE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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
    
    echo "Database setup completed successfully!";
} catch (PDOException $e) {
    echo "Error setting up the database: " . $e->getMessage();
}
