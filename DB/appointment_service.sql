-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 13, 2018 at 07:33 AM
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
-- Table structure for table `appointment_service`
--

DROP TABLE IF EXISTS `appointment_service`;
CREATE TABLE IF NOT EXISTS `appointment_service` (
  `appointmentId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `quantitiy` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `disabled` int(11) NOT NULL,
  PRIMARY KEY (`appointmentId`,`serviceId`),
  KEY `serviceId` (`serviceId`) USING BTREE,
  KEY `appointmentId` (`appointmentId`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_service`
--
ALTER TABLE `appointment_service`
  ADD CONSTRAINT `appointment_service_ibfk_1` FOREIGN KEY (`appointmentId`) REFERENCES `appointment` (`id`),
  ADD CONSTRAINT `appointment_service_ibfk_2` FOREIGN KEY (`serviceId`) REFERENCES `service` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
