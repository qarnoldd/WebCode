-- sample_db.sql
--
-- Instructions:
-- 1. Log in to MySQL as root or a user with privileges.
-- 2. Run: SOURCE /path/to/sample_db.sql
--
-- This will create the database, tables, and insert sample data.

-- Drop and create database
DROP DATABASE IF EXISTS petrescue357;
CREATE DATABASE petrescue357;
USE petrescue357;

-- Create users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mobile VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) DEFAULT 0,
    date_registered DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create pets table
CREATE TABLE pets (
    pet_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    species VARCHAR(30) NOT NULL,
    breed VARCHAR(50),
    age INT,
    gender VARCHAR(10),
    image VARCHAR(100),
    description TEXT,
    status VARCHAR(20) DEFAULT 'available',
    suburb VARCHAR(50),
    state VARCHAR(10),
    fee DECIMAL(10,2),
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create listings table
CREATE TABLE listings (
    listing_id INT AUTO_INCREMENT PRIMARY KEY,
    pet_id INT NOT NULL,
    user_id INT NOT NULL,
    status VARCHAR(20) DEFAULT 'active',
    date_listed DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pet_id) REFERENCES pets(pet_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Create adoptions table
CREATE TABLE adoptions (
    application_id INT AUTO_INCREMENT PRIMARY KEY,
    pet_id INT NOT NULL,
    user_id INT NOT NULL,
    application_notes TEXT,
    application_status VARCHAR(20) DEFAULT 'Pending',
    application_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    adoption_date DATETIME DEFAULT NULL,
    FOREIGN KEY (pet_id) REFERENCES pets(pet_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Insert sample users
INSERT IGNORE INTO users (first_name, last_name, email, mobile, password, is_admin, date_registered) VALUES
('Alice', 'Smith', 'alice@example.com', '0400000000', 'password123', 0, NOW()),
('Bob', 'Jones', 'bob@example.com', '0411000000', 'password456', 0, NOW());

-- Insert sample pets
INSERT IGNORE INTO pets (name, species, breed, age, gender, image, description, status, suburb, state, fee, date_added) VALUES
('Buddy', 'Dog', 'Golden Retriever', 3, 'Male', 'goldenRetriever.png', 'Friendly and energetic.', 'available', 'Parramatta', 'NSW', 200.00, NOW()),
('Mittens', 'Cat', 'Siamese', 2, 'Female', 'siamese.png', 'Loves to nap in the sun.', 'available', 'Blacktown', 'NSW', 100.00, NOW()),
('Charlie', 'Dog', 'Boxer', 4, 'Male', 'boxer.png', 'Playful and loyal.', 'adopted', 'Penrith', 'NSW', 150.00, NOW()),
('Luna', 'Cat', 'Burmese', 1, 'Female', 'burmese.png', 'Curious and affectionate.', 'available', 'Liverpool', 'NSW', 120.00, NOW());

-- Insert sample listings
INSERT IGNORE INTO listings (pet_id, user_id, status, date_listed) VALUES
(1, 1, 'active', NOW()),
(2, 2, 'active', NOW()),
(3, 1, 'closed', NOW()),
(4, 2, 'active', NOW());

-- Insert sample adoptions
INSERT IGNORE INTO adoptions (pet_id, user_id, application_notes, application_status, application_date, adoption_date) VALUES
(1, 2, 'I love dogs!', 'Pending', NOW(), NULL),
(2, 1, 'Cats are my favorite.', 'Approved', NOW(), NOW()),
(3, 2, 'Looking for a playful pet.', 'Rejected', NOW(), NULL);

-- Additional pets and listings for all images in the images folder
-- (Add more sample data as needed, following the new schema) 