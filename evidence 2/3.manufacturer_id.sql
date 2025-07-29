DELIMITER //

CREATE TRIGGER after_delete_manufacturer
AFTER DELETE ON Manufacturer
FOR EACH ROW
BEGIN
    DELETE FROM Product WHERE manufacturer_id = OLD.id;
END //

DELIMITER ;
