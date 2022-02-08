-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 08, 2022 at 10:25 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_offers`
--
CREATE DATABASE IF NOT EXISTS `projet_offers` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projet_offers`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Demo'),
(2, 'test'),
(3, 'Fx'),
(4, 'Synthétiseur'),
(5, 'clone303'),
(6, 'analogique');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `offer_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`, `offer_id`) VALUES
('313hon', '259363typhon.jpg', 208102030),
('79one', '491233cyclone.jpg', 208102254),
('98erb', '341226reverb.jpg', 208101905);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE IF NOT EXISTS `offers` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `place` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title`, `content`, `price`, `place`, `user_id`, `date`) VALUES
(208101905, 'Reverb à ressort DIY', 'Reverb à ressort faite main, acheté il y à un an', 40, 'Cosne sur loire', 204115053, '2022-02-08 11:19:05'),
(208102030, 'Synthé Dreadbox Typhon', 'Synthétiseur Typhon de la marque Dreadbox', 300, 'Cosne sur loire', 204115053, '2022-02-08 10:23:21'),
(208102254, 'Cyclone Bass Bot ', 'Clone tb 303', 180, 'Nevers', 204121255, '2022-02-08 11:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `offers_categories`
--

CREATE TABLE IF NOT EXISTS `offers_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `offer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers_categories`
--

INSERT INTO `offers_categories` (`id`, `category`, `offer_id`) VALUES
(6, 'Demo', 208101905),
(7, 'Fx', 208101905),
(10, 'Demo', 208102254),
(11, 'Synthétiseur', 208102254),
(12, 'clone303', 208102254),
(13, 'analogique', 208102254),
(14, 'analogique', 208102030);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`) VALUES
(204115053, 'gin', 'ninapariat@live.fr', '$2y$10$f0qW3hz98JLQIGB.Z1iyCetV2eomdLEkAq/lNgcdGdnMud0CLUXMq'),
(204121255, 'nina', 'nina@test.fr', '$2y$10$.nKOPwjww254K6VEsWT2X.sYlucwRVvDw0jvppGoU2z.p/Xrtdo6O');

-- --------------------------------------------------------

--
-- Table structure for table `users_favorites`
--

CREATE TABLE IF NOT EXISTS `users_favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_favorites`
--

INSERT INTO `users_favorites` (`id`, `offer_id`, `user_id`) VALUES
(2, 204120602, 204121255),
(3, 208102254, 204115053);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
