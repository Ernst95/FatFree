-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 20, 2018 at 02:16 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `custUserId` varchar(45) NOT NULL,
  `empUserId` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `disabled` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `custUserId` (`custUserId`),
  KEY `empUserId` (`empUserId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `date`, `custUserId`, `empUserId`, `created`, `modified`, `disabled`) VALUES
(1, '2018-11-20 14:00:00', 'CorbyH298e', 'MolleeC14ca', '2018-11-19 12:15:38', '2018-11-19 13:10:23', 0),
(2, '2018-12-01 12:00:00', 'CorbyH298e', 'MolleeC14ca', '2018-11-19 12:18:37', '2018-11-19 13:10:28', 0),
(3, '2018-12-01 12:00:00', 'CorbyH298e', 'MolleeC14ca', '2018-11-19 14:45:32', NULL, 0),
(4, '2018-12-01 12:00:00', 'CorbyH298e', 'MolleeC14ca', '2018-11-20 12:19:12', NULL, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`custUserId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`empUserId`) REFERENCES `user` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
