CREATE Database hospital_database;

USE hospital_database;

--
-- Database: `hospital_database`
--


-- --------------------------------------------------------

--
-- Table structure for table `doctor_table`
--

CREATE TABLE `doctor_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` float NOT NULL,
  `specialist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nurse_table`
--

CREATE TABLE `nurse_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


--
-- Table structure for table `patient_table`
--

CREATE TABLE `patient_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `receptionist_table`
--

CREATE TABLE `receptionist_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `ward_table`
--

CREATE TABLE `ward_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `ward_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `patient_history`
--

CREATE TABLE `patient_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `nurse_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `checkup_date` datetime NOT NULL,
  CONSTRAINT `fk_patient` FOREIGN KEY (`patient_id`) REFERENCES `patient_table` (`id`),
  CONSTRAINT `fk_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_table` (`id`),
  CONSTRAINT `fk_nurse` FOREIGN KEY (`nurse_id`) REFERENCES `nurse_table` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Table structure for table `ward_duty_table`
--

CREATE TABLE `ward_duty_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `doctor_id` int(11) NOT NULL,
  `nurse_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `ward_duty_date` datetime NOT NULL,
  CONSTRAINT `fk_doctor_duty` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_table` (`id`),
  CONSTRAINT `fk_nurse_duty` FOREIGN KEY (`nurse_id`) REFERENCES `nurse_table` (`id`),
  CONSTRAINT `fk_ward_duty` FOREIGN KEY (`ward_id`) REFERENCES `ward_table` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Table structure for table `appointment_table`
--

CREATE TABLE `appointment_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `receptionist_id` int(11) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `description_about_appointment` varchar(255) NOT NULL,
  CONSTRAINT `fk_doctor_appointment` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_table` (`id`),
  CONSTRAINT `fk_patient_appointment` FOREIGN KEY (`patient_id`) REFERENCES `patient_table` (`id`),
  CONSTRAINT `fk_receptionist_appointment` FOREIGN KEY (`receptionist_id`) REFERENCES `receptionist_table` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
