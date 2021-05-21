-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2021 at 07:51 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itech3108_30342987_a1`
--

-- --------------------------------------------------------

--
-- Table structure for table `hammer`
--

CREATE TABLE `hammer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `seeking` float DEFAULT NULL,
  `submitted` datetime DEFAULT NULL,
  `viewCount` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hammer`
--

INSERT INTO `hammer` (`id`, `user_id`, `title`, `description`, `image`, `seeking`, `submitted`, `viewCount`) VALUES
(1, 14, 'Python Hammer', 'This is Manufactured of Strong Steel and Hard Wood. It is very durable and easy to use. Stylish look with Powerfull grip. Easy to use and easily available in the market.', '1619245073-51b1byO3oML._SL1000_.jpg.jpg', 452, '2021-04-24 11:47:53', 0),
(2, 14, 'Wood Steel Hammer', 'This is a very simple Hammer that is made up of Wood and Steel. It is easy to assemble and easy to use. Easily available on the market and everyone can buy this.', '1619245204-61aFzNjX7kL._SL1500_.jpg.jpg', 150, '2021-04-24 11:50:05', 1),
(3, 10, 'Hammer of Steel', 'This hammer is powerful like a thor hammer. Very durable and very flexible. Easy to use and easily available in the market. It is made up of very strong and hardwood.', '1619245317-61qI2bM-KKL.jpg.jpg', 80, '2021-04-24 11:51:57', 10),
(4, 11, 'Black Thor Hammer', 'This is a very hard, Durable, and Strong Hammer. Made up of Hard wood and Steel. Stylish look and Easily available in market', '1619245435-600-8016_AA.jpg.jpg', 500, '2021-04-24 11:53:56', 4),
(5, 12, 'Cartoon Hammer', 'it is made on the basis of a stylish point of view. It\'s very hard to and Durable. It\'s overall looks like Cartoon. Easily available in the market.', '1619245799-11.jpg.jpg', 150, '2021-04-24 11:59:59', 0),
(6, 13, 'Bold Head Hammer', 'This is Bold Hammer. Very very very Strong and Hard. It is made up of very hard material and with Flexible Fibers. Very Cheap and Easily available in the market.', '1619246218-Hammer.jpg.jpg', 150, '2021-04-24 12:06:58', 1),
(7, 13, 'Black Grip Hammer', 'This is a very hard and Durable Hammer. The gripping power of the hammer is very strong. It can Break everything by a Strong Head.', '1619246312-hammer_PNG3885.png.jpg', 175, '2021-04-24 12:08:32', 9);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `sent` datetime NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `from_user_id`, `to_user_id`, `offer_id`, `sent`, `text`) VALUES
(1, 10, 13, 1, '2021-04-24 12:10:19', 'Hey i am very much intersted to buy your Hammer. I can give you 2004 for this '),
(2, 13, 10, 2, '2021-04-24 12:12:20', 'Hey i am really interested in your Small and simple hammer i can give u 100$ for this.'),
(3, 13, 11, 3, '2021-04-24 12:13:10', 'Hey, i am interested in your Hammer. i Can giver you 600$'),
(4, 14, 10, 4, '2021-04-24 12:14:23', 'I am intersted in your Product i can give 150$ for this nessage. '),
(5, 14, 13, 5, '2021-04-24 12:15:15', 'I am really want to buy to buy your product. I can buy 120 products with 150$ each.'),
(6, 14, 13, 6, '2021-04-24 12:16:47', 'Hey really like your product. And i am really interested to buy your product in 200$');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hammer_id` int(11) DEFAULT NULL,
  `offer` varchar(255) DEFAULT NULL,
  `accepted` int(11) DEFAULT '0',
  `submitted` datetime DEFAULT NULL,
  `send_to` int(11) DEFAULT NULL,
  `message_status` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `user_id`, `hammer_id`, `offer`, `accepted`, `submitted`, `send_to`, `message_status`) VALUES
(1, 10, 7, 'Hey i am very much intersted to buy your Hammer. I can give you 2004 for this ', 1, '2021-04-24 12:10:19', 13, 1),
(2, 13, 3, 'Hey i am really interested in your Small and simple hammer i can give u 100$ for this.', 1, '2021-04-24 12:12:19', 10, 1),
(3, 13, 4, 'Hey, i am interested in your Hammer. i Can giver you 600$', 1, '2021-04-24 12:13:07', 11, 1),
(4, 14, 3, 'I am intersted in your Product i can give 150$ for this nessage. ', 1, '2021-04-24 12:14:23', 10, 1),
(5, 14, 7, 'I am really want to buy to buy your product. I can buy 120 products with 150$ each.', 1, '2021-04-24 12:15:12', 13, 1),
(6, 14, 7, 'Hey really like your product. And i am really interested to buy your product in 200$', 1, '2021-04-24 12:16:47', 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `recentlyview`
--

CREATE TABLE `recentlyview` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hammer_id` int(11) NOT NULL,
  `created_dt` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recentlyview`
--

INSERT INTO `recentlyview` (`id`, `user_id`, `hammer_id`, `created_dt`) VALUES
(1, 12, 3, '2021-04-24 12:00:57'),
(4, 10, 7, '2021-04-24 12:10:19'),
(7, 13, 3, '2021-04-24 12:12:20'),
(8, 13, 6, '2021-04-24 12:12:28'),
(11, 13, 4, '2021-04-24 12:13:10'),
(15, 14, 3, '2021-04-24 12:14:23'),
(21, 14, 7, '2021-04-24 12:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `email`, `password`, `location`) VALUES
(14, 'James', 'James', 'James@gmail.com', '$2y$10$OXNCAn7tvm3ynLOFEofg5eioeA4nXXQPOyUDQGKxGcgtWC.IVEgE6', 'Australian'),
(13, 'Noah', 'Noah', 'Noah@gmail.com', '$2y$10$3Qp7IEkiOaJOYdy3a91YqeTgxDEG2X9WQ/GOYp1XAn2RyoOJRIizO', 'Australian'),
(12, 'Jack', 'Jack', 'Jack@gmail.com', '$2y$10$AK.SNEQh2fCgjeT/1W54OeeVv/.JG5kiKGZX2Qvdwa8p6wOQRRcKe', 'Australian'),
(11, 'William', 'William', 'William@gmail.com', '$2y$10$KjHYoieU2x8wW2xfapUrNugra/vKOBpPVBy1UaFepw8HREs9JD7yC', 'Australian'),
(10, 'Oliver', 'Oliver', 'Oliver@gmail.com', '$2y$10$soaf5gpZpuIG5J3spcTCWOLnyH39Ku2C6WWOR9vcao/nMgqRi7j9i', 'Australian');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hammer`
--
ALTER TABLE `hammer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recentlyview`
--
ALTER TABLE `recentlyview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hammer`
--
ALTER TABLE `hammer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `recentlyview`
--
ALTER TABLE `recentlyview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
