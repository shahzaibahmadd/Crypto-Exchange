-- Create Database
CREATE DATABASE IF NOT EXISTS exchange_db;
USE exchange_db;

-- Table for Users
CREATE TABLE IF NOT EXISTS users (
    u_id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    cnic VARCHAR(15) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE
    -- Add other user-related fields as needed
);


-- Table for Admins
CREATE TABLE IF NOT EXISTS admins (
    a_id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    cnic VARCHAR(15) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    is_super_admin BOOLEAN DEFAULT FALSE
    -- Add other admin-related fields as needed
);

INSERT INTO admins (fname, lname, email, address, dob, cnic, pass, is_super_admin) 
VALUES 
('admin', 'User', 'admin@example.com', '123 Admin St, City', '1990-01-01', '12345-6789012-3', '1133', TRUE);




-- ALTER TABLE users ADD INDEX idx_u_id (u_id);
-- Table for Wallets
CREATE TABLE IF NOT EXISTS wallet (
    w_id INT AUTO_INCREMENT PRIMARY KEY,
    u_id INT NOT NULL,
    fiat_currency DECIMAL(10, 2) NOT NULL DEFAULT 1000000.00,
    -- Add other wallet-related fields as needed
    FOREIGN KEY (u_id) REFERENCES users(u_id)
);

-- Table for Coins
CREATE TABLE IF NOT EXISTS coins (
    c_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL, -- Change column name from coin_name to name
    current_price DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    image_path VARCHAR(255) -- Change column name from coin_image_url to image_path
    -- Add other coin-related fields as needed
);


-- Table for Coin-Wallet Relationship
CREATE TABLE IF NOT EXISTS coin_wallet (
    cw_id INT AUTO_INCREMENT PRIMARY KEY,
    w_id INT NOT NULL,
    c_id INT NOT NULL,
    amount DECIMAL(20, 8) DEFAULT 0.00000000,
    -- Add other fields as needed
    FOREIGN KEY (w_id) REFERENCES wallet(w_id),
    FOREIGN KEY (c_id) REFERENCES coins(c_id)
);

-- Step 1: Insert records into the `coins` table
INSERT INTO coins (name, current_price, image_path) VALUES
    ('Bitcoin', 45000.00,'images/bitcoin (2).png'),
    ('BNB', 350.00, 'images/BNB.png'),
    ('Ethereum', 3000.00, 'images/etherum.png'),
    ('Polygon', 2.50, 'images/POLYGON.png'),
    ('Solana', 150.00, 'images/solana.png');

-- Step 1: Insert records into the `wallet` table
-- For demonstration purposes, let's assume a single user with ID 1 and an initial fiat currency balance of 1000000.00
INSERT INTO wallet (u_id, fiat_currency) VALUES (1, 1000000.00);

-- Step 2: Retrieve the `w_id` for the inserted wallet
-- Since the `w_id` is auto-incremented, you can retrieve it after insertion
SET @wallet_id := LAST_INSERT_ID();

-- Step 3: Insert records into the `coin_wallet` table
-- For each coin, insert a record into the `coin_wallet` table, associating it with the retrieved wallet ID
-- Let's assume the initial amount for each coin is 0.00000000
INSERT INTO coin_wallet (w_id, c_id, amount)
VALUES 
    (@wallet_id, (SELECT c_id FROM coins WHERE name = 'Bitcoin'), 0.00000000),
    (@wallet_id, (SELECT c_id FROM coins WHERE name = 'BNB'), 0.00000000),
    (@wallet_id, (SELECT c_id FROM coins WHERE name = 'Ethereum'), 0.00000000),
    (@wallet_id, (SELECT c_id FROM coins WHERE name = 'Polygon'), 0.00000000),
    (@wallet_id, (SELECT c_id FROM coins WHERE name = 'Solana'), 0.00000000);

ALTER DATABASE exchange_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
