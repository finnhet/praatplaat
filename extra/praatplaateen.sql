-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 02:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `praatplaateen`
--

-- --------------------------------------------------------

--
-- Table structure for table `elementen`
--

CREATE TABLE `elementen` (
  `id` int(11) NOT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `NaamNL` varchar(255) DEFAULT NULL,
  `NaamFR` varchar(255) DEFAULT NULL,
  `NaamEN` varchar(255) DEFAULT NULL,
  `cat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elementen`
--


-- --------------------------------------------------------

--
-- Table structure for table `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(11) NOT NULL,
  `Naam` varchar(255) DEFAULT NULL,
  `Wachtwoord` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `praatplaten`
--

CREATE TABLE `praatplaten` (
  `id` int(11) NOT NULL,
  `foto_path` varchar(255) DEFAULT NULL,  -- Store the file path or filename
  `NaamNL` varchar(255) DEFAULT NULL,
  `NaamFR` varchar(255) DEFAULT NULL,
  `NaamEN` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `praatplaten`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `elementen`
--
ALTER TABLE `elementen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_elementen_praatplaten` (`cat`);

--
-- Indexes for table `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `praatplaten`
--
ALTER TABLE `praatplaten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `elementen`
--
ALTER TABLE `elementen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `praatplaten`
--
ALTER TABLE `praatplaten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `elementen`
--
ALTER TABLE `elementen`
  ADD CONSTRAINT `fk_elementen_praatplaten` FOREIGN KEY (`cat`) REFERENCES `praatplaten` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
