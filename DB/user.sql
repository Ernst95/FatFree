-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 13, 2018 at 07:34 AM
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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(45) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `gender` varchar(45) NOT NULL,
  `mobileNumber` varchar(45) NOT NULL,
  `telephoneNumber` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `userGroupId` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `disabled` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `userGroupId` (`userGroupId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userId`, `password`, `title`, `firstName`, `lastName`, `dateOfBirth`, `gender`, `mobileNumber`, `telephoneNumber`, `email`, `userGroupId`, `created`, `modified`, `disabled`) VALUES
(1, 'MolleeC14ca', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Mollee', 'Carstairs', '1955-08-23', 'Female', '828-817-2296', '(740) 3601206', 'mcarstairs0@sourceforge.net', 2, '2016-02-15 15:17:46', '2018-11-06 15:01:55', 0),
(2, 'CorbyH298e', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Corby', 'Hayth', '1983-08-31', 'Male', '332-916-0364', '(882) 4030237', 'chayth1@ustream.tv', 1, '2015-11-25 03:35:20', NULL, 0),
(3, 'DdeneR77f5', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Ddene', 'Rizzini', '2012-04-18', 'Female', '208-878-2617', '(659) 8882836', 'drizzini2@archive.org', 1, '2014-06-28 14:44:59', NULL, 0),
(4, 'ForestC15e1', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Forest', 'Christon', '2000-09-30', 'Male', '731-591-9632', '(113) 9919204', 'fchriston3@elegantthemes.com', 1, '2014-11-16 01:52:03', NULL, 0),
(5, 'MadelCffea', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Madel', 'Clines', '1955-07-15', 'Female', '581-497-5672', '(458) 7945570', 'mclines4@mozilla.com', 1, '2017-04-19 21:43:53', NULL, 0),
(6, 'VirginaPc221', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Virgina', 'Plenderleith', '1959-09-10', 'Female', '941-671-7644', '(226) 1782080', 'vplenderleith5@booking.com', 1, '2016-10-22 04:23:18', NULL, 0),
(7, 'YovonndaTf59b', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Yovonnda', 'Treves', '1951-11-02', 'Female', '386-910-0670', '(306) 4186072', 'ytreves6@timesonline.co.uk', 1, '2016-12-26 16:31:32', NULL, 0),
(8, 'AristotleV0b5e', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Aristotle', 'Vance', '1956-09-14', 'Male', '526-102-7597', '(588) 3654596', 'avance7@webnode.com', 1, '2016-01-03 06:09:33', NULL, 0),
(9, 'BartelW5228', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Bartel', 'Watts', '2004-11-15', 'Male', '509-603-6626', '(880) 6305363', 'bwatts8@sina.com.cn', 2, '2015-07-31 07:06:01', NULL, 0),
(10, 'CharitaPe1ce', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Charita', 'Piccop', '1993-10-21', 'Female', '760-136-8812', '(131) 4327384', 'cpiccop9@sohu.com', 1, '2016-08-12 03:20:41', NULL, 0),
(11, 'ErinnaD333d', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Erinna', 'Depke', '1988-06-27', 'Female', '958-378-8354', '(916) 3374775', 'edepkea@edublogs.org', 1, '2016-05-27 12:30:16', NULL, 0),
(12, 'AraL0d9e', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Ara', 'Leynagh', '1995-01-10', 'Male', '603-592-2551', '(317) 2100412', 'aleynaghb@163.com', 1, '2014-11-27 11:14:46', NULL, 0),
(13, 'SekaDe553', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Seka', 'Dunster', '1964-02-28', 'Female', '380-955-7099', '(997) 4652978', 'sdunsterc@earthlink.net', 2, '2017-05-30 23:24:10', NULL, 0),
(14, 'HastyJ8b8d', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Hasty', 'Jolliff', '2000-02-26', 'Male', '694-296-3488', '(906) 2260253', 'hjolliffd@ameblo.jp', 1, '2015-07-31 18:21:18', NULL, 0),
(15, 'MarjoryO3b81', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Marjory', 'O\'Shiel', '2010-08-21', 'Female', '152-852-9687', '(855) 2088224', 'moshiele@wix.com', 2, '2018-02-10 03:21:03', NULL, 0),
(16, 'DruV7fe5', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Dru', 'Van Waadenburg', '1992-04-25', 'Female', '610-573-1931', '(517) 7874709', 'dvanwaadenburgf@npr.org', 1, '2017-08-05 12:51:08', NULL, 0),
(17, 'CasseyM3020', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Cassey', 'Maydway', '1965-07-18', 'Female', '742-327-8555', '(515) 6511909', 'cmaydwayg@xing.com', 1, '2018-06-08 00:08:29', NULL, 0),
(18, 'SergeantLc7db', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Sergeant', 'Learoyd', '2000-11-22', 'Male', '287-997-0933', '(642) 1907656', 'slearoydh@salon.com', 2, '2018-07-06 14:13:04', NULL, 0),
(19, 'RozellaSd178', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Rozella', 'Silverthorne', '2001-12-15', 'Female', '381-949-3324', '(489) 1772084', 'rsilverthornei@nytimes.com', 2, '2014-02-11 23:19:00', NULL, 0),
(20, 'ConradL1f5c', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Conrad', 'Lyddiatt', '1948-05-07', 'Male', '715-886-6212', '(376) 8016535', 'clyddiattj@bloglines.com', 2, '2014-04-01 17:29:48', NULL, 0),
(21, 'CaesarF3d25', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Caesar', 'Fowell', '2012-01-15', 'Male', '164-598-5377', '(244) 3327323', 'cfowellk@newyorker.com', 1, '2016-02-26 06:43:51', NULL, 0),
(22, 'AugyP47f3', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Augy', 'Petru', '1975-01-27', 'Male', '340-360-6002', '(636) 8967267', 'apetrul@senate.gov', 2, '2016-05-15 01:54:12', NULL, 0),
(23, 'MeaganS8821', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Meagan', 'Slyde', '1982-12-08', 'Female', '924-956-9602', '(514) 6171130', 'mslydem@ucoz.ru', 1, '2014-12-13 13:05:30', NULL, 0),
(24, 'DyanneR7eef', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Dyanne', 'Ruperti', '1975-03-12', 'Female', '402-814-1944', '(472) 6284293', 'drupertin@mit.edu', 1, '2016-12-07 05:31:17', NULL, 0),
(25, 'MossM4e4f', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Moss', 'McQuarrie', '1998-09-26', 'Male', '862-828-4364', '(992) 7818839', 'mmcquarrieo@forbes.com', 1, '2018-06-29 20:08:54', NULL, 0),
(26, 'AlviniaC197b', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Alvinia', 'Confait', '2004-10-08', 'Female', '435-870-8451', '(140) 6930092', 'aconfaitp@si.edu', 1, '2014-06-19 22:01:07', NULL, 0),
(27, 'SigmundGffa9', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Sigmund', 'Girardet', '2004-01-29', 'Male', '267-252-3578', '(666) 3357340', 'sgirardetq@about.me', 1, '2016-01-29 12:15:12', NULL, 0),
(28, 'EmanuelKf9c2', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Emanuel', 'Kearsley', '1991-06-13', 'Male', '104-782-8545', '(203) 3708074', 'ekearsleyr@sphinn.com', 1, '2016-07-05 02:45:39', NULL, 0),
(29, 'CecillaMac5b', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Cecilla', 'MacMaykin', '1966-06-06', 'Female', '444-939-7847', '(510) 5160100', 'cmacmaykins@state.tx.us', 2, '2017-08-13 20:17:48', NULL, 0),
(30, 'MerrickM115d', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Merrick', 'MacGarrity', '1975-11-06', 'Male', '993-345-6814', '(119) 6387312', 'mmacgarrityt@php.net', 1, '2016-12-15 09:37:42', NULL, 0),
(31, 'ArethaP0c6a', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Aretha', 'Pendre', '1991-10-23', 'Female', '800-331-3803', '(571) 7418164', 'apendreu@woothemes.com', 1, '2018-07-24 06:15:09', NULL, 0),
(32, 'ChenBf0af', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Chen', 'Bartalin', '1957-01-11', 'Male', '395-523-9296', '(542) 9853424', 'cbartalinv@drupal.org', 1, '2017-10-24 17:04:25', NULL, 0),
(33, 'KamilahM5e67', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Kamilah', 'Maingot', '1974-12-27', 'Female', '380-974-5773', '(850) 9867530', 'kmaingotw@va.gov', 2, '2018-02-12 19:07:10', NULL, 0),
(34, 'MaryanneS7c3b', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Maryanne', 'Schulze', '1986-02-06', 'Female', '848-880-1016', '(323) 8348990', 'mschulzex@moonfruit.com', 2, '2015-03-01 22:28:28', NULL, 0),
(35, 'VelmaRf22e', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Velma', 'Ramard', '2007-09-18', 'Female', '262-172-9601', '(676) 3136683', 'vramardy@ftc.gov', 1, '2014-10-28 08:27:40', NULL, 0),
(36, 'EllwoodD600a', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Ellwood', 'Dunan', '1951-12-23', 'Male', '602-313-6482', '(304) 2046811', 'edunanz@etsy.com', 2, '2015-08-22 16:03:53', NULL, 0),
(37, 'FarrellJe040', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Farrell', 'Jorin', '2008-04-10', 'Male', '633-155-3962', '(668) 8056191', 'fjorin10@instagram.com', 2, '2014-08-17 20:49:53', NULL, 0),
(38, 'SondraF42a6', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Sondra', 'Fenge', '2009-12-30', 'Female', '916-605-2434', '(450) 4908419', 'sfenge11@jimdo.com', 2, '2018-07-11 10:11:09', NULL, 0),
(39, 'YardleyWdbd8', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Yardley', 'Worsnip', '1963-01-17', 'Male', '666-600-6292', '(527) 9446939', 'yworsnip12@booking.com', 2, '2014-02-20 02:15:18', NULL, 0),
(40, 'AntoniusH6cb5', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Antonius', 'Hamor', '1956-10-16', 'Male', '586-247-2364', '(413) 3908194', 'ahamor13@free.fr', 2, '2015-10-23 22:50:55', NULL, 0),
(41, 'MathianDecc3', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Mathian', 'Dowd', '1978-04-24', 'Male', '100-697-7505', '(869) 4961966', 'mdowd14@livejournal.com', 1, '2016-02-24 22:20:46', NULL, 0),
(42, 'JaredKb532', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Jared', 'Kyrkeman', '2007-09-09', 'Male', '406-751-1456', '(399) 2831741', 'jkyrkeman15@example.com', 1, '2017-04-17 07:11:52', NULL, 0),
(43, 'WatH62dc', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Wat', 'Hubbins', '1962-05-05', 'Male', '246-496-9231', '(976) 4715153', 'whubbins16@thetimes.co.uk', 1, '2017-07-27 01:10:31', NULL, 0),
(44, 'VanyaL964d', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Vanya', 'Lark', '1962-03-12', 'Female', '872-342-9752', '(270) 6647307', 'vlark17@yellowbook.com', 1, '2014-02-13 19:28:37', NULL, 0),
(45, 'PanchitoM33d1', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Panchito', 'McClosh', '1988-11-21', 'Male', '187-539-6276', '(505) 5966592', 'pmcclosh18@surveymonkey.com', 1, '2017-08-18 23:47:23', NULL, 0),
(46, 'DehliaRde4f', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Dehlia', 'Ryce', '1955-10-08', 'Female', '932-332-7080', '(246) 9818748', 'dryce19@apple.com', 1, '2017-07-06 00:03:53', NULL, 0),
(47, 'JimmieD401c', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Jimmie', 'Digance', '2000-05-30', 'Male', '750-317-6633', '(611) 7684291', 'jdigance1a@spiegel.de', 1, '2015-05-21 08:16:37', NULL, 0),
(48, 'FidelityJ511f', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Fidelity', 'Jarlmann', '1986-12-05', 'Female', '347-709-5340', '(691) 1611560', 'fjarlmann1b@joomla.org', 2, '2014-09-26 19:45:18', NULL, 0),
(49, 'NaneteE9fa7', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Nanete', 'Edinburgh', '1993-11-17', 'Female', '127-430-0551', '(810) 7724241', 'nedinburgh1c@merriam-webster.com', 1, '2016-01-06 14:20:51', NULL, 0),
(50, 'NorbertE6b05', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Norbert', 'Empson', '1967-06-14', 'Male', '644-833-0813', '(430) 4479130', 'nempson1d@wordpress.org', 2, '2018-10-28 08:37:13', NULL, 0),
(51, 'AloysiaKcdbf', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Aloysia', 'Krabbe', '1969-03-03', 'Female', '268-721-1710', '(478) 3991167', 'akrabbe1e@nba.com', 1, '2015-11-05 08:30:27', NULL, 0),
(52, 'CarmencitaLcc75', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Carmencita', 'Ledwitch', '1963-08-21', 'Female', '760-984-6624', '(286) 3651030', 'cledwitch1f@taobao.com', 1, '2015-10-14 11:22:08', NULL, 0),
(53, 'JustisHc597', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Justis', 'Hardaway', '1955-08-25', 'Male', '491-388-9676', '(267) 7775461', 'jhardaway1g@sogou.com', 2, '2014-12-31 17:15:11', NULL, 0),
(54, 'MeghannE789a', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Meghann', 'Emmer', '2003-09-07', 'Female', '863-929-7987', '(745) 5945754', 'memmer1h@wordpress.org', 1, '2017-01-24 05:08:47', NULL, 0),
(55, 'KermieB42e4', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Kermie', 'Bulloch', '2003-07-05', 'Male', '737-793-9718', '(727) 2738031', 'kbulloch1i@cyberchimps.com', 2, '2016-01-28 20:10:36', NULL, 0),
(56, 'ShayDb3a0', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Shay', 'Ditchburn', '2006-12-31', 'Female', '240-944-6943', '(147) 9553978', 'sditchburn1j@reddit.com', 2, '2016-09-15 13:12:32', NULL, 0),
(57, 'NealonI0856', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Nealon', 'Ingley', '1999-04-01', 'Male', '395-827-3844', '(282) 4618381', 'ningley1k@bravesites.com', 1, '2016-11-06 10:26:55', NULL, 0),
(58, 'RomanV5c37', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Roman', 'Vedstra', '1969-12-02', 'Male', '609-889-3198', '(618) 2725975', 'rvedstra1l@furl.net', 1, '2017-06-04 00:14:02', NULL, 0),
(59, 'ElliDc001', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Elli', 'Dradey', '1973-03-20', 'Female', '105-849-7697', '(842) 6725644', 'edradey1m@salon.com', 1, '2017-12-13 06:02:28', NULL, 0),
(60, 'WhitneyNbfea', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Whitney', 'Nickell', '1993-07-15', 'Male', '241-445-5981', '(672) 2961880', 'wnickell1n@spotify.com', 1, '2015-06-10 08:22:35', NULL, 0),
(61, 'AvramB3d94', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Avram', 'Baybutt', '2004-01-29', 'Male', '176-746-7269', '(352) 5827479', 'abaybutt1o@nbcnews.com', 2, '2018-10-25 12:45:37', NULL, 0),
(62, 'AdriannaK22c1', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Adrianna', 'Keddey', '1994-08-04', 'Female', '561-168-4380', '(506) 7190870', 'akeddey1p@tinypic.com', 1, '2016-08-21 04:29:56', NULL, 0),
(63, 'BirgittaG9e43', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Birgitta', 'Gorsse', '1962-04-22', 'Female', '429-384-0856', '(519) 9734189', 'bgorsse1q@state.tx.us', 2, '2018-03-26 23:13:23', NULL, 0),
(64, 'LinoelD5f31', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Linoel', 'Death', '2012-12-18', 'Male', '954-284-0181', '(147) 5928189', 'ldeath1r@rakuten.co.jp', 1, '2015-04-17 10:14:20', NULL, 0),
(65, 'LaneyF0221', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Laney', 'Feehely', '2000-06-27', 'Male', '378-252-8732', '(581) 9707205', 'lfeehely1s@cdc.gov', 2, '2018-07-12 23:28:58', NULL, 0),
(66, 'CarylI98e7', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Caryl', 'Isakovic', '1999-12-15', 'Female', '171-588-6600', '(713) 9633263', 'cisakovic1t@deviantart.com', 1, '2015-02-27 18:51:36', NULL, 0),
(67, 'Anna-dianeM1c17', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Anna-diane', 'Marriott', '1952-08-17', 'Female', '132-926-3384', '(594) 1241157', 'amarriott1u@amazon.co.uk', 1, '2018-10-06 06:50:10', NULL, 0),
(68, 'WestR52f5', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'West', 'Rundall', '1953-03-02', 'Male', '112-285-4982', '(232) 6945188', 'wrundall1v@printfriendly.com', 2, '2018-01-12 00:34:38', NULL, 0),
(69, 'TamaraL2d41', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Tamara', 'Linzee', '1952-01-06', 'Female', '849-420-2331', '(416) 9464295', 'tlinzee1w@woothemes.com', 2, '2015-03-28 11:18:13', NULL, 0),
(70, 'AngelineMa161', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Angeline', 'McGaugie', '1986-08-24', 'Female', '897-937-2324', '(886) 5194238', 'amcgaugie1x@geocities.jp', 2, '2016-03-27 22:40:30', NULL, 0),
(71, 'KeelbyPec28', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Keelby', 'Padginton', '1959-02-17', 'Male', '947-671-1928', '(130) 3107559', 'kpadginton1y@google.it', 1, '2015-03-01 12:29:54', NULL, 0),
(72, 'MordA44a8', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Mord', 'Ashingden', '1991-04-07', 'Male', '244-791-8752', '(314) 5763091', 'mashingden1z@nsw.gov.au', 1, '2016-01-24 06:55:44', NULL, 0),
(73, 'JessRa10d', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Jess', 'Ruddy', '1996-10-13', 'Female', '812-920-4075', '(487) 1084518', 'jruddy20@deviantart.com', 1, '2017-10-30 14:13:28', NULL, 0),
(74, 'KaneJfa1c', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Kane', 'Jaskowicz', '1962-11-02', 'Male', '229-287-0114', '(850) 8490221', 'kjaskowicz21@google.com.br', 2, '2017-07-12 01:05:21', NULL, 0),
(75, 'UgoT37e2', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Ugo', 'Taffs', '2000-09-17', 'Male', '647-767-7388', '(799) 8791279', 'utaffs22@cisco.com', 2, '2016-01-11 06:31:46', NULL, 0),
(76, 'LatrenaB39d1', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Latrena', 'Bonar', '1992-02-07', 'Female', '465-488-3454', '(844) 5979555', 'lbonar23@intel.com', 2, '2018-05-06 13:38:35', NULL, 0),
(77, 'DapheneG46e6', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Daphene', 'Gillbe', '1948-09-04', 'Female', '577-602-6722', '(352) 4459687', 'dgillbe24@businessweek.com', 1, '2016-11-10 20:12:21', NULL, 0),
(78, 'GerhardD57d0', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Gerhard', 'Dow', '1972-06-29', 'Male', '568-110-7333', '(765) 1296215', 'gdow25@privacy.gov.au', 1, '2016-12-15 10:06:35', NULL, 0),
(79, 'PailRe898', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Pail', 'Rothman', '1965-12-12', 'Male', '396-745-4883', '(173) 8293648', 'prothman26@usgs.gov', 2, '2015-03-05 20:21:21', NULL, 0),
(80, 'ArdythM67e3', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Ardyth', 'McNevin', '1992-03-02', 'Female', '609-570-6438', '(809) 3444764', 'amcnevin27@cpanel.net', 1, '2016-10-21 02:03:45', NULL, 0),
(81, 'SteshaR3b6d', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Stesha', 'Roches', '1970-04-01', 'Female', '452-841-3819', '(675) 8454631', 'sroches28@twitpic.com', 2, '2016-11-03 09:20:51', NULL, 0),
(82, 'HaydonL23f1', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Haydon', 'Leer', '1983-11-15', 'Male', '879-507-2911', '(303) 7657968', 'hleer29@1688.com', 1, '2014-02-25 16:23:06', NULL, 0),
(83, 'AndrisPb161', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Andris', 'Petche', '1970-08-21', 'Male', '859-926-2565', '(772) 1975004', 'apetche2a@spotify.com', 2, '2017-06-13 05:50:19', NULL, 0),
(84, 'ClemM94e1', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Clem', 'McElwee', '1999-09-28', 'Male', '656-653-7691', '(365) 4201813', 'cmcelwee2b@friendfeed.com', 2, '2016-03-23 18:26:53', NULL, 0),
(85, 'DurandEcd78', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Durand', 'Edgworth', '1949-04-14', 'Male', '360-773-8637', '(984) 6582029', 'dedgworth2c@tripod.com', 1, '2017-09-14 21:23:50', NULL, 0),
(86, 'GarnetteH81c2', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Garnette', 'Heymann', '1997-07-19', 'Female', '407-800-3089', '(355) 8155158', 'gheymann2d@dmoz.org', 2, '2016-05-09 11:35:03', NULL, 0),
(87, 'AlisRa9a7', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Alis', 'Ramm', '1956-11-14', 'Female', '888-683-0964', '(198) 4437841', 'aramm2e@surveymonkey.com', 1, '2014-12-25 14:05:48', NULL, 0),
(88, 'CordieJad0a', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Cordie', 'Judgkins', '1974-12-26', 'Male', '564-599-6975', '(904) 9668364', 'cjudgkins2f@w3.org', 1, '2016-11-13 22:53:56', NULL, 0),
(89, 'UlickPcbb9', '5f4dcc3b5aa765d61d8327deb882cf99', 'Honorable', 'Ulick', 'Paulon', '1973-02-16', 'Male', '704-913-0699', '(328) 8927821', 'upaulon2g@shutterfly.com', 2, '2018-10-23 23:03:33', NULL, 0),
(90, 'GiselleSc812', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Giselle', 'Snadden', '1975-04-06', 'Female', '407-242-9109', '(480) 4775805', 'gsnadden2h@mit.edu', 2, '2017-10-14 22:13:57', NULL, 0),
(91, 'ZeligA0a82', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Zelig', 'Angric', '1972-05-24', 'Male', '269-353-4759', '(180) 8625367', 'zangric2i@mediafire.com', 1, '2015-03-29 22:26:09', NULL, 0),
(92, 'ElmoC9a17', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Elmo', 'Cullinane', '2004-02-18', 'Male', '537-991-9296', '(652) 4605311', 'ecullinane2j@360.cn', 1, '2016-07-31 13:10:25', NULL, 0),
(93, 'NyeY7856', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Nye', 'Yglesia', '1969-10-29', 'Male', '247-826-5076', '(953) 1225686', 'nyglesia2k@opera.com', 1, '2015-06-22 08:46:38', NULL, 0),
(94, 'MosheW6532', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mr', 'Moshe', 'Winch', '1999-01-04', 'Male', '215-238-0884', '(475) 3579372', 'mwinch2l@google.co.jp', 2, '2014-05-29 00:06:13', NULL, 0),
(95, 'IngraC0461', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Ingra', 'Corse', '1999-10-31', 'Male', '529-462-9127', '(602) 8383583', 'icorse2m@jiathis.com', 2, '2015-12-21 22:01:21', NULL, 0),
(96, 'PeteL6ff2', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Pete', 'Lindroos', '1998-10-31', 'Male', '634-750-9576', '(126) 5656076', 'plindroos2n@bizjournals.com', 2, '2017-05-22 05:20:01', NULL, 0),
(97, 'KikeliaM8922', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mrs', 'Kikelia', 'McMechan', '2010-12-01', 'Female', '752-850-7003', '(321) 8484947', 'kmcmechan2o@arizona.edu', 1, '2018-03-27 20:48:52', NULL, 0),
(98, 'NickieB17a7', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Nickie', 'Birrell', '2001-03-23', 'Male', '346-457-3383', '(757) 8690834', 'nbirrell2p@gov.uk', 1, '2018-10-28 23:09:55', NULL, 0),
(99, 'LauritzS38b9', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Lauritz', 'Simoens', '1959-11-27', 'Male', '620-238-9504', '(402) 9189194', 'lsimoens2q@icio.us', 2, '2016-01-23 23:44:21', NULL, 0),
(100, 'MaddyCaa43', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dr', 'Maddy', 'Chasle', '1995-06-08', 'Female', '769-864-6260', '(717) 7494522', 'mchasle2r@reference.com', 1, '2017-09-16 00:43:42', NULL, 0),
(101, 'ErnstCd702', '098f6bcd4621d373cade4e832627b4f6', 'Mr', 'Ernst', 'Chapman', '1995-03-09', 'Male', '111-111-115', '(021) 11111111', 'ernstc12345@sourceforge.net', 3, '2018-11-12 10:56:53', NULL, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userGroupId`) REFERENCES `usergroup` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
