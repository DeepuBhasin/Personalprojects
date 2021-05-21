
--
-- Dumping data for table `doctor_table`
--

INSERT INTO `doctor_table` (`id`, `name`, `email`, `phone_number`, `address`, `salary`, `specialist`) VALUES
(1, 'Dr Jennifer Coller', 'Jennifer_coller@gmail.com\r\n', '1300 856 168', 'Carlton North, VIC, CARLTON NORTH, Victoria 3054', 20000, 'Cardiology'),
(2, 'Dr Han Ling\r\n', 'han_ling123@gmail.com', '03 8560 0535', 'Melbourne, East Melbourne, Camberwell, Frankston, MELBOURNE, Victoria 3000', 25000, 'Cardiology'),
(3, 'Dr Viraj Kariyawasam', 'DrVirajKariyawasam@gmail.com', '1300 874 325', 'Rouse Hill , NSW, BELLA VISTA, New South Wales 2155', 29000, 'Gastroenterology'),
(4, 'Dr Niranjan J Arachchi', 'NiranjanJArachchi@gmail.com', '0383 917 020', 'Hoppers Crossing, Victoira, Victoria 3029', 27000, 'Gastroenterology'),
(5, 'Dr Kemble Wang\r\n', 'KembleWang@gmail.com\r\n', '03 9928 6968', 'East Melbourne, Vic, Victoria 3002', 26000, 'Orthopaedics'),
(6, 'Dr Christine Cumerford', 'ChristineCumerford@gmail.com', '0492 867 653', 'Gympie , Qld, GYMPIE, Queensland 4570', 22000, 'Orthopaedics'),
(7, 'Dr Craig Rubinstein MBBS FRACS (Plas)', 'CraigRubinstein@gmail.com\r\n', '(03) 8849 1444', 'Dr Craig Rubinstein MBBS FRACS (Plas)\r\n', 40000, 'Plastic Surgery'),
(8, 'Dr Andrea Stimming\r\n', 'AndreaStimming@gmail.com\r\n', '0490846890', 'Brisbane, QLD, Queensland 4000', 31000, 'Psychiatry'),
(9, 'Dr Tony Gianduzzo', 'TonyGianduzzo@gmail.com', '07 5444 0672', '2/5 Lyrebird St Buderim, QLD, BUDERIM, Queensland 4556', 45000, 'Urology'),
(10, 'Natasha Lane - All Over Nutrition', 'NatashaLane@gmail.com', '0480 203 381', 'Williamstown, Victoria, Williamstown, Victoria 3016', 21000, 'Paediatrics and Child Health');

-- --------------------------------------------------------

--
-- Dumping data for table `nurse_table`
--

INSERT INTO `nurse_table` (`id`, `name`, `email`, `phone_number`, `address`) VALUES
(1, 'Mrs Bree Tebbutt\r\n', 'BreeTebbutt@gmail.com', '(03) 5156 8309', 'Central Coast , NSW, WAMBERAL, New South Wales 2260'),
(2, 'Rachelle Domansky', 'RachelleDomansky@gmail.com', '0408943211', 'Mount Pleasant, WA, Perth, Western Australia 6153'),
(3, 'Judith Minster', 'JudithMinster@gmail.com', '+61417321684', 'East Melbourne, Victoria, Victoria 3002'),
(4, 'Dr Carl Zabel', 'CarlZabel@gmail.com', '(03) 93314125', 'Keilor East, VIC, Victoria 3033'),
(5, 'Ms Lauren Byrne', 'LaurenByrne@gmail.com', '0415 124 192', 'Vic, BAIRNSDALE, Victoria 3875');


-- --------------------------------------------------------

--
-- Dumping data for table `patient_table`
--

