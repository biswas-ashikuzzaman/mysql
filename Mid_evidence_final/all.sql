-- Step 1: Create Database
CREATE DATABASE IF NOT EXISTS all_sql;
USE all_sql;

-- Step 2: Create Manufacturer Table
CREATE TABLE IF NOT EXISTS manufacturer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    address VARCHAR(100),
    contact_no VARCHAR(50)
);

-- Step 3: Drop Product Table if exists (to apply ON DELETE CASCADE)
DROP TABLE IF EXISTS product;

-- Step 4: Create Product Table with foreign key (ON DELETE CASCADE)
CREATE TABLE product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    price INT,
    manufacturer_id INT,
    FOREIGN KEY (manufacturer_id) REFERENCES manufacturer(id) ON DELETE CASCADE
);

-- Step 5: Create Deleted Product Log Table
CREATE TABLE IF NOT EXISTS deleted_product_log (
    id INT,
    name VARCHAR(100),
    price INT,
    manufacturer_id INT,
    deleted_at DATETIME
);

-- Step 6: Create Procedure - Insert Manufacturer
DELIMITER @@
CREATE PROCEDURE insert_manufacturer(
    IN m_name VARCHAR(50),
    IN m_address VARCHAR(100),
    IN m_contact VARCHAR(50)
)
BEGIN
    INSERT INTO manufacturer(name, address, contact_no)
    VALUES (m_name, m_address, m_contact);
END@@
DELIMITER ;

-- Step 7: Create Procedure - Insert Product
DELIMITER $$
CREATE PROCEDURE insert_product(
    IN p_name VARCHAR(50),
    IN p_price INT,
    IN m_id INT
)
BEGIN
    INSERT INTO product(name, price, manufacturer_id)
    VALUES (p_name, p_price, m_id);
END$$
DELIMITER ;

-- Step 8: Create Procedure - Get All Manufacturers
DELIMITER $$
CREATE PROCEDURE get_all_manufacturers()
BEGIN
    SELECT * FROM manufacturer;
END$$
DELIMITER ;

-- Step 9: Create Procedure - Delete Product by ID
DELIMITER $$
CREATE PROCEDURE delete_product_by_id(IN product_id INT)
BEGIN
    DELETE FROM product WHERE id = product_id;
END$$
DELIMITER ;

-- Step 10: Create Procedure - Delete Manufacturer by ID (deletes all products too due to ON DELETE CASCADE)
DELIMITER $$
CREATE PROCEDURE delete_manufacturer_by_id(IN m_id INT)
BEGIN
    DELETE FROM manufacturer WHERE id = m_id;
END$$
DELIMITER ;

-- Step 11: Create VIEW - Products with price > 5000 and manufacturer name
CREATE OR REPLACE VIEW view_all_products_only AS
SELECT 
    p.id, 
    p.name AS pname, 
    p.price, 
    m.name AS manufacturer_name
FROM product p
JOIN manufacturer m ON p.manufacturer_id = m.id
WHERE p.price > 5000;

-- Step 12: Trigger - Log deleted products
DELIMITER $$
CREATE TRIGGER after_product_delete
AFTER DELETE ON product
FOR EACH ROW
BEGIN
    INSERT INTO deleted_product_log (id, name, price, manufacturer_id, deleted_at)
    VALUES (OLD.id, OLD.name, OLD.price, OLD.manufacturer_id, NOW());
END$$
DELIMITER ;