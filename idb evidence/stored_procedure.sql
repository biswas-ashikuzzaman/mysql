DELIMITER //
CREATE PROCEDURE insert_manufacturer(
    IN m_name VARCHAR(50),
    IN m_address VARCHAR(100),
    IN m_contact VARCHAR(50)
)
BEGIN
    INSERT INTO Manufacturer (name, address, contact_no)
    VALUES (m_name, m_address, m_contact);
END //
DELIMITER ;