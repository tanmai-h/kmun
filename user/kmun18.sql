-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2018 at 03:46 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kmun18`
--

-- --------------------------------------------------------

--
-- Table structure for table `committee_pref`
--

CREATE TABLE `committee_pref` (
  `email` varchar(100) NOT NULL,
  `pref1` varchar(40) NOT NULL,
  `pref2` varchar(40) NOT NULL,
  `pref3` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committee_pref`
--

INSERT INTO `committee_pref` (`email`, `pref1`, `pref2`, `pref3`) VALUES
('head@h.com', 'Atomic,s2,s1,s1', 'Health,crwe1,fsdf2,crwe1', 'Atomic,s1,s1,s1');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `email` varchar(200) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `muns` int(11) DEFAULT NULL,
  `awards` int(11) DEFAULT NULL,
  `info` varchar(6000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school_head`
--

CREATE TABLE `school_head` (
  `email` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `school` varchar(70) NOT NULL,
  `amount` int(11) NOT NULL,
  `hasPaid` int(11) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_head`
--

INSERT INTO `school_head` (`email`, `firstName`, `lastName`, `school`, `amount`, `hasPaid`, `phone`) VALUES
('head@h.com', 'head', 'del', 'skch', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(70) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(30) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `activated` int(11) NOT NULL,
  `school` varchar(50) NOT NULL,
  `headedBy` varchar(200) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `active_hash` varchar(255) DEFAULT NULL,
  `reset_indentifier` varchar(64) DEFAULT NULL,
  `created_at` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstName`, `lastName`, `password`, `activated`, `school`, `headedBy`, `type`, `phone`, `active_hash`, `reset_indentifier`, `created_at`) VALUES
(2, 'head@h.com', 'head', 'del', '$2y$10$oodiuuAakja2py5dxWcs9.deQy2XueYg9cKvY6QeY/B/vfWx5s0TK', 1, 'skch', NULL, 'headDelegate', NULL, NULL, NULL, 1528292133),
(3, 'dick@h.com\r', 'Fokul', 'kumar', '$2y$10$oodiuuAakja2py5dxWcs9.deQy2XueYg9cKvY6QeY/B/vfWx5s0TK', 1, 'skch', 'head@h.com,head,del', 'student', NULL, NULL, NULL, 1528292215),
(4, 'd2@h.com', 'frr', 'wqewq', '$2y$10$g20PgdgEBa9fTS.dIU.l0eTnFsciwfUFtaxqp3.GLNicThK10chSO', 1, 'skch', 'head@h.com,head,del', 'student', NULL, NULL, NULL, 1528292216);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `committee_pref`
--
ALTER TABLE `committee_pref`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `school_head`
--
ALTER TABLE `school_head`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