INSERT INTO `patient_table` (`id`, `name`, `email`, `phone_number`, `address`) VALUES
(1, 'Craig Wilson\r\n', 'CraigWilson@gmail.com\r\n', '0417596288', 'Mansfield, , Victoria, Victoria 3723'),
(2, 'Candy Daniels', 'CandyDaniels@gmail.com', '0419541439', 'Pakenham, Victoria, WARRAGUL, Victoria 3810'),
(3, 'Raspal Khumra\r\n', 'RaspalKhumra@gmail.com\r\n', '0458492045', 'BORONIA, Victoria, MELBOURNE, Victoria 3155'),
(4, 'Ms Linda Hansen\r\n', 'lindahansen@gmail.com', '0404189376', 'Berwick, VIC, BERWICK, Victoria 3806'),
(5, 'Mrs Kirsten Chalmers\r\n', 'KirstenChalmers@gmail.com\r\n', '0425137375', 'Ringwood, Vic, RINGWOOD NORTH, Victoria 3134'),
(6, 'Kirstin Simpson', 'KirstinSimpson@gmail.com', '(03) 9084 7455', 'Ringwood, VIC, Ringwood, Victoria 3134'),
(7, 'Cristian Acciarito\r\n', 'CristianAcciarito@gmail.com\r\n', '0405123068', 'Wantirna, VIC, Victoria 3152'),
(8, 'Janice Riley', 'JaniceRiley@gmail.com', '0413200499', 'Eltham, Victoria 3095'),
(9, 'Aimee Maxwell', 'AimeeMaxwell@gmail.com', '0456 033 200', 'DONCASTER EAST, Victoria 3095'),
(10, 'Kate Down', 'KateDown@gmail.com', '03 9890 1062', 'Box Hill South, Victoria, BOX HILL SOUTH, Victoria 3128'),
(11, 'Melinda Millar', 'MelindaMillar@gmail.com', '03 9898 0222', 'Surrey Hills, Victoria, Victoria 3104');

-- --------------------------------------------------------

-- Dumping data for table `receptionist_table`
--

INSERT INTO `receptionist_table` (`id`, `name`, `email`, `phone_number`, `address`, `salary`) VALUES
(1, 'Ms Naomi Newton', 'NaomiNewton@gmail.com', '(03) 9466-1160', 'Lalor, Victoria, LALOR, Victoria 3075', 10000),
(2, 'Tim Edwards-Hart', 'TimEdwardsHart@gmail.com', '03 9005 5425', 'Kew, Victoria 3101', 11000),
(3, 'Anna Brozovic', 'AnnaBrozovic@gmail.com', '0474 249 463', 'Kew, Victoria, Kew, Victoria', 11000),
(4, 'Melanie Bertino\r\n', 'MelanieBertino@gmail.com\r\n', '0490166977', 'Hawthorn East, Victoria, HAWTHORN EAST, Victoria 3122', 11000);


-- --------------------------------------------------------

--
-- Dumping data for table `ward_table`
--

INSERT INTO `ward_table` (`id`, `ward_name`) VALUES
(1, 'Outpatient Department (OPD)'),
(2, 'Inpatient Service (IP)'),
(3, 'Intensive Care Wards (ICU)'),
(4, 'Intermediate Care Waards'),
(5, 'Operation Theatre Complex (OT)'),
(6, 'Radiology Department (X-ray Department)'),
(7, 'Dialysis'),
(8, 'Laboratorium (lab)'),
(9, 'Mother Child (MOTHCHILD)'),
(10, 'Administration'),
(11, 'Entrance');

-- --------------------------------------------------------

--
-- Dumping data for table `appointment_table`
--

INSERT INTO `appointment_table` (`id`, `doctor_id`, `patient_id`, `receptionist_id`, `appointment_date`, `description_about_appointment`) VALUES
(1, 1, 1, 4, '2021-05-01 10:21:34', 'Check up of heart and heart pump'),
(2, 2, 1, 4, '2021-05-02 10:35:42', 'Check up of heart surgery'),
(3, 3, 3, 1, '2021-05-03 12:21:08', 'Normal Checkup for the liver'),
(4, 4, 4, 3, '2021-05-04 13:15:18', 'Check for the digestion Problem'),
(5, 5, 5, 3, '2021-05-05 10:08:25', 'Check for the arm muscles and swelling of right hand '),
(6, 6, 6, 4, '2021-05-06 12:35:20', 'Normal Check up of the leg muscles and swelling of the foot '),
(7, 7, 7, 2, '2021-05-07 08:21:36', 'Surgery of lips and left hand'),
(8, 7, 8, 2, '2021-05-07 14:28:39', 'Surgery of Right Hand'),
(9, 8, 9, 2, '2021-05-08 12:23:30', 'Checking for mental level  '),
(10, 8, 10, 3, '2021-05-08 11:15:24', 'Checking of depression level '),
(11, 9, 11, 1, '2021-05-09 13:39:50', 'check up for the child ');



-- --------------------------------------------------------
--
-- Dumping data for table `patient_history`
--

