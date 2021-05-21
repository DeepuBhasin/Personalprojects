-- Insert query for Depratment Table
INSERT INTO `department` (`sri`, `department_name`) VALUES
(1, 'Sales'),
(2, 'I.T.'),
(3, 'Warehouse'),
(4, 'Sales'),
(5, 'Testing Unit');


-- Insert into user table 
INSERT INTO `users_table` (`sno`, `name`, `email_id`, `phone_number`, `address`, `salary`) VALUES
(1, 'Edison Woods', 'edison.woods@gmail.com', '(617)555-3452', '421 Golf Course Drive,USA', 2500),
(2, 'Alexander Hunold', 'alexander_hunold@yahoo.com', '(617)555-4343', '4686 Sycamore Fork Road, Hopkins, Minnesota, USA', 56000),
(3, 'Steven King ', 'stevenking@gmail.com', '(617)555-2222', '442 Columbia Boulevard, Randallstown, Maryland, USA', 45777),
(4, 'Neena Kochhar ', 'Neena_Kochhar@gmail.com', '(617)555-9876', '3464 Duke Lane, Newark, New Jersey,USA', 545454),
(5, 'Diana Lorentz', 'Diana_Lorentz@gmail.com', '(617)555-1234', ' 2693 Passaic Street, Washington, Washington DC,USA', 875411),
(6, 'Nancy Greenberg', 'nancy.greenberg111@gmail.com', '(617)555-6543', '3236 Nutters Barn Lane, Des Moines, Iowa, USA', 12451),
(7, 'Daniel Faviet', 'daniel_Faviet@yahoo.com', '(617)555-7638', '127 Sugar Camp Road, Owatonna, Minnesota, USA', 25000),
(8, 'Ismael Sciarra', 'ismaelSciarra1@gmail.com', '(617)555-9182', '3509 Poplar Lane, Miami, Florida, USA', 45000),
(9, 'Jose Manuel Urman', 'jose_Manuel_Urman@hotmail.com', '(617)555-6574', '1242 Jessie Street, Lancaster, Ohio, USA', 15426),
(10, 'Shelli Baida', 'shelli_Baida123@gmail.com', '(617)555-0980', ' 4553 Parkway Drive, Tucson, Arizona, USA', 15428);

-- Insert Into Device Table 
INSERT INTO `device_table` (`sno`, `device_type`, `model_number`, `year_of_manufacture`, `configuration`, `price`, `company_name`, `purchasing_date`, `expiry_date`) VALUES
(1, 'Desktop', 'ASUS Vivo AiO V222', '2011-01-01 00:00:00', '21.5" FHD, Dual Core Intel Celeron J4005, All-in-One Desktop (4GB/1TB HDD/Windows 10/Integrated Graphics/with Wired Keyboard & Mouse/White/4.8 Kg), V222GAK-WA174T', 357.54, 'ASUS', '2011-01-01 00:00:00', '2023-01-01 00:00:00'),
(2, 'Desktop', 'ASUS ExpertCenter D500SA', '2011-01-01 00:00:00', 'Intel Core i5-10400, 8GB DDR4 RAM, 256GB PCIe SSD, Wi-Fi 6, TPM, Windows 10 Professional, Black, D500SA-EB501', 572.99, 'ASUS', '2011-01-01 00:00:00', '2023-01-01 00:00:00'),
(3, 'Desktop', 'ASUS Desktop S300', '2017-01-01 00:00:00', 'Intel Core i5-10400 Processor, 16GB DDR4 RAM, 512GB PCIe SSD, DVD Drive, Windows 10 Home, Wired Keyboard & Mouse Included, Black, S300MA-DH501', 649.99, 'ASUS', '2017-01-01 00:00:00', '2030-01-01 00:00:00'),
(4, 'Laptop', 'Lenovo IdeaPad ', '2018-01-02 00:00:00', '3 14" Laptop, 14.0" FHD 1920 x 1080 Display, AMD Ryzen 5 3500U Processor, 8GB DDR4 RAM, 256GB SSD, AMD Radeon Vega 8 Graphics, Narrow Bezel, Windows 10, 81W0003QUS, Abyss Blue', 513.9, 'Lenovo', '2018-01-02 00:00:00', '2028-01-02 00:00:00'),
(5, 'Laptop', 'Lenovo IdeaPad 3', '2018-01-01 00:00:00', '14" FHD Laptop Computer_ Intel Quad-Core i5 1035G1 (Beats i7-8665U)_ 12GB DDR4 RAM_ 1TB PCIe SSD_ AC WiFi_ BT 5.0_ Webcam_ Grey_ Remote Work_ Windows 10_ iPuzzle 500GB External HD', 729, 'Lenovo', '2018-01-01 00:00:00', '2028-01-01 00:00:00');


