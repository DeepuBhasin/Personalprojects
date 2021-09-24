CREATE Database database_project;

USE database_project;

CREATE TABLE `employee_table` (
  `emp_id` int(11) NOT NULL PRIMARY KEY,
  `emp_name` varchar(150) DEFAULT NULL,
  `emp_mob` varchar(15) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 

CREATE TABLE `service_table` (
  `serv_id` int(11) NOT NULL PRIMARY KEY,
  `serv_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `employee_service_table` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `employee_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  CONSTRAINT `fk_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee_table` (`emp_id`),
  CONSTRAINT `fk_service_id_` FOREIGN KEY (`service_id`) REFERENCES `service_table` (`serv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `owner_table` (
  `own_id` int(11) NOT NULL PRIMARY KEY,
  `own_name` varchar(150) DEFAULT NULL,
  `own_email` varchar(150) DEFAULT NULL,
  `own_type` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `propety_table` (
  `prof_id` int(11) NOT NULL PRIMARY KEY,
  `prof_name` varchar(150) DEFAULT NULL,
  `addr` varchar(150) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `state` varchar(150) DEFAULT NULL,
  `p_code` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `owner_property_table` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `owner_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  CONSTRAINT `fk_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `owner_table` (`own_id`),
  CONSTRAINT `fk_property_id` FOREIGN KEY (`property_id`) REFERENCES `propety_table` (`prof_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `service_propert_table` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `property_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `serv_date` date DEFAULT NULL,
  `serv_hrs` float DEFAULT NULL,
  `serv_chg_hr` float DEFAULT NULL,
  CONSTRAINT `fk_property_id_` FOREIGN KEY (`property_id`) REFERENCES `propety_table` (`prof_id`),
  CONSTRAINT `fk_service_id` FOREIGN KEY (`service_id`) REFERENCES `service_table` (`serv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

