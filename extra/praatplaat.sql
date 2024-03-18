SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

--
-- Database: `praatplaat`
--

-- --------------------------------------------------------

--
-- Table structure for table `praatplaten`
--

CREATE TABLE `praatplaten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Foto` BLOB DEFAULT NULL,
  `NaamNL` varchar(255) DEFAULT NULL,
  `NaamFR` varchar(255) DEFAULT NULL,
  `NaamEN` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(255) DEFAULT NULL,
  `Wachtwoord` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `elementen`
--

CREATE TABLE `elementen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Foto` BLOB DEFAULT NULL,
  `NaamNL` varchar(255) DEFAULT NULL,
  `NaamFR` varchar(255) DEFAULT NULL,
  `NaamEN` varchar(255) DEFAULT NULL,
  `cat` INT DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data export for table `highscores`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
