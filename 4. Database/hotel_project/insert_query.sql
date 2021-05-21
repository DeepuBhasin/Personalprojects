INSERT INTO `customer_table` (`id`, `name`, `email`, `phone_number`, `address`) VALUES
(1, 'Wilson', 'Wilson@gmail.com', '0417596288', 'Mansfield, , Victoria, Victoria 3723'),
(2, 'Candy', 'Candy@gmail.com', '0419541439', 'Pakenham, Victoria, WARRAGUL, Victoria 3810'),
(3, 'Raspal', 'Raspal@gmail.com', '0458492045', 'BORONIA, Victoria, MELBOURNE, Victoria 3155'),
(4, 'Hansen', 'hansen@gmail.com', '0404189376', 'Berwick, VIC, BERWICK, Victoria 3806'),
(5, 'Chalmers', 'Chalmers@gmail.com', '0425137375', 'Ringwood, Vic, RINGWOOD NORTH, Victoria 3134'),
(6, 'Kirstin', 'Kirstin@gmail.com', '(03) 9084 7455', 'Ringwood, VIC, Ringwood, Victoria 3134'),
(7, 'Acciarito', 'Acciarito@gmail.com', '0405123068', 'Wantirna, VIC, Victoria 3152'),
(8, 'Janice Riley', 'JaniceRiley@gmail.com', '0413200499', 'Eltham, Victoria 3095'),
(9, 'Maxwell', 'Maxwell@gmail.com', '0456 033 200', 'DONCASTER EAST, Victoria 3095'),
(10, 'Kate', 'Kate@gmail.com', '03 9890 1062', 'Box Hill South, Victoria, BOX HILL SOUTH, Victoria 3128'),
(11, 'Melinda Millar', 'MelindaMillar@gmail.com', '03 9898 0222', 'Surrey Hills, Victoria, Victoria 3104');

INSERT INTO `doctor_table` (`id`, `name`, `email`, `phone_number`, `address`) VALUES
(1, 'Dr Jennifer', 'Jennifer@gmail.com', '1300 856 168', 'Carlton North, VIC, CARLTON NORTH, Victoria 3054'),
(2, 'Dr Viraj', 'DrViraj@gmail.com', '1300 874 325', 'Rouse Hill , NSW, BELLA VISTA, New South Wales 2155'),
(3, 'Dr  J Arachchi', 'Arachchi@gmail.com', '0383 917 020', 'Hoppers Crossing, Victoira, Victoria 3029'),
(4, 'Dr Kemble ', 'KembleWang@gmail.com', '03 9928 6968', 'East Melbourne, Vic, Victoria 3002'),
(5, 'Dr Christine', 'Christine@gmail.com', '0492 867 653', 'Gympie , Qld, GYMPIE, Queensland 4570');

INSERT INTO `receptionist_table` (`id`, `name`, `email`, `phone_number`, `address`, `salary`) VALUES
(1, 'Ms Naomi', 'Naomi@gmail.com', '(03) 9466-1160', 'Lalor, Victoria, LALOR, Victoria 3075', 10000),
(2, 'Edwards-Hart', 'EdwardsHart@gmail.com', '03 9005 5425', 'Kew, Victoria 3101', 11000),
(3, 'Brozovic', 'Brozovic@gmail.com', '0474 249 463', 'Kew, Victoria, Kew, Victoria', 11000),
(4, 'Melanie', 'Melanie@gmail.com', '0490166977', 'Hawthorn East, Victoria, HAWTHORN EAST, Victoria 3122', 11000);

INSERT INTO `type_of_booking` (`id`, `name`) VALUES
(1, 'Single bed'),
(2, 'Double bed'),
(3, 'Rest Room'),
(4, 'Twin Bed Room'),
(5, 'President Suite'),
(6, 'Covid Room'),
(7, 'Executive Suite');

INSERT INTO `room_table` (`id`, `room_no`, `type_of_booking_id`) VALUES
(1, 101, 1),
(2, 102, 1),
(3, 103, 1),
(4, 104, 1),
(5, 201, 2),
(6, 202, 2),
(7, 203, 2),
(8, 204, 2),
(9, 301, 3),
(10, 302, 3),
(11, 401, 4),
(12, 402, 4),
(13, 501, 5),
(14, 502, 5),
(15, 503, 5),
(16, 504, 5),
(17, 601, 6),
(18, 602, 6),
(19, 603, 6),
(20, 604, 6),
(21, 605, 6),
(22, 606, 6),
(23, 701, 7),
(24, 702, 7),
(25, 703, 7),
(26, 704, 7);

INSERT INTO `booking_table` (`id`, `customer_id`, `receptionist_id`, `number_of_person`, `checkin_date`, `checkout_date`, `room_id`, `covid_test_report`, `test_date_time`, `doctor_id`) VALUES
(1, 1, 1, 2, '2021-05-01 04:00:00', '2021-05-03 10:00:00', 5, 'Negative', '2021-05-04 00:00:00', 1),
(2, 2, 4, 1, '2021-05-06 08:00:00', '2021-05-20 10:00:00', 17, 'Positive', '2021-05-08 09:00:00', 3),
(3, 3, 3, 1, '2021-05-07 04:00:00', '2021-05-18 10:00:00', 18, 'Positive', '2021-05-08 00:00:00', 1),
(4, 4, 2, 1, '2021-05-17 06:26:07', '2021-05-31 10:00:00', 21, 'Positive', '2021-05-18 10:13:28', 4),
(5, 5, 1, 4, '2021-05-17 12:09:45', '2021-05-30 10:00:00', 14, 'Negative', '2021-05-17 00:00:00', 3),
(6, 6, 2, 1, '2021-05-13 11:13:17', '2021-05-15 10:00:00', 13, 'Negative', '2021-05-13 10:00:00', 2),
(7, 7, 3, 2, '2021-05-14 11:08:13', '2021-05-17 10:10:00', 12, 'Negative', '2021-05-13 07:31:20', 3),
(8, 8, 1, 4, '2021-05-03 08:19:33', '2021-05-21 10:00:00', 23, 'Negative', '2021-05-03 00:00:00', 5),
(9, 9, 4, 2, '2021-05-11 12:00:00', '2021-05-08 10:00:00', 13, 'Negative', '2021-05-05 00:00:00', 1),
(10, 10, 2, 8, '2021-05-03 08:22:00', '2021-05-22 10:00:00', 25, 'Negative', '2021-05-03 03:00:00', 3),
(11, 11, 1, 2, '2021-06-13 11:13:17', '2021-07-15 10:00:00', 11, 'Negative', '2021-06-13 10:00:00', 2);