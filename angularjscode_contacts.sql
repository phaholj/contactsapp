-- ----------------------------------------------------------------------------
-- angularjscode - database
-- contacts  - table
-- ----------------------------------------------------------------------------

-- Create angularjscode database
CREATE DATABASE IF NOT EXISTS angularjscode;

-- Use angularjscode database
USE angularjscode;

-- ----------------------------------------------------------------------------
-- Table structure for table `contacts`
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);


-- ----------------------------------------------------------------------------
-- Dumping data for table `contacts`
-- ----------------------------------------------------------------------------
INSERT INTO `contacts` (`name`, `phone`, `address`) VALUES
('Lucas Simon', '27582485957', 'Cnr Woodmeat & Roudes 567'),
('Jery Good', '27582444457', '12676 Mamelodi 0122'),
('Aubrey Kula', '27562589957', 'St Frans Road 3308'),
('Jonh Doe', '27589999957', 'St Laune Roget 5633'),
('Ali Rose', '27588888957', 'No 562 Menlo Street JHB'),
('Robin Smith', '27854747516', 'Stand no 3310 Highveld Pta')
;
-- ----------------------------------------------------------------------------



-- ----------------------------------------------------------------------------
-- Stored procedures
-- ----------------------------------------------------------------------------



-- ----------------------------------------------------------------------------
-- GetContacts
-- ----------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS GetContacts;

DELIMITER $$
 
CREATE PROCEDURE GetContacts()
BEGIN
 SELECT id, name, phone,address
 FROM contacts;
END$$
DELIMITER ;


-- ----------------------------------------------------------------------------
-- GetContact
-- ----------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS GetContact;

DELIMITER $$
 
CREATE PROCEDURE GetContact( in p_Id int(11) )
BEGIN
    SELECT id, name, phone, address 
	From contacts 
    WHERE id = p_Id;
END$$
DELIMITER ;


-- ----------------------------------------------------------------------------
-- AddContact
-- ----------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS AddContact;

DELIMITER $$
CREATE PROCEDURE AddContact(IN p_name varchar(30),IN p_phone varchar(15), IN p_address varchar(100))
BEGIN
  INSERT INTO contacts (name, phone, address) 
  VALUES (p_name, p_phone, p_address);
END$$
DELIMITER ;


-- ----------------------------------------------------------------------------
-- UpdateContact
-- ----------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS UpdateContact;

DELIMITER $$
CREATE PROCEDURE UpdateContact(IN p_ID int(11),IN p_name varchar(30),IN p_phone varchar(15), IN p_address varchar(100))
BEGIN
  UPDATE contacts SET name = p_name, phone = p_phone, address = p_address WHERE id = p_ID;
END$$
DELIMITER ;


-- ----------------------------------------------------------------------------
-- UpdateContact
-- ----------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS DeleteContact;

DELIMITER $$
CREATE PROCEDURE DeleteContact(IN p_ID int(11))
BEGIN
  DELETE FROM contacts WHERE id = p_ID;
END$$
DELIMITER ;


-- ----------------------------------------------------------------------------
-- End
-- ----------------------------------------------------------------------------