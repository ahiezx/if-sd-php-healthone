-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2023 at 11:59 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthone`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `description`) VALUES
(1, 'Roeitrainer', 'categories/roeitrainer.jpg', 'Een roeitrainer is een fitnessapparaat waarmee je het hele lichaam traint. Met een roeitrainer, ook wel roeitoestel of roeimachine, genoemd, boots je de roeibeweging op het water na. Je hebt daarbij voornamelijk je armen, benen en rugspieren nodig, waardoor het een complete workout is. Roeiapparaten zijn er in vele soorten en prijsklassen. '),
(2, 'Crosstrainer', 'categories/crosstrainer.jpg', 'Een crosstrainer is een fitnessapparaat waarmee je jouw hele lichaam traint. Je maakt namelijk een beweging met zowel je benen als je armen. Daarnaast train je ook de spieren in je core (buik en onderrug), borst, rug en schouders. Zowel in sportscholen als bij thuisgebruik zijn crosstrainers (ook wel elliptical machine genoemd) al geruime tijd een van de populairste fitnessapparaten.'),
(3, 'Hometrainer', 'categories/hometrainer.jpg', '\r\nEen hometrainer is het meest bekende fitnessapparaat voor thuisgebruik en staat ook wel bekend als fitness fiets. Wat is er nu prettiger dan thuis op je gemak te kunnen werken aan je conditie? Met een hometrainer kun je eenvoudig meerdere spiergroepen trainen en je uithoudingsvermogen verbeteren. Daarnaast bepaal je zelf het tempo, het trainingsniveau en het tijdstip van je training.'),
(4, 'Loopband', 'categories/loopband.jpg', 'Een loopband is een veelzijdig fitnessapparaat. Een loopband wordt gebruikt om conditie te verbeteren en vetpercentage te verlagen, maar kan ook ingezet worden voor revalidatie. Het voordeel van een loopband is dat je thuis kunt trainen wanneer het jou uitkomt. Heb je er genoeg van om ‘s avonds in het donker of door weer en wind te lopen, of zou je je spieren, pezen en botten willen ontlasten tijdens het (hard)lopen? Dan is een loopband voor jou de beste oplossing!'),
(5, 'Alexband', 'categories/alexband.png', 'Alexband is goeie for gym en spieren maar je moet veel eten anders je gaat niet lukken dankjewel abi naslsin hoegaat?');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `role` varchar(16) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
