-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2020 at 11:38 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `q_movies`
--

CREATE TABLE `q_movies` (
  `question_id` int(20) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `correct_answer` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `q_movies`
--

INSERT INTO `q_movies` (`question_id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_answer`) VALUES
(1, 'What movie star the main role as Jim Carrey ?', 'The Mask', 'MIB', 'This Christmas', 'Jurassic Park', 'The Mask'),
(2, 'Who is Spiderman‘s girlfriend?', 'Lois Lane', 'Princess Diana', 'Doctor Octopus', 'Mary Jane', 'Mary Jane'),
(3, 'Where did the phrase "run Forrest run" come from?', 'Scary Movie 3', 'The Cat in the Hat', 'The Grinch', 'Forrest Gump', 'Forrest Gump'),
(4, 'What animated series had a movie in the big screen?', 'Family Guy', 'American Dad', 'The Simpson', 'Axe Cop', 'The Simpson'),
(5, 'What marvel superhero movie that is known for breaking the fourth wall?', 'Wolverine', 'Spiderman', 'Xmen', 'Deadpool', 'Deadpool'),
(6, 'What movie is based on a video game?', 'World of Warcraft ', 'Bruce Almighty', 'Yes Man', 'Cats', 'World of Warcraft'),
(7, 'In Starwars: Attack of the clones, who was the Jedi that Boba fett hated for the death of his father?', 'Mace Windu', 'Luke Skywalker', 'Yoga', 'Kit Fisto', 'Mace Windu'),
(8, 'In the THING 1982 what did they used to find out who the parasite was', 'Collecting Saliva', 'Collecting Everyone blood', 'Looking into eachother eyes', 'Collecting Hair', 'Collecting Everyone blood'),
(9, 'In Waterworld what’s the most valuable resource?', 'Dirt', 'Water', 'Oil', 'Wood', 'Dirt'),
(10, 'In X-Men first class who was the person that turned Erik Lehnsherr into Magneto ?', 'Shaw', 'Banshee', 'Charles Xavier', 'Havok', 'Shaw'),
(11, 'In X-Men first class who caused Charles Xavier to become handicapped ? ', 'Magneto', 'The Juggernaut', 'Apocalypses', 'Beast', 'Magneto'),
(12, 'In X-Men Apocalypse who Cars Charles Xavier to lose his hair? ', 'Apocalypse', 'Storm', 'Psylocke', 'Magneto', 'Apocalypse'),
(13, '(2001) Planet of the Apes, what helped the humans escaped the apes ?', 'Fire', 'Other friendly monkeys', 'Water/River', 'Guns', 'Water/River'),
(14, 'How many times did the Death Star get blown up? ', '1', '2', '3', '0', '2'),
(15, 'on Mustafar? ', 'The High Ground', 'Blasters', 'With Yoda\'s Help', 'He used the dark side', 'The High Ground'),
(16, 'In Star Wars episode two attack of the clones what planet was the droids manufactured? ', 'Naboo', 'Hoth', 'Earth', 'Genosis', 'Genosis');

-- --------------------------------------------------------

--
-- Table structure for table `q_videogames`
--

CREATE TABLE `q_videogames` (
  `question_id` int(11) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `option1` varchar(155) DEFAULT NULL,
  `option2` varchar(155) DEFAULT NULL,
  `option3` varchar(155) DEFAULT NULL,
  `option4` varchar(155) DEFAULT NULL,
  `correct_answer` varchar(155) DEFAULT NULL,
  `user_answer` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `q_videogames`
--

INSERT INTO `q_videogames` (`question_id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_answer`, `user_answer`) VALUES
(1, 'Which of the following is NOT a ghost from the orignal Pac-Man?', 'Blinky', 'Inky', 'Winky', 'Clyde', 'Winky', NULL),
(2, 'Which of the following is a genuine \'Pokémon\' type?', 'Dark', 'Earth', 'Light', 'Air', 'Dark', NULL),
(3, 'Under what name did Mario debut in 1981\'s \'Donkey Kong\'?', 'Luigi', 'Plumberman', 'Mario', 'Jumpman', 'Jumpman', NULL),
(4, 'Which Nintendo console was part of the \'sixth generation\' of video game consoles along with the Sony Playstation 2 and the Microsoft Xbox?', 'Gamecube', 'Nintendo 64', 'Wii', 'SNES', 'Gamecube', NULL),
(5, 'What genre of video game is \'League of Legends\'?', 'Multiplayer Online Battle Arena (MOBA)', 'Massively Multiplayer Online Real-Time Strategy Game (MMORTS)', 'Massively Multiplayer Online First-Person Shooter Game (MMOFPS)', 'Massively Multiplayer Online Role-Playing Game (MMORPG)', 'Multiplayer Online Battle Arena (MOBA)', NULL),
(6, 'Which of the following is NOT a game mode in \'Minecraft\'?', 'Spectator', 'Destroyer', 'Adventure', 'Hardcore', 'Destroyer', NULL),
(7, 'Which game in the \'Final Fantasy\' franchise was the first to spawn a direct sequel?', 'Final Fantasy XII', 'Final Fantasy X', 'Final Fantasy V', 'Final Fantasy VII', 'Final Fantasy X', NULL),
(8, 'Which of the following consoles was released by \'Sega\'?', 'Jaguar', 'Zodiac', 'Dreamcast', 'Gamecube', 'Dreamcast', NULL),
(9, 'Which is NOT a dungeon in \'The Legend of Zelda: Ocarina of Time\'?', 'Shadow Temple', 'Light Temple', 'Spirit Temple', 'Fire Temple', 'Light Temple', NULL),
(10, 'What is the highest selling single-platform video game of all time?', 'Pokémon Red', 'Super Mario Bros.', 'Wii Sports', 'Grand Theft Auto V', 'Wii Sports', NULL),
(11, 'Which Zelda game involves a lot of sailing?', 'Ocarina of Time', 'The Wind Waker', 'A Link to the Past', 'Skyward Sword', 'The Wind Waker', NULL),
(12, 'Which of these Pokémon is a Fire type?', 'Sudowoodo', 'Magnemite', 'Salamence', 'Rapidash', 'Rapidash', NULL),
(13, 'Which item is used to become temporarily invincible?', '1-UP Mushroom', 'Starman', 'Fire Flower', 'Super Mushroom', 'Starman', NULL),
(14, 'Which of these is not a Nintendo franchise?', 'Fire Emblem', 'Kirby', 'Legend of Zelda', 'Call of Duty', 'Call of Duty', NULL),
(15, 'League of Legends: Which of these is not a legend?', 'Gnar', 'Volibear', 'Jax', 'Garbeast', 'Garbeast', NULL),
(16, 'What is the name of the green creatures that often explode?', 'Stalker', 'Creeper', 'Spooker', 'Spider', 'Creeper', NULL),
(17, 'Which company owns Final Fantasy?', 'Nintendo', 'Microsoft', 'Square Enix', 'Sony', 'Square Enix', NULL),
(18, 'In which year was the first Playstation console launched?', '1991', '1992', '2001', '1994', '1994', NULL),
(19, 'In which year was the first Xbox console  launched?', '1991', '1992', '2001', '1994', '2001', NULL),
(20, 'Which company is publisher of Grand Theft Auto V?', 'Naughty Dog', 'Rockstar Games', 'Blizzard', 'EA Games', 'Rockstar Games', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `q_movies`
--
ALTER TABLE `q_movies`
  ADD PRIMARY KEY (`question_id`),
  ADD UNIQUE KEY `question_id_UNIQUE` (`question_id`);

--
-- Indexes for table `q_videogames`
--
ALTER TABLE `q_videogames`
  ADD PRIMARY KEY (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `q_movies`
--
ALTER TABLE `q_movies`
  MODIFY `question_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
