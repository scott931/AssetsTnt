-- Asset Management System Database Setup Script
-- Run this script in your MySQL client (phpMyAdmin, MySQL Workbench, or command line)

-- Create the database
CREATE DATABASE IF NOT EXISTS `assets_db`
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Use the database
USE `assets_db`;

-- Show confirmation
SELECT 'Database assets_db created successfully!' AS message;

-- Optional: Create a dedicated user for the application (uncomment if needed)
-- CREATE USER IF NOT EXISTS 'assets_user'@'localhost' IDENTIFIED BY 'your_secure_password';
-- GRANT ALL PRIVILEGES ON assets_db.* TO 'assets_user'@'localhost';
-- FLUSH PRIVILEGES;
-- SELECT 'User assets_user created successfully!' AS message;