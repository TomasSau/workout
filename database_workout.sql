CREATE DATABASE IF NOT EXISTS workout;
USE workout;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS workout (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    data DATE,
    laikas TIME,
    ivykis VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);