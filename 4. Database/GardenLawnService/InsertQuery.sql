INSERT INTO `employee_table` (`emp_id`, `emp_name`, `emp_mob`) VALUES
(101, 'Robert McGraw', '401234567'),
(102, 'Mike Burrows', '414563453'),
(103, 'Ben Keen', '414563453');


INSERT INTO `owner_table` (`own_id`, `own_name`, `own_email`, `own_type`) VALUES
(1, 'Helmet Jones', 'helmet.jones@gmail.com', 'Individual'),
(2, 'Kenny Blackmore', 'Kenny.blackmore@gmail.com', 'Coroporation'),
(3, 'Barry Wilson', 'barry.wilson@gmail.com', 'Individual'),
(4, 'Craig  Noon', 'carig.noon@gmail.com', 'Individual'),
(5, 'Wendy Sullivan', 'wendy.sullivan@gmail.com', 'Coroporation'),
(6, 'Jim Bruno', 'jim.gruno@brunoandosone.com', 'Individual'),
(7, 'Peter Emerson', 'peter.emerson@emersonflyingjet.com', 'Coroporation');

INSERT INTO `propety_table` (`prof_id`, `prof_name`, `addr`, `city`, `state`, `p_code`) VALUES
(10, 'Eastlake Building', '123 Eastlake', 'Maroona', 'VIC', '3210'),
(11, 'Earls Court', '235 East West', 'Portland', 'VIC', '3330'),
(12, 'Barry Wilson', '75 West Bound', 'Dundee', 'VIC', '3500'),
(13, 'Jack and Jill', '105 Young', 'Freshy', 'VIC', '3350'),
(14, 'Cosey Here', '144 Sensible', 'Sunshine', 'VIC', '3456'),
(15, 'Bruno & Son', '66/30 Palm Beach', 'Newland', 'VIC', '3333'),
(16, 'Emerson Flying Jet', '707 Ardunino', 'Mega', 'VIC', '3256');


INSERT INTO `service_table` (`serv_id`, `serv_desc`) VALUES
(1, 'Garden Service'),
(2, 'Lawn Mow');


INSERT INTO `employee_service_table` (`id`, `employee_id`, `service_id`) VALUES
(1, 101, 1),
(2, 102, 2),
(3, 101, 1),
(4, 102, 2),
(5, 103, 1),
(6, 102, 2),
(7, 103, 2),
(8, 101, 2);


INSERT INTO `owner_property_table` (`id`, `owner_id`, `property_id`) VALUES
(1, 1, 10),
(2, 2, 11),
(3, 3, 12),
(4, 4, 13),
(5, 5, 14),
(6, 6, 15),
(7, 7, 16);


INSERT INTO `service_propert_table` (`id`, `property_id`, `service_id`, `serv_date`, `serv_hrs`, `serv_chg_hr`) VALUES
(1, 10, 1, '2020-05-05', 2.5, 75),
(2, 11, 2, '2020-05-07', 2, 55),
(3, 12, 1, '2020-05-07', 2.5, 85),
(4, 11, 2, '2020-05-12', 1.5, 50),
(5, 13, 1, '2020-05-19', 3, 85),
(6, 14, 2, '2020-05-17', 2, 90),
(7, 15, 2, '2020-05-14', 2, 55),
(8, 16, 2, '2020-05-10', 1, 50);
