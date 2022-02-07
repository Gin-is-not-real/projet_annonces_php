-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 06, 2022 at 04:38 PM
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

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Demo'),
(2, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `offer_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`, `offer_id`) VALUES
('289-16', '278labo_39_-16.png', 204121142),
('294ica', '121Spica.png', 204121142),
('322mmi', '96Emmi.png', 204120602);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `place` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title`, `content`, `price`, `place`, `user_id`, `date`) VALUES
(204120602, 'Demo 1', 'Lorem ipsum', 10, 'Cosne', 204115053, '2022-02-04 13:06:02'),
(204121142, 'Demo 2', 'Un test de demo', 50, 'Here', 204115053, '2022-02-04 12:11:53');

-- --------------------------------------------------------

--
-- Table structure for table `offers_categories`
--

CREATE TABLE `offers_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `offer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers_categories`
--

INSERT INTO `offers_categories` (`id`, `category`, `offer_id`) VALUES
(1, 'Demo', 204120602),
(4, 'Demo', 204121142),
(5, 'test', 204121142);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
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

CREATE TABLE `users_favorites` (
  `id` int(11) NOT NULL,
  `offer_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_favorites`
--

INSERT INTO `users_favorites` (`id`, `offer_id`, `user_id`) VALUES
(2, 204120602, 204121255);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers_categories`
--
ALTER TABLE `offers_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_favorites`
--
ALTER TABLE `users_favorites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offers_categories`
--
ALTER TABLE `offers_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_favorites`
--
ALTER TABLE `users_favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
