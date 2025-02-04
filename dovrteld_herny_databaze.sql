-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 16, 2025 at 08:01 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dovrteld_herny_databaze`
--

-- --------------------------------------------------------

--
-- Table structure for table `hry`
--

CREATE TABLE `hry` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `genre` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rating` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hry`
--

INSERT INTO `hry` (`id`, `name`, `genre`, `description`, `rating`, `price`) VALUES
(1, 'The Witcher 3', 'RPG', 'An open-world RPG about a monster hunter.', 10, 40),
(2, 'Minecraft', 'Sandbox', 'A game about placing blocks and going on adventures.', 9, 20),
(3, 'Among Us', 'Party', 'A multiplayer game of teamwork and betrayal.', 8, 5),
(4, 'Cyberpunk 2077', 'Action RPG', 'An open-world RPG set in a futuristic city.', 7, 60),
(5, 'Stardew Valley', 'Simulation', 'A farming simulation and life game.', 10, 15),
(6, 'Grand Theft Auto V', 'Action', 'An action-packed open-world crime game.', 9, 30),
(7, 'Dark Souls III', 'Action RPG', 'A challenging action RPG in a dark fantasy setting.', 8, 50),
(8, 'Hollow Knight', 'Metroidvania', 'An epic action-adventure through a vast underground world.', 9, 15),
(9, 'Terraria', 'Sandbox', 'A game of crafting, combat, and exploration.', 9, 10),
(10, 'Overwatch', 'Shooter', 'A team-based multiplayer first-person shooter.', 8, 20),
(11, 'Portal 2', 'Puzzle', 'A first-person puzzle game with a humorous story.', 10, 10),
(12, 'Celeste', 'Platformer', 'A challenging platformer with a touching narrative.', 10, 20),
(13, 'Red Dead Redemption 2', 'Action', 'An open-world western action-adventure game.', 10, 60);

-- --------------------------------------------------------

--
-- Table structure for table `uzivatele`
--

CREATE TABLE `uzivatele` (
  `id` int NOT NULL,
  `username` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uzivatele`
--

INSERT INTO `uzivatele` (`id`, `username`, `password`, `role`) VALUES
(2, 'petr', '$2y$10$qCRmrsJgG8bp6dodSc0vY.LLoPnYFsj8cSHvb065M2L.l7.JGNd8e', 'user'),
(3, 'ahoj', '$2y$10$PovGxLjoTwBi7eRQas049u.W2gO7.P4SZOi9RhElCq/VvcXZSWDaC', 'user'),
(4, 'admin', '$2y$10$6OsTZXgId/x9E9TZ5meQeuf9NKd19mArKXivMbQ5X/17exUmyZz6W', 'user'),
(5, 'dejvos', '$2y$10$HlgfnZsUsK85lEciHGOofO.QWwFPdGGxgCOXRqzRl.kKGIPm/01GO', 'user'),
(6, 'filip', '$2y$10$b2epNkpIODfW8DQ5/rL72ughXLCtogDRqOmoQkr45osKxEuSWMYKi', 'user'),
(7, 'parno', '$2y$10$2o4sm4holu5Sb8EREIJTGeo72wTfFmRvmSKSr9.eeelolOp6MVf7i', 'user'),
(8, 'gridypdiddy', '$2y$10$Uo5zSyuNctqhXyoovpsM4eOL3fbbtzJxd1eA5DOC4DtyNrutH/65q', 'user'),
(9, 'pernik', '$2y$10$bsFZyJyD6dhSEv2Uy/VqDOlinKfszZI9RRjs5fQbr0.k3vc51ptwu', 'user'),
(10, 'zid', '$2y$10$Wt.FyCOy.ImvnGFXDNIK.u08uR3DZS3MxU3atQyIY2NS1q2T9Mvmq', 'user'),
(11, 'kysnik', '$2y$10$WjaZ33kmfYMUj93ye7iyluN.zSOyqibnUfNyeKzHczi5Matx5/oYW', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hry`
--
ALTER TABLE `hry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hry`
--
ALTER TABLE `hry`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
