-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 20, 2018 at 02:19 PM
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
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertoken`
--

INSERT INTO `usertoken` (`id`, `userId`, `token`, `expiryDate`, `created`, `modified`, `disabled`) VALUES
(1, 'MolleeC14ca', '22d0ecb4f60bf40f623f7913165f1777076b79866f194f1804c2a5c01478ec12ecee4064acbda73f81cafd1ac561e6f26c7e7ee05f268ca22a24046de61535c2', '2018-11-12 15:56:40', '2018-11-12 10:56:40', NULL, 0),
(2, 'ErnstCd702', 'b985d4e2117d8e4680639f046b8fada9eedc3dca4e226974d1e508205996882f81ee887ad89253d4fb29be03558c14d402a23ada373cd8284e062bcb37ea60ab', '2018-11-21 13:01:19', '2018-11-16 08:01:19', NULL, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usertoken`
--
ALTER TABLE `usertoken`
  ADD CONSTRAINT `usertoken_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
