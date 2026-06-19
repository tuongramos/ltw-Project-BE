-- =============================================
-- Database Schema cho Web Bán Đồ Thể Thao
-- Chạy file này trong phpMyAdmin hoặc MySQL CLI
-- =============================================

CREATE DATABASE IF NOT EXISTS sports_shop_db
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE sports_shop_db;

-- -----------------------------------------
-- Bảng Danh Mục Sản Phẩm (categories)
-- -----------------------------------------
CREATE TABLE IF NOT EXISTS categories (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    slug        VARCHAR(100) NOT NULL UNIQUE,
    description TEXT DEFAULT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------
-- Bảng Sản Phẩm (products)
-- -----------------------------------------
CREATE TABLE IF NOT EXISTS products (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    category_id   INT NOT NULL,
    name          VARCHAR(255) NOT NULL,
    brand         VARCHAR(100) DEFAULT NULL,
    description   TEXT DEFAULT NULL,
    price         DECIMAL(15,0) NOT NULL,
    sale_price    DECIMAL(15,0) DEFAULT NULL,
    discount      INT DEFAULT 0,
    image         VARCHAR(500) DEFAULT NULL,
    stock         INT DEFAULT 0,
    status        TINYINT DEFAULT 1 COMMENT '1=active, 0=inactive',
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- =============================================
-- Bảng Tài Khoản (accounts)
-- Dùng cho đăng ký, đăng nhập và phân quyền
-- =============================================

CREATE TABLE IF NOT EXISTS accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('USER','ADMIN') DEFAULT 'USER',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;