-- insert into Software table
INSERT INTO `software_table` (`sno`, `name`, `type`, `licence`, `purchasing_date`, `expiry_date`, `no_of_copies`) VALUES
(1, 'Techsmith Snagit', 'Screenshot program', 1, '2020-07-25 00:00:00', '2021-07-25 00:00:00', 5),
(2, 'Adobe Photoshop', 'Graphics Editor', 1, '2018-02-22 00:00:00', '2021-01-22 00:00:00', 7),
(3, 'Autodesk Autocad', 'Computer-Aided Design and Rafting', 1, '2017-01-05 00:00:00', '2027-01-05 00:00:00', 10),
(4, 'Oracle Database 11g', 'Database Management System', 1, '2017-01-05 00:00:00', '2027-01-05 00:00:00', 10),
(5, 'Oracle Database 12c', 'Database Management System', 1, '2017-01-05 00:00:00', '2027-01-05 00:00:00', 10),
(6, 'Microsoft Windows 8', 'Operating System', 1, '2011-01-05 00:00:00', '2050-01-05 00:00:00', 20),
(7, 'Microsoft Windows 10', 'Computer-Aided Design and Rafting', 1, '2017-01-05 00:00:00', '2050-01-05 00:00:00', 30),
(8, 'Kaspersky Anti Virus', 'Anti Virus', 1, '2011-01-05 00:00:00', '2025-01-05 00:00:00', 50),
(9, 'SAP Financials', 'Enterprise resource planning software', 1, '2019-01-05 00:00:00', '2029-01-05 00:00:00', 50),
(10, 'Scooter Software Beyond Compare', 'data comparison utility', 1, '2017-01-05 00:00:00', '2027-01-05 00:00:00', 20);

-- insert into Vendor Table 
INSERT INTO `vendor_table` (`sno`, `name`, `company_name`, `phone_number`, `company_address`) VALUES
(1, 'Techsmith', 'Techsmith', '(617)555-3452', 'Okemos, Michigan, US'),
(2, 'Scooter Software', 'Scooter Software', '(617)555-9999', '625 N Segoe Rd, Suite 104 Madison, WI 53705,USA'),
(3, 'Adobe', 'Adobe', '(617)555-1111', 'San Jose, California, United States'),
(4, 'Autodesk', 'Autodesk', '(617)555-3333', 'Mill Valley, California, United States'),
(5, 'Microsoft', 'Microsoft', '(617)555-2222', 'Redmond, Washington, United States'),
(6, 'Kaspersky', 'Kaspersky', '(617)555-4444', 'Moscow, Russia'),
(7, 'SAP', 'SAP', '(617)555-8888', 'USA'),
(9, 'Oracle', 'Oracle Corporation', '(806)786 2950', 'Santa Clara, California, United States');



INSERT INTO `user_device_table` (`id`, `user_id`, `device_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 5),
(7, 7, 4),
(8, 8, 1),
(9, 9, 3),
(10, 10, 2);

INSERT INTO `software_device_table` (`id`, `software_id`, `device_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 1),
(7, 7, 2),
(8, 8, 3),
(9, 9, 4),
(10, 10, 5);



INSERT INTO `software_vendor_table` (`id`, `software_id`, `vendor_id`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 4),
(4, 4, 9),
(5, 5, 9),
(6, 6, 5),
(7, 7, 5),
(8, 8, 6),
(9, 9, 7),
(10, 10, 2);


INSERT INTO `user_department_table` (`id`, `user_id`, `department_id`) VALUES
(1, 1, 5),
(2, 2, 4),
(3, 3, 3),
(4, 4, 1),
(5, 5, 2),
(6, 6, 1),
(7, 7, 2),
(8, 8, 3),
(9, 9, 4),
(10, 10, 5);