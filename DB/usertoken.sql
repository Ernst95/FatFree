-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 08, 2018 at 03:17 PM
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
-- Table structure for table `usertoken`
--

DROP TABLE IF EXISTS `usertoken`;
CREATE TABLE IF NOT EXISTS `usertoken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(45) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiryDate` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `disabled` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertoken`
--

INSERT INTO `usertoken` (`id`, `userId`, `token`, `expiryDate`, `created`, `modified`, `disabled`) VALUES
(1, '16-1295133', 'c15c528b6da99d2a2f207fa7f73c31ddb46daca232c7c32f493bc05fbe7e457dd065c4bb309ccd11731b64b189410dfb59f39246b3641b7a408dd24e1f143b5e', '2018-11-08 10:32:05', '2018-11-08 14:32:05', NULL, 0),
(2, '89-1254462', '8196313b101b89b1f20c0bbe6bc1b2909d554c5036213a3d690da9673b2eeaedea911d0131c5c47f43569dac73c02cd9f536abb75019c97c2e9cee1c9182533d', '2018-11-08 20:08:02', '2018-11-08 15:08:02', NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
