-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2021 at 08:40 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdodata`
--

-- --------------------------------------------------------

--
-- Table structure for table `table 2`
--

CREATE TABLE `table 2` (
  `id` int(11) NOT NULL,
  `name` varchar(22) DEFAULT NULL,
  `start_lat` varchar(9) DEFAULT NULL,
  `start_lng` varchar(10) DEFAULT NULL,
  `end_lat` varchar(8) DEFAULT NULL,
  `end_lng` varchar(8) DEFAULT NULL,
  `day` varchar(8) DEFAULT NULL,
  `time` varchar(4) DEFAULT NULL,
  `highlights` varchar(118) DEFAULT NULL,
  `image` varchar(27) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table 2`
--

INSERT INTO `table 2` (`id`, `name`, `start_lat`, `start_lng`, `end_lat`, `end_lng`, `day`, `time`, `highlights`, `image`) VALUES
(1, 'Camden Town', '51.541837', '-0.139199', '51.55039', '-0.14052', 'Sunday', '9am', 'Camden Lock. Camden Market. Roundhouse. Camden High Street. Electric Ballroom.', 'route-placeholder-image.png'),
(2, 'Regents Park', '51.523751', '-0.154577', '51.54156', '-0.16184', 'Sunday', '10am', 'Rose Garden. Boating Lakes. Mosque. Devonshire Terrace. Open Air Theatre. Camden Lock. Regents Canal. ', 'route-placeholder-image.png'),
(3, 'Soho', '51.515173', '-0.132238', '51.51162', '-0.13719', 'Saturday', '9am', 'Old Compton Street. Soho Square. China Town. Golden Square. Theatre Land. Italian Soho. ', 'route-placeholder-image.png'),
(4, 'Hampstead Heath', '51.555236', '-0.151021', '51.57206', '-0.16757', 'Sunday', '9am', 'Jack Straws Castle. Kenwood. Parliament Hill. Hampstead Village. Highgate Village. ', 'route-placeholder-image.png'),
(5, 'Greenwich', '51.483361', '-0.009504', '51.46750', '0.009048', 'Sunday', '9am', 'Cutty Sark. Greenwich Time Museum. The Meridian. Blackheath. Maritime Museum. Greenwich Park.', 'route-placeholder-image.png'),
(6, 'Hyde Park', '51.510197', '-0.196234', '51.50345', '-0.20423', 'Saturday', '10am', 'Hyde Park Corner. Serpentine. Speakers Corner. Hyde Park Gallery. Queensway. Bayswater. ', 'route-placeholder-image.png'),
(7, 'Southbank', '51.507789', '-0.114468', '51.50434', '-0.11446', 'Sunday', '11am', 'National Theatre. Potters Fields. London Bridge. Tower Bridge. The Golden Hind. HMS Belfast. Southwark Bridge.', 'route-placeholder-image.png'),
(8, 'City of London', '51.506997', '-0.071797', '51.52194', '-0.09381', 'Sunday', '11am', 'St Pauls. Lloyds of London. The Gherkin. The Tower of London. St Olav\'s Church. London Wall. The Barbican. ', 'route-placeholder-image.png'),
(9, 'Wapping', '51.506997', '-0.071797', '51.50434', '-0.05611', 'Sunday', '11am', 'St Katherines Dock. Tobacco Wharf. Tower Bridge. Vintners Wharf. The Captain Kidd. ', 'route-placeholder-image.png'),
(10, 'Bloomsbury', '51.518811', '-0.122627', '51.52664', '-0.13217', 'Sunday', '9am', 'Coram Fields. Senate House. British Museum. Friends House. Russel Square. Bedford Square. ', 'route-placeholder-image.png'),
(11, 'Notting Hill', '51.509669', '-0.189522', '51.52108', '-0.20077', 'Sunday', '9am', 'Hyde Park. Portobello Road. The Churchill. Greek Orthodox Cathedral. Notting Hill Movie Locations. ', 'route-placeholder-image.png'),
(12, 'Fitzrovia', '51.523172', '-0.14638', '51.51904', '-0.13009', 'Sunday', '9am', 'Park Square. Cavendish Square. The Cartoon Museum. Charlotte Street. BT Tower. ', 'route-placeholder-image.png'),
(13, 'Kensington and Chelsea', '51.497049', '-0.169995', '51.48074', '-0.16512', 'Sunday', '9am', 'Kings Road. Sloane Square. Stamford Bridge. Army Museum. Chelsea Hospital. Chelsea Harbour.', 'route-placeholder-image.png'),
(14, 'Covent Garden', '51.507489', '-0.122273', '51.51881', '-0.12262', 'Saturday', '9am', 'Covent Garden Piazza. The Transport Museum. The Strand. Trafalgar Square. National Gallery. ', 'route-placeholder-image.png'),
(15, 'East End ', '51.520133', '-0.076662', '51.51661', '-0.04087', 'Sunday', '9am', 'Spitalfields. St Luke\'s Church. Brick Lane. The Truman Brewery. Whitechapel. Tayyab\'s. ', 'route-placeholder-image.png'),
(16, 'Hoxton', '51.525686', '-0.087377', '51.54862', '-0.09214', 'Saturday', '9am', 'Printworks. St Leonards Church. Boundary Gardens. Wesley\'s Chapel. ', 'route-placeholder-image.png'),
(17, 'Clerkenwell', '51.518575', '-0.096838', '51.53000', '-0.10841', 'Sunday', '9am', 'Lenin\'s House. Bunhill Fields. Church of St Peter. St John\'s Gate. Spitalfields. Barbican. Exmouth Street. Grays Inn. ', 'route-placeholder-image.png'),
(18, 'Westminster ', '51.491413', '-0.12769', '51.50677', '-0.14281', 'Sunday', '9am', 'Green Park. St James Park. Buckingham Palace. The Mall. Trafalgar Square. The ICA. Carlton Terrace. ', 'route-placeholder-image.png'),
(19, 'Belgravia', '51.504393', '-0.152834', '51.49226', '-0.15642', 'Sunday', '10am', 'Sloane Square. Eaton Square. Hyde Park Corner. Belgrave Square Gardens. Embassies. Harrods. ', 'route-placeholder-image.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table 2`
--
ALTER TABLE `table 2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table 2`
--
ALTER TABLE `table 2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
