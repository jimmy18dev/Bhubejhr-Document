-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2018 at 07:30 AM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhubejhr_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` mediumint(8) NOT NULL,
  `name` text NOT NULL,
  `description` text,
  `edit_time` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `edit_time`) VALUES
(1, 'เอกสารทั่วไป', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(8) NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  `category_id` mediumint(8) DEFAULT NULL,
  `title` text,
  `description` text,
  `file_name` varchar(100) NOT NULL,
  `file_type` varchar(20) NOT NULL,
  `file_size` float DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `edit_time` datetime DEFAULT NULL,
  `view` mediumint(8) NOT NULL DEFAULT '0',
  `download` mediumint(8) NOT NULL DEFAULT '0',
  `secret` varchar(50) DEFAULT NULL,
  `privacy` varchar(20) DEFAULT 'member',
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

CREATE TABLE IF NOT EXISTS `keyword` (
  `id` mediumint(11) NOT NULL,
  `word` varchar(100) NOT NULL,
  `create_time` datetime NOT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `signature`
--

CREATE TABLE IF NOT EXISTS `signature` (
  `id` int(8) NOT NULL,
  `sign` text NOT NULL,
  `expire` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `active_time` datetime DEFAULT NULL,
  `form` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(8) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` text,
  `fname` text NOT NULL,
  `lname` text,
  `bio` text,
  `password` text NOT NULL,
  `salt` text,
  `ip` varchar(50) DEFAULT NULL,
  `register_time` datetime NOT NULL,
  `edit_time` datetime DEFAULT NULL,
  `visit_time` datetime DEFAULT NULL,
  `verified` varchar(20) DEFAULT 'non-verified',
  `type` varchar(20) NOT NULL DEFAULT 'guest',
  `status` varchar(20) DEFAULT 'pending',
  `fb_id` varchar(20) DEFAULT NULL,
  `fb_fname` varchar(50) DEFAULT NULL,
  `fb_lname` varchar(50) DEFAULT NULL,
  `fb_link` text,
  `fb_verified` tinyint(1) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signature`
--
ALTER TABLE `signature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `keyword`
--
ALTER TABLE `keyword`
  MODIFY `id` mediumint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `signature`
--
ALTER TABLE `signature`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
