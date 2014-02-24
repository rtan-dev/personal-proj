-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2013 at 03:53 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `board`
--
CREATE DATABASE IF NOT EXISTS `board` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `board`;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int(10) unsigned NOT NULL,
  `username` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `thread_id` (`thread_id`,`created`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `thread_id`, `username`, `body`, `created`) VALUES
(1, 1, 'sakana-san', 'I am hungry', '2013-10-09 16:24:00'),
(2, 4, 'Ralph', 'Hi!', '2013-10-10 11:20:10'),
(3, 4, 'Ralph', 'asfasf', '2013-10-10 11:59:24'),
(4, 1, 'ralphtan', 'So am I', '2013-10-12 15:16:14'),
(5, 1, 'sakana-san', 'What''s for lunch?', '2013-10-12 15:33:29'),
(6, 5, 'ralphtan', 'Testing lang po to ', '2013-10-12 18:28:28'),
(7, 2, 'ralphtan', 'Hi', '2013-10-13 14:49:07'),
(8, 6, 'ralphtan', 'Dota tayo!', '2013-10-13 14:53:27'),
(9, 6, 'josephtan', 'Tara!', '2013-10-13 15:17:21'),
(10, 6, 'ralphtan', 'Ano? game?', '2013-10-13 21:32:45'),
(11, 6, 'ralphtan', 'Ano hero mo?', '2013-10-13 21:40:54'),
(12, 6, 'josephtan', 'Kahit ano.', '2013-10-13 21:41:22'),
(13, 6, 'sakana-san', 'Sali ako dyan!', '2013-10-13 21:42:19'),
(14, 6, 'karlpaz', 'Game on!', '2013-10-13 21:43:07'),
(15, 6, 'arisapuli', 'Tara ako mag mimid, Luna ako.', '2013-10-13 21:43:44'),
(16, 6, 'ralphtan', 'Wag ka na aris! Puro ka kabakawan!', '2013-10-13 21:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`id`, `username`, `title`, `created`) VALUES
(1, '', 'Hello', '2013-10-09 16:24:00'),
(2, '', 'Hello', '2013-10-09 16:26:30'),
(3, 'tester', 'Thread2', '2013-10-09 16:26:30'),
(4, '', 'Kahit Ano', '2013-10-10 11:20:10'),
(5, '', 'Testing', '2013-10-12 18:28:28'),
(6, '', 'Dota', '2013-10-13 14:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'ralphtan', '3d10356bb247c4e182b453f860931711'),
(2, 'josephtan', 'd82848b517e47b605fcf5b6d00476e7f'),
(3, 'sakana-san', 'd82848b517e47b605fcf5b6d00476e7f'),
(4, 'karlpaz', 'd82848b517e47b605fcf5b6d00476e7f'),
(5, 'arisapuli', 'd82848b517e47b605fcf5b6d00476e7f');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