INSERT INTO `patient_history` (`id`, `patient_id`, `doctor_id`, `nurse_id`, `description`, `checkup_date`) VALUES
(1, 1, 1, 1, 'Complete Check of the heart and functionality of pumping Heart', '2021-05-01 11:00:00'),
(2, 1, 1, 1, 'Complete information of the patient reports and suggest for surgery', '2021-05-02 11:36:48'),
(3, 1, 1, 1, 'Surgery of the heart and heart pump inserted', '2021-05-03 13:42:51'),
(4, 1, 1, 1, 'Complete check of the heart ', '2021-05-04 11:39:47'),
(5, 2, 2, 2, 'Check up of heart surgery', '2021-05-02 11:00:00'),
(6, 2, 2, 2, 'Complete information of the patient reports and suggest for surgery', '2021-05-03 11:00:00'),
(7, 2, 2, 2, 'Heart surgery operation ', '2021-05-04 11:36:11'),
(8, 2, 2, 2, 'check up heart ', '2021-05-05 12:09:40'),
(9, 3, 3, 3, 'Check for the digestion Problem and liver test', '2021-05-04 13:47:22'),
(10, 3, 3, 3, 'Food poisonings and liver swelling', '2021-05-05 14:42:32'),
(11, 4, 4, 4, 'Check for the digestion Problem ', '2021-05-04 12:17:01'),
(12, 4, 4, 4, 'Complete reports of the liver and food poisoning   ', '2021-05-05 11:14:05'),
(13, 5, 5, 5, 'Check for the arm muscles and swelling of right hand ', '2021-05-05 11:11:21'),
(14, 5, 5, 5, 'Operation of right hand because of damage of the muscles ', '2021-05-06 12:17:42'),
(15, 5, 5, 5, 'infection in the arm muscles due to swelling ', '2021-05-07 10:36:19'),
(16, 5, 5, 5, 'complete check of the arm and hand muscles.', '2021-05-08 12:17:32'),
(17, 5, 5, 5, 'Medical Check up the patient', '2021-05-09 11:36:19'),
(18, 5, 5, 5, 'Medical check up', '2021-05-11 15:17:32'),
(19, 6, 6, 1, 'Normal Check up of the leg muscles and swelling of the foot ', '2021-05-05 11:00:00'),
(20, 6, 6, 1, 'Complete information of the patient reports and suggest for surgery', '2021-05-06 11:36:48'),
(21, 6, 6, 1, 'Surgery of the leg and foot', '2021-05-07 13:42:51'),
(22, 6, 6, 1, 'Complete check of the leg and foot', '2021-05-08 11:39:47'),
(23, 7, 7, 2, 'Surgery of lips and left hand', '2021-05-07 14:00:00'),
(24, 7, 7, 2, 'check up of hand ligament ', '2021-05-08 11:36:48'),
(25, 7, 7, 2, 'check up the lips and hand ', '2021-05-09 13:42:51'),
(26, 7, 7, 2, 'check up the lips and hand ', '2021-05-10 11:39:47'),
(27, 8, 7, 3, 'Surgery of Right Hand', '2021-05-07 14:36:48'),
(28, 8, 7, 3, 'check of Right Hand', '2021-05-08 16:42:51'),
(29, 9, 8, 4, 'Checking for mental level  ', '2021-05-08 12:42:51'),
(30, 9, 8, 4, 'Checking for mental level  ', '2021-05-09 12:42:51'),
(31, 9, 8, 4, 'Checking for mental level  ', '2021-05-10 12:42:51'),
(32, 10, 8, 5, 'Checking of depression level ', '2021-05-08 11:15:24'),
(33, 10, 8, 5, 'Checking of depression level ', '2021-05-09 11:15:24'),
(34, 10, 8, 5, 'Checking of depression level ', '2021-05-10 01:15:24'),
(35, 11, 9, 1, 'Checking of depression level ', '2021-05-09 13:39:50'),
(36, 11, 9, 1, 'Checking of depression level ', '2021-05-10 13:39:50'),
(37, 11, 9, 1, 'Checking of depression level ', '2021-05-11 13:39:50');

-- --------------------------------------------------------
--
-- Dumping data for table `ward_duty_table`
--

INSERT INTO `ward_duty_table` (`id`, `doctor_id`, `nurse_id`, `ward_id`, `ward_duty_date`) VALUES
(1, 1, 1, 1, '2021-05-01 10:40:19'),
(2, 2, 2, 2, '2021-05-02 13:25:17'),
(3, 3, 3, 3, '2021-05-03 10:40:19'),
(4, 4, 4, 4, '2021-05-04 13:25:17'),
(5, 5, 5, 5, '2021-05-05 10:40:19'),
(6, 6, 1, 6, '2021-05-06 13:25:17'),
(7, 7, 2, 7, '2021-05-07 10:40:19'),
(8, 8, 3, 8, '2021-05-08 13:25:17'),
(9, 9, 4, 9, '2021-05-09 13:25:17'),
(10, 1, 5, 9, '2021-05-10 13:25:17'),
(11, 2, 4, 8, '2021-05-10 13:25:17');

