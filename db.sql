-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2020 at 02:08 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kon`
--

-- --------------------------------------------------------

--
-- Table structure for table `karte`
--

CREATE TABLE `karte` (
  `id` int(11) NOT NULL,
  `stevilo` int(11) NOT NULL,
  `koncert_id` int(11) NOT NULL,
  `uporabnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karte`
--

INSERT INTO `karte` (`id`, `stevilo`, `koncert_id`, `uporabnik_id`) VALUES
(2, 3, 3, 1),
(3, 3, 1, 1),
(4, 4, 2, 2),
(9, 3, 5, 1),
(10, 3, 1, 4),
(11, 3, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `koncerti`
--

CREATE TABLE `koncerti` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `datum` date NOT NULL,
  `cena` double NOT NULL,
  `opis` varchar(255) DEFAULT NULL,
  `kraj_id` int(11) NOT NULL,
  `zvrst_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `koncerti`
--

INSERT INTO `koncerti` (`id`, `ime`, `datum`, `cena`, `opis`, `kraj_id`, `zvrst_id`) VALUES
(1, 'Post Malone', '2020-06-17', 60, 'Post Malone\'s greatest hits', 1, 2),
(2, 'Veselica v Pesju', '2020-06-10', 5, 'Najboljša veselica v Sloveniji', 1, 3),
(3, 'Tušev tek barv', '2020-06-27', 20, 'Najboljši event za vse dijake in študente', 3, 1),
(5, 'Kygo', '2020-06-05', 60, 'Kygo and all of his songs', 3, 1),
(6, 'Modrijani', '2020-06-18', 20, 'Veseljaki in Modrijani kot še nikoli do sedaj!', 2, 3),
(7, 'Velenjski koncert', '2020-06-02', 10, '6pack cukur in Vlado Kreslin!', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kraji`
--

CREATE TABLE `kraji` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `posta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kraji`
--

INSERT INTO `kraji` (`id`, `ime`, `posta`) VALUES
(1, 'Velenje', '3320'),
(2, 'Braslovče', '3314'),
(3, 'Ljubljana', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `uporabniki`
--

CREATE TABLE `uporabniki` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `priimek` varchar(255) NOT NULL,
  `uporabnisko_ime` varchar(255) NOT NULL,
  `geslo` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uporabniki`
--

INSERT INTO `uporabniki` (`id`, `ime`, `priimek`, `uporabnisko_ime`, `geslo`, `admin`) VALUES
(1, 'Bian', 'Klancnik', 'root', '$2y$10$4s.RFlx/ifySpBq.RXVqMO86o5NObc4rfHecdG65PUd3h/fvxvWHS', 1),
(2, 'Bian', 'Klancnik', 'bian', '$2y$10$BLzjGjLo5Q/UvBDOvLXugenTEoZUdLVTude9yWvkSZNH93nOPGKbO', 0),
(4, 'Nekdo', 'Neki', 'nekdo', '$2y$10$Swrw/JELA9fC1B0qONkCxOPNhbaK1TPH4RYAoryXaD8KcVfmLjy2.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zvrsti`
--

CREATE TABLE `zvrsti` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `opis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zvrsti`
--

INSERT INTO `zvrsti` (`id`, `ime`, `opis`) VALUES
(1, 'EDM', 'Elektronska glasba'),
(2, 'Rap', 'Govorjenje besedila'),
(3, 'Narodno zabavna glasba', 'Domača');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karte`
--
ALTER TABLE `karte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `koncert_id` (`koncert_id`),
  ADD KEY `uporabnik_id` (`uporabnik_id`);

--
-- Indexes for table `koncerti`
--
ALTER TABLE `koncerti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kraj_id` (`kraj_id`),
  ADD KEY `zvrst_id` (`zvrst_id`);

--
-- Indexes for table `kraji`
--
ALTER TABLE `kraji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uporabniki`
--
ALTER TABLE `uporabniki`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zvrsti`
--
ALTER TABLE `zvrsti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karte`
--
ALTER TABLE `karte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `koncerti`
--
ALTER TABLE `koncerti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kraji`
--
ALTER TABLE `kraji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uporabniki`
--
ALTER TABLE `uporabniki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zvrsti`
--
ALTER TABLE `zvrsti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karte`
--
ALTER TABLE `karte`
  ADD CONSTRAINT `karte_ibfk_1` FOREIGN KEY (`koncert_id`) REFERENCES `koncerti` (`id`),
  ADD CONSTRAINT `karte_ibfk_2` FOREIGN KEY (`uporabnik_id`) REFERENCES `uporabniki` (`id`);

--
-- Constraints for table `koncerti`
--
ALTER TABLE `koncerti`
  ADD CONSTRAINT `koncerti_ibfk_1` FOREIGN KEY (`kraj_id`) REFERENCES `kraji` (`id`),
  ADD CONSTRAINT `koncerti_ibfk_2` FOREIGN KEY (`zvrst_id`) REFERENCES `zvrsti` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
