CREATE DATABASE hotel_database;

USE hotel_database;

-- customer_table Table

CREATE TABLE `customer_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- doctor_table Table

CREATE TABLE `doctor_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- receptionist_table Table

CREATE TABLE `receptionist_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- type_of_booking Table

CREATE TABLE `type_of_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY key,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- room_table Table

CREATE TABLE `room_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `room_no` int NOT NULL,
  `type_of_booking_id` int  NOT NULL,
  CONSTRAINT `fk_type_of_booking_id` FOREIGN KEY (`type_of_booking_id`) REFERENCES `type_of_booking` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- booking_table Table 

CREATE TABLE `booking_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `customer_id` int(11) NOT NULL,
  `receptionist_id` int(11) NOT NULL,
  `number_of_person` int(11) NOT NULL,
  `checkin_date` datetime NOT NULL,
  `checkout_date` datetime NOT NULL,
  `room_id` int(11) NOT NULL,
  `covid_test_report` varchar(255) NOT NULL,
  `test_date_time` datetime NOT NULL,
  `doctor_id` int(11) NOT NULL,
   CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer_table` (`id`),
   CONSTRAINT `fk_receptionist` FOREIGN KEY (`receptionist_id`) REFERENCES `receptionist_table` (`id`),
   CONSTRAINT `fk_room` FOREIGN KEY (`room_id`) REFERENCES `room_table` (`id`),
   CONSTRAINT `fk_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_table` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- transaction_table Table

CREATE TABLE `transaction_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `booking_id` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `total_amount` float NOT NULL,
  `description` varchar(255) NOT NULL,
   CONSTRAINT `fk_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `booking_table` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
