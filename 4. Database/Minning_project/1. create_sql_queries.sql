CREATE Database newhill_mining_company;

USE newhill_mining_company;

 -- Department table with create Query 
CREATE TABLE `department` (
  `sri` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Device Table with Create Query
CREATE TABLE `device_table` (
  `sno` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `device_type` varchar(15) NOT NULL,
  `model_number` varchar(50) NOT NULL,
  `year_of_manufacture` datetime NOT NULL,
  `configuration` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `purchasing_date` datetime NOT NULL,
  `expiry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Software Table with create Query 
CREATE TABLE `software_table` (
  `sno` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL,
  `type` varchar(100) NOT NULL,
  `licence` int(11) NOT NULL,
  `purchasing_date` datetime NOT NULL,
  `expiry_date` datetime NOT NULL,
  `no_of_copies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- User Table with create Query 

CREATE TABLE `users_table` (
  `sno` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(60) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `salary` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- vendor table with create Query 

CREATE TABLE `vendor_table` (
  `sno` int(11) NOT NULL AUTO_INCREMENT PRIMARY Key,
  `name` varchar(100) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `company_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- software_device_table Table with create Query 

CREATE TABLE `software_device_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `software_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
   CONSTRAINT `fk_software` FOREIGN KEY (`software_id`) REFERENCES `software_table` (`sno`),
  CONSTRAINT `fk_device` FOREIGN KEY (`device_id`) REFERENCES `device_table` (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `software_vendor_table`
--

CREATE TABLE `software_vendor_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `software_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
   CONSTRAINT `fk_software_id` FOREIGN KEY (`software_id`) REFERENCES `software_table` (`sno`),
  CONSTRAINT `fk_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor_table`(`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `user_department_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`sno`),
  CONSTRAINT `fk_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`sri`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user_device_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`sno`),
  CONSTRAINT `fk_device_id` FOREIGN KEY (`device_id`) REFERENCES `device_table` (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

