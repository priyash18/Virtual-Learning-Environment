CREATE DATABASE IF NOT EXISTS educonnect;
USE educonnect;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY_KEY,
    username VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(255)
);

CREATE TABLE resources(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    filename VARCHAR(255),
    uploaded_on DATETIME DEFAULT CURRENT_TIMESTAMP
